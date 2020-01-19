<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRelation extends BaseModel
{
    const UPLOAD_DESTINATION_PATH = 'files/user-relations/';

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_relation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'male_user_id',
        'female_user_id',
        'wedding_day',
        'venue',
        'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'male_user_id',
        'female_user_id',
    ];
    
    protected $appends = [
        'relation_name'
    ];
    
    protected $with = [
        'maleUser',
        'femaleUser'
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $path = public_path(self::UPLOAD_DESTINATION_PATH);

        if(!is_dir($path)) {
            \File::makeDirectory($path, 0755);
        }
        $this->setPath($path);
    }
    
    public function getRelationNameAttribute()
    {
        return $this->getRelationName();
    }
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->getRelationName() . ' ' . Carbon::now()->toTimeString()) . '.' . $ext;
    }
    
    public function maleUser()
    {
        return $this->hasOne('\App\User', 'id', 'male_user_id');
    }
    
    public function femaleUser()
    {
        return $this->hasOne('\App\User', 'id', 'female_user_id');
    }
    
    public function getMaleUserIdToken()
    {
        if ($this->maleUser->status != User::STATUS_ACTIVE) {
            return null;
        }
        if ($this->maleUser->user_id_token == null) {
            return null;
        }
        return $this->maleUser->user_id_token;
    }
    
    public function getFemaleUserIdToken()
    {
        if ($this->femaleUser->status != User::STATUS_ACTIVE) {
            return null;
        }
        if ($this->femaleUser->user_id_token == null) {
            return null;
        }
        return $this->femaleUser->user_id_token;
    }
    
    public function getPhotoUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH . $this->photo);
    }
    
    public function getRelationName()
    {
        $female = $this->femaleUser->name;
        if ($female == null) {
            $female = 'Pasangan Anda';
        }
        
        $male = $this->maleUser->name;
        if ($male == null) {
            $male = 'Pasangan Anda';
        }
        return $female . ' & ' . $male;
    }

    public function getPartnerName() {
        $female = $this->femaleUser->name;
        if ($female == null) {
            $female = 'Pasangan Anda';
        }
        return $female;
    }

    public function getCustomerName() {
        $male = $this->maleUser->name;
        if ($male == null) {
            $male = 'Pasangan Anda';
        }
        return $male;
    }
    
    public function getListCosts()
    {
        $models = ContentDetail::whereHas('content', function($query) {
                $query->where('content.user_relation_id', '=', $this->id);
            })
            ->with(['content'])
            ->join('content', 'content.id', '=', 'content_detail.content_id')
            ->whereNotNull('content.grouping')
            ->select([DB::raw('content_detail.*, SUM(content_detail.value) as value')])
            ->where('content_detail.is_cost', '=', 1)
            ->groupBy('content.grouping')
            ->get();
            
        $result = [];
        foreach ($models as $model) {
            $model['details'] = Content::with(['concept'])
            ->join('content_detail', 'content.id', '=', 'content_detail.content_id')
            ->join('concept', 'concept.id', '=', 'content.concept_id')
            ->where('content.user_relation_id', '=', $this->id)
            ->select([DB::raw('content_detail.*, SUM(content_detail.value) as value'), 'concept.name'])
            ->where('content_detail.is_cost', 1)
            //->where('content.concept_id', $model->content->concept_id)
            ->where('content.grouping', $model->content->grouping)
            ->groupBy('content.concept_id')
            ->get();
            $result[] = $model;
        }
            
        return $result;
    }
    
    public function deletePhoto()
    {
        @unlink($this->getPath() . $this->photo);
    }
}
