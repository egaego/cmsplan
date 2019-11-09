<?php

namespace App;

use Carbon\Carbon;

class VendorVoucher extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'vendor_voucher';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id',
        'name',
        'discount',
        'start_date',
        'end_date',
        'status',
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
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }
    
    public function vendor()
    {
        return $this->hasOne('\App\Vendor', 'id', 'vendor_id');
    }
}
