<p>Hi {{ $user->name }},</p>
<p>Anda telah mengajukan peminjaman di aplikasi Stok Barang.</p>
<p>Berikut ini adalah detail peminjaman Anda:</p>
<table border="1">
    <tr>
        <th style="text-align: left">Kode</th>
        <td style="text-align: left">{{ $pinjaman->kode }}</td>
    </tr>
    <tr>
        <th style="text-align: left">Tgl. Pengajuan</th>
        <td style="text-align: left">{{ date('d M Y', strtotime($pinjaman->tanggal_pengajuan)) }}</td>
    </tr>
    <tr>
        <th style="text-align: left">Tgl. Rencana Pengembalian</th>
        <td style="text-align: left">{{ date('d M Y', strtotime($pinjaman->rencana_pengembalian)) }}</td>
    </tr>
</table>
<br>
<p>Berikut adalah rincian barang yang Anda pinjam:</p>
<table border="1">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Lokasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pinjaman->pinjaman_barangs as $pinjaman_barang)
        <tr>
            <td>{{ $pinjaman_barang->barang->merk.': '.$pinjaman_barang->barang->nama }}</td>
            <td>{{ $pinjaman_barang->barang->lokasi->nama }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>Mohon ditunggu, karena pinjaman Anda sedang direview oleh Admin.</p>
<p>Apabila mendesak, harap tunjukkan email ini kepada Admin untuk segera disetujui.</p>
<br>
<p>Salam,</p>
<p>Admin</p>