<?php

namespace App;

use Carbon\Carbon;

class ConceptDetail extends BaseModel
{   
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'concept_detail';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'concept_id',
        'vendor_id',
        'date',
        'created_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    
    protected $with = [
    ];
    
    public function vendor()
    {
        return $this->hasOne('\App\Vendor', 'id', 'vendor_id');
    }

    public function concept()
    {
        return $this->hasOne('\App\Concept', 'id', 'concept_id');
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

    public static function sendPushNotification()
    {
        $models = self::whereRaw("DATE_FORMAT(DATE_SUB(date, INTERVAL 1 HOUR), '%Y-%m-%d') = '" . Carbon::now()->format('Y-m-d') . "'")
                ->get();
        if (!$models) {
            return null;
        }
        
        foreach ($models as $model) {
            $users = [];
            if ($model->userRelation->getMaleUserIdToken() != null) {
                $users[] = $model->userRelation->getMaleUserIdToken();
            }
            if ($model->userRelation->getFemaleUserIdToken() != null) {
                $users[] = $model->userRelation->getFemaleUserIdToken();
            }
            $message = new Message();   
            $message->created_at = Carbon::now()->toDateTimeString();
            $message->user_relation_id = $model->user_relation_id;
            $conceptName = $model->concept ? $model->concept->name : "";
            $vendorName = $model->vendor ? $model->vendor->name : "";
            $message->name = 'Reminder: ' . $conceptName . " - " . $vendorName;
            $message->description = "Rincian $vendorName tanggal " . Carbon::parse($model->date)->format('d M Y');
            $message->start_date = Carbon::parse($model->date)->toDateString();
            $message->file = 'default.png';
            $message->end_date = Carbon::parse($model->date)->addDay()->toDateString();
            $message->is_all_date = 0;
            $message->status = self::STATUS_ACTIVE;
            $message->message_at = Carbon::now()->toDateTimeString();
            $message->updated_at = Carbon::now()->toDateTimeString();
            $message->save();
            
            if (count($users) > 0) {
                $fields = [
                    'app_id' => '47a9ea91-aefe-4ca7-b85e-f788edfe1354',
                    'data' => [
                        'id' => $model->id,
                    ],
                    'contents' => [
                        'en' => strip_tags(substr($message->description, 0, 80)),
                    ],
                    'headings' => [
                        'en' => $message->name,
                    ],
                    'include_player_ids' => $users,
                    'badge_count' => 1
                ];
                
                $notification = json_encode($fields);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    'Authorization: Basic MTFmN2ZlZDItZjMxOS00YWRlLTg2YzEtYzkyNmY0NWM4OTQy'
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $notification);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                $response = curl_exec($ch);
                curl_close($ch);

                \Illuminate\Support\Facades\Log::info('Procedure Preparation Send Notification Success with params ' . $notification);
                \Illuminate\Support\Facades\Log::info('Procedure Preparation Send Notification Success with response ' . $response);
            }
        }
    }
}
