<?php

namespace App;

use Carbon\Carbon;

class UserGallery extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_gallery';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'gallery_id',
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
    
    public function getFileUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH . $this->file);
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
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->name . ' ' . Carbon::now()->toTimeString()) . '.' . $ext;
    }

    public function galleries()
    {
        return $this->hasMany('\App\Gallery', 'gallery_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
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
    
    public function deleteAllFiles()
    {
        $this->deleteFile();
        $this->deleteThumbFile();
        foreach ($this->vendorDetails as $detail) :
            $detail->deleteFileAndThumb();
        endforeach;
        
        return true;
    }
}
