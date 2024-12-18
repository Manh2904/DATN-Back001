<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $transaction;
    private $products;
    public function __construct($transaction, $products)
    {
        $this->transaction =$transaction;
        $this->products =$products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.transaction_success')->with([
            'shopping' => $this->transaction,
            'products' => $this->products,

        ]);
    }
}
