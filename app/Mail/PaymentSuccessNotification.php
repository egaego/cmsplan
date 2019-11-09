<?php

namespace App\Mail;

use App\User;
use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    protected $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Transaction $transaction)
    {
        $this->user = $user;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pembayaran Sukses - ' . config('app.name'))
                ->view('emails.transaction.transaction-success')
                ->with([
                    'model' =>  $this->transaction,
                    'user' =>  $this->user,
        ]);
    }
}
