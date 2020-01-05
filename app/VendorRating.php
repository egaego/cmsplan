<?php

namespace App;

use Carbon\Carbon;

class VendorRating extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'vendor_rating';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id',
        'transaction_id',
        'transaction_detail_id',
        'user_id',
        'rate',
        'comment',
        'created_at',
        'updated_at',
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

    public function transaction()
    {
        return $this->hasOne('\App\Transaction', 'id', 'transaction_id');
    }

    public function transactionDetail()
    {
        return $this->hasOne('\App\TransactionDetail', 'id', 'transaction_detail_id');
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
}
