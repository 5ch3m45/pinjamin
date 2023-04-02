/*!
* Start Bootstrap - Simple Sidebar v6.0.5 (https://startbootstrap.com/template/simple-sidebar)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
*/
// 
// Scripts
// 

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});

$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap-5',
    });

    $('#select2-tambah-pinjaman-barang-modal').select2({
        theme: 'bootstrap-5',
        dropdownParent: $('#tambah-pinjaman-barang-modal')
    });
})


/**
 * Hapus button
 */
$(document).on('click', '.hapus-admin', function() {
    $('#hapus-admin-form').attr('action', '/dashboard/admin/delete/'+$(this).data('id'));
    $('#nama-admin').text($(this).data('nama'));
    $('#hapus-admin-modal').modal('show');
});

$(document).on('click', '.hapus-barang', function() {
    $('#hapus-barang-form').attr('action', '/dashboard/barang/delete/'+$(this).data('id'));
    $('#nama-barang').text($(this).data('nama'));
    $('#hapus-barang-modal').modal('show');
});

$(document).on('click', '.hapus-lokasi', function() {
    $('#hapus-lokasi-form').attr('action', '/dashboard/lokasi/delete/'+$(this).data('id'));
    $('#nama-lokasi').text($(this).data('nama'));
    $('#hapus-lokasi-modal').modal('show');
});

$(document).on('click', '.hapus-lokasi', function() {
    $('#hapus-lokasi-form').attr('action', '/dashboard/lokasi/delete/'+$(this).data('id'));
    $('#nama-lokasi').text($(this).data('nama'));
    $('#hapus-lokasi-modal').modal('show');
});

$(document).on('click', '.hapus-pinjaman', function() {
    $('#hapus-pinjaman-form').attr('action', '/dashboard/pinjaman/delete/'+$(this).data('id'));
    $('#kode-pinjaman').text($(this).data('kode'));
    $('#hapus-pinjaman-modal').modal('show');
});



$('#tambah-pinjaman-barang').on('click', function() {
    $('#tambah-pinjaman-barang-modal').modal('show');
});



$(document).on('click', '.edit-pinjaman-barang', function() {
    $('#edit-pinjaman-barang-form').attr('action', '/dashboard/pinjaman-barang/edit/'+$(this).data('id'));
    $('#edit-kode').val($(this).data('kode'));
    $('#edit-nama').val($(this).data('nama'));
    $('#edit-tanggal_pengajuan').val($(this).data('pengajuan'));
    $('input[name=tanggal_peminjaman]').val($(this).data('peminjaman'));
    $('input[name=tanggal_pengembalian]').val($(this).data('pengembalian'));
    if($(this).data('peminjaman') == '1970-01-01') {
        $('#tolak-pinjaman-btn').attr('checked', true);
    }
    $('#edit-pinjaman-barang-modal').modal('show');
});

$('#tolak-pinjaman-btn').on('click', function() {
    $('input[name=tanggal_peminjaman]').val('1970-01-01');
});

$('input[name=tanggal_peminjaman]').on('keyup paste change', function() {
    if($(this).val() == '1970-01-01') {
        $('#tolak-pinjaman-btn').attr('checked', true);
    } else {
        $('#tolak-pinjaman-btn').attr('checked', false);
    }
})

$(document).on('click', '.hapus-pinjaman-barang', function() {
    $('#hapus-pinjaman-barang-form').attr('action', '/dashboard/pinjaman-barang/delete/'+$(this).data('id'));
    $('#nama-barang').text($(this).data('nama'));
    $('#kode-pinjaman').text($(this).data('kode'));
    $('#hapus-pinjaman-barang-modal').modal('show');
});

$(document).on('click', '.konfirmasi-pinjaman', function() {
    const _id = $(this).data('id');
    $.post('/dashboard/pinjaman-barang/edit/'+_id+'/konfirmasi-peminjaman', function(res) {
        if(res.success !== true || res.message !== 'PINJAMAN_CONFIRMED') {
            alert('Terjadi kesalahan: '+res.message)
            return;
        }
        $('#tanggal-peminjaman-'+_id).html(new Date().toISOString().split('T')[0]);
        $('.edit-pinjaman-barang[data-id='+_id+']').attr('data-peminjaman', new Date().toISOString().split('T')[0])
        return;
    })
});

$(document).on('click', '.tolak-pinjaman', function() {
    const _id = $(this).data('id');
    $.post('/dashboard/pinjaman-barang/edit/'+_id+'/tolak-peminjaman', function(res) {
        if(res.success !== true || res.message !== 'PINJAMAN_DENIED') {
            alert('Terjadi kesalahan: '+res.message)
            return;
        }
        $('#tanggal-peminjaman-'+_id).html('<span class="text-danger">TIDAK DISETUJUI</span>');
        $('.edit-pinjaman-barang[data-id='+_id+']').attr('data-peminjaman', '1970-01-01');
        return;
    })
});

$(document).on('click', '.konfirmasi-pengembalian', function() {
    const _id = $(this).data('id');
    $.post('/dashboard/pinjaman-barang/edit/'+_id+'/konfirmasi-pengembalian', function(res) {
        if(res.success !== true || res.message !== 'PENGEMBALIAN_CONFIRMED') {
            alert('Terjadi kesalahan: '+res.message)
            return;
        }
        $('#tanggal-pengembalian-'+_id).html(new Date().toISOString().split('T')[0]);
        $('.edit-pinjaman-barang[data-id='+_id+']').attr('data-pengembalian', new Date().toISOString().split('T')[0]);
        return;
    })
});

setTimeout(() => {
    $('.alert').fadeOut(500);
    setTimeout(() => {
        $('.alert').hide();
    }, 500);
}, 4000);

$(document).on('click', '.verifikasi-user', function() {
    const _id = $(this).data('id');
    const nama = $(this).data('nama');
    $('#verifikasi-user-form').attr('action', '/dashboard/user/edit/'+_id+'/verifikasi');
    $('#nama-user').text(nama);
    $('#verifikasi-user-modal').modal('show');
});

$(document).on('click', '.hapus-user', function() {
    const _id = $(this).data('id');
    const nama = $(this).data('nama');
    $('#hapus-user-form').attr('action', '/dashboard/user/delete/'+_id);
    $('#nama-user-hapus').text(nama);
    $('#hapus-user-modal').modal('show');
});

$(document).ready(function() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
})