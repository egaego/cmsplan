<?php

namespace App;

use Carbon\Carbon;

class Bank extends BaseModel
{   
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bank';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_name',
        'account_holder',
        'account_number',
        'account_branch',
        'status',
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

    public function getAccountNamePluck() {
        return $this->account_name . ' - ' . $this->account_holder . ' - ' . $this->account_number;
    }
}
