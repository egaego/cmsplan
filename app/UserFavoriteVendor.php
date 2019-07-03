<?php

namespace App;

use Carbon\Carbon;

class UserFavoriteVendor extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_favorite_vendor';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'vendor_id',
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
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function vendors()
    {
        return $this->hasMany('\App\Vendor', 'vendor_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
}
