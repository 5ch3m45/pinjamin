<p>Hi {{ $user->name }},</p>
<p>Anda telah meminta untuk reset password akun Aplikasi Stok Barang Anda.</p>
<p>Berikut ini kami lampirkan detail instruksi reset password Akun Anda.</p>
<table border="1">
    <tr>
        <th style="text-align: left">URL:</th>
        <td style="text-align: left">
            <a href="{{ $url }}">{{ $url }}</a>
        </td>
    </tr>
    <tr>
        <th style="text-align: left">Token:</th>
        <td style="text-align: left">{{ $token }}</td>
    </tr>
</table>
<p>Masukkan token pada kolom Token untuk generate password baru Akun Anda. Token bersifat sementara, yaitu selama 24jam sejak email ini Anda terima.</p>
<p><strong>Perhatian</strong>: Abaikan email ini jika Anda merasa tidak meminta untuk reset password.</p>
<br>
<p>Salam,</p>
<p>Admin</p>