<?php

namespace App\Mail;

use App\Models\Pinjaman;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InfoPeminjaman extends Mailable
{
    use Queueable, SerializesModels;
    public $pinjaman, $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pinjaman $pinjaman, User $user)
    {
        $this->pinjaman = $pinjaman;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pinjaman Baru di Aplikasi Stok Barang')
            ->view('emails.info-peminjaman')
            ->with([
                'user' => $this->user,
                'pinjaman' => $this->pinjaman
            ]);
    }
}
