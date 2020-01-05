<?php

namespace App;

use Carbon\Carbon;
use App\Transaction;

class TransactionDetail extends BaseModel
{   
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transaction_detail';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'concept_id',
        'user_id',
        'vendor_id',
        'vendor_package_id',
        'vendor_voucher_id',
        'total',
        'voucher_discount',
        'grand_total',
        'total',
        'note',
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

    protected $appends = [
        'is_rating'
    ];
    
    protected $with = [
        // 'transaction',
        // 'user',
        // 'vendor',
        // 'vendorPackage',
        // 'vendorVoucher',
    ];

    public function getIsRatingAttribute() {
        $model = Transaction::find($this->attributes['transaction_id']);
        if ($model->status == Transaction::STATUS_SUCCESS) {
            $vendorRating = VendorRating::where('transaction_detail_id', $this->attributes['id'])->first();
            if ($vendorRating) {
                return 1;
            }
        }

        return 1;
    }

    public function vendorRatings()
    {
        return $this->hasMany('\App\VendorRating', 'transaction_detail_id', 'id');
    }

    public function transaction()
    {
        return $this->hasOne('\App\Transaction', 'id', 'transaction_id');
    }
    
    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

    public function vendor()
    {
        return $this->hasOne('\App\Vendor', 'id', 'vendor_id');
    }

    public function concept()
    {
        return $this->hasOne('\App\Concept', 'id', 'concept_id');
    }

    public function vendorPackage()
    {
        return $this->hasOne('\App\VendorPackage', 'id', 'vendor_package_id');
    }

    public function vendorVoucher()
    {
        return $this->hasOne('\App\VendorVoucher', 'id', 'vendor_voucher_id');
    }
}
