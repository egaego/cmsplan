<?php

namespace App;

use Carbon\Carbon;
use Mail;
use App\Mail\PaymentSuccessNotification;
use App\Mail\PaymentInvoiceNotification;
use App\Mail\AdminPaymentConfirmationNotification;

class Transaction extends BaseModel
{   
    const STATUS_CANCEL = 0;
    const STATUS_DRAFT = 1;
    const STATUS_PENDING = 5;
    const STATUS_CONFIRMED = 8;
    const STATUS_SUCCESS = 10;
    const STATUS_DELIVERED = 15;

    const STATUS_PAYMENT_PENDING = 0;
    const STATUS_PAYMENT_PAID = 1;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transaction';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
        'bank_id',
        'payment_type_id',
        'payment_paid_at',
        'total',
        'admin_fee',
        'grand_total',
        'status',
        'status_payment',
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
        'transactionDetails',
        'transactionPayments',
        'user',
        'bank',
        'paymentType'
    ];

    protected $appends = [
        'confirmation_link'
    ];

    public function transactionDetails()
    {
        return $this->hasMany('\App\TransactionDetail', 'transaction_id', 'id');
    }

    public function vendorRatings()
    {
        return $this->hasMany('\App\VendorRating', 'transaction_id', 'id');
    }

    public function transactionPayments()
    {
        return $this->hasMany('\App\TransactionPayment', 'transaction_id', 'id');
    }
    
    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

    public function bank()
    {
        return $this->hasOne('\App\Bank', 'id', 'bank_id');
    }

    public function paymentType()
    {
        return $this->hasOne('\App\PaymentType', 'id', 'payment_type_id');
    }

    /**
     * @return array
     */
    public static function statusLabels() {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_CANCEL => 'Cancel',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_SUCCESS => 'Success',
            self::STATUS_DELIVERED => 'Delivered',
        ];
    }

    /**
     * @return string
     */
    public function getStatusLabel() {
        $list = self::statusLabels();

        return $list[$this->status] ? $list[$this->status] : $this->status;
    }

    /**
     * @return array
     */
    public static function statusPaymentLabels() {
        return [
            self::STATUS_PAYMENT_PENDING => 'Pending',
            self::STATUS_PAYMENT_PAID => 'Paid',
        ];
    }

    /**
     * @return string
     */
    public function getStatusPaymentLabel() {
        $list = self::statusPaymentLabels();

        return $list[$this->status_payment] ? $list[$this->status_payment] : $this->status_payment;
    }

    /**
     * @return boolean
     */
    public function sendPaymentSuccessNotification()
    {
        Mail::to([$this->user->email], $this->user->name)
                    ->queue(new PaymentSuccessNotification($this->user, $this));
        
        return true;
    }

    /**
     * @return boolean
     */
    public function sendPaymenInvoiceNotification()
    {
        Mail::to([$this->user->email], $this->user->name)
                    ->queue(new PaymentInvoiceNotification($this->user, $this));
        
        return true;
    }

    /**
     * @return boolean
     */
    public function sendPaymentConfirmationNotification()
    {
        Mail::to(config('mail.admin_mail'), config('mail.admin_mail_name'))
                    ->queue(new AdminPaymentConfirmationNotification($this->user, $this));
        
        return true;
    }

    public static function generateCode()
    {
        return random_int(100000, 999999);
    }

    public function getConfirmationLinkAttribute() {
        return $this->getConfirmationLink();
    }

    public function getConfirmationLink() {
        return url('transaction-confirmation/' . base64_encode($this->attributes['code']));
    }
}
