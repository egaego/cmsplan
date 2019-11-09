<?php

namespace App;

use Carbon\Carbon;

class TransactionPayment extends BaseModel
{   
    const UPLOAD_DESTINATION_PATH = 'files/vendors/';
    const UPLOAD_DESTINATION_PATH_THUMB = 'files/vendors/thumbs/';

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transaction_payment';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'user_id',
        'bank_id',
        'evidence_transfer',
        'user_bank_account_name',
        'user_account_holder',
        'user_account_number',
        'total',
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

    public function transaction()
    {
        return $this->hasOne('\App\Transaction', 'id', 'transaction_id');
    }
    
    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

    public function bank()
    {
        return $this->hasOne('\App\Bank', 'id', 'bank_id');
    }

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
        $path = public_path(self::UPLOAD_DESTINATION_PATH);

        if(!is_dir($path)) {
            \File::makeDirectory($path, 0755);
        }
        $this->setPath($path);
    }

    public function getFileUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH . $this->file);
    }

    public function getAvatarUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH . $this->avatar);
    }
    
    public function getFileThumbUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH_THUMB . $this->file);
    }
    
    public function getFileThumbImg()
    {
        if ($this->file != null) {
            return "<img src='{$this->getFileThumbUrl()}' width='150' />";
        }
        
        return null;
    }
    
    public function getFileImg()
    {
        if ($this->file != null) {
            return "<img src='{$this->getFileUrl()}' width='100%' />";
        }
        
        return null;
    }

    public function getFileHtml()
    {
        if ($this->file != null) {
            return "<a href='{$this->getFileUrl()}' target='_blank'><img src='{$this->getFileUrl()}' width='100%' /></a>";
        }
        
        return null;
    }
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->name . ' ' . Carbon::now()->toTimeString()) . '.' . $ext;
    }
    
	/**
	 * set path
	 * 
	 * @param string $value
	 */
	public function setThumbPath($value)
	{
		$this->_thumbPath = $value;
	}
	
	/**
	 * @return string
	 */
	public function getThumbPath()
	{
		return $this->_thumbPath;
	}
    
    public function deleteFile($file = null)
    {
        if ($file == null) {
            $file = $this->file;
        }
        @unlink($this->getPath() . $file);
    }
    
    public function deleteThumbFile($file = null)
    {
        if ($file == null) {
            $file = $this->file;
        }
        @unlink($this->getThumbPath() . $file);
    }
}
