<?php

namespace App;

use Carbon\Carbon;

class Vendor extends BaseModel
{
    const UPLOAD_DESTINATION_PATH = 'files/vendors/';
    const UPLOAD_DESTINATION_PATH_THUMB = 'files/vendors/thumbs/';
    
    private $_thumbPath;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'vendor';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'concept_id',
        'name',
        'description',
        'file',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'instagram',
        'facebook',
        'price',
        'status',
        'order',
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
        'vendorDetails',
        'vendorRatings',
        'vendorPackages',
        'vendorVouchers',
        'vendorActiveVoucher'
    ];

    protected $appends = [
        'rating'
    ];
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
        $path = public_path(self::UPLOAD_DESTINATION_PATH);
        $pathThumb = public_path(self::UPLOAD_DESTINATION_PATH_THUMB);

        if(!is_dir($path)) {
            \File::makeDirectory($path, 0755);
        }
        if(!is_dir($pathThumb)) {
            \File::makeDirectory($pathThumb, 0755);
        }
        $this->setPath($path);
        $this->setThumbPath($pathThumb);
    }

    public function getRatingAttribute() {
        $ratings = $this->vendorRatings;

        if (count($ratings->toArray()) <= 0) {
            return 0;
        }

        $countRating = count($ratings->toArray());
        $total = 0;
        foreach ($ratings as $rating) {
            $total += (int) $rating->rate;
        }

        // return $countRating;

        // if ($total > 0 || $countRating > 0) {
            return round((float) ($total / $countRating), 1);
        // }

        // return 0;
    }

    public function concept()
    {
        return $this->hasOne('\App\Concept', 'id', 'concept_id');
    }
    
    public function vendorDetails()
    {
        return $this->hasMany('\App\VendorDetail', 'vendor_id', 'id');
    }

    public function vendorRatings()
    {
        return $this->hasMany('\App\VendorRating', 'vendor_id', 'id');
    }

    public function vendorPackages()
    {
        return $this->hasMany('\App\VendorPackage', 'vendor_id', 'id');
    }

    public function vendorVouchers()
    {
        return $this->hasMany('\App\VendorVoucher', 'vendor_id', 'id');
    }

    public function vendorActiveVoucher()
    {
        return $this->hasOne('\App\VendorVoucher', 'vendor_id', 'id')
            ->where('vendor_voucher.status', \App\VendorVoucher::STATUS_ACTIVE);
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

    public function getAvatarImg()
    {
        if ($this->file != null) {
            return "<img src='{$this->getAvatarUrl()}' width='150' />";
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

    public function deleteAvatar($file = null)
    {
        if ($file == null) {
            $file = $this->avatar;
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
        $this->deleteAvatar();
        $this->deleteThumbFile();
        
        foreach ($this->vendorDetails as $detail) :
            $detail->deleteFileAndThumb();
        endforeach;
        
        return true;
    }
}
