<?php

namespace App\Mail;

use App\User;
use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPaymentConfirmationNotification extends Mailable
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
        return $this->subject($this->transaction->code . ' Telah Konfirmasi Pembayaran - ' . config('app.name'))
                ->view('emails.transaction.transaction-confirmed')
                ->with([
                    'model' =>  $this->transaction,
                    'user' =>  $this->user,
        ]);
    }
}
