<p>Selamat datang {{ $user->name }}, di Aplikasi Stok Barang.</p>
<p>Berikut adalah informasi login Anda:</p>
<table border="1">
    <tr>
        <th style="text-align: left">Email:</th>
        <td style="text-align: left">{{ $user->email }}</td>
    </tr>
    <tr>
        <th style="text-align: left">Password:</th>
        <td style="text-align: left">{{ $password }}</td>
    </tr>
</table>
<p><strong>Saran</strong>: Segera ganti password Anda saat pertama kali login.</p>
<br>
<p>Salam,</p>
<p>Admin</p>