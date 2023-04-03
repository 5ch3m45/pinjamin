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

$('#toggle-password').on('click', function() {
    let show = $(this).data('show');
    if(show == 0) {
        $('input[name=password]').attr('type', 'text');
        $(this).html('<i class="bi bi-eye-slash"></i>')
        $(this).data('show', 1);
    } else {
        $('input[name=password]').attr('type', 'password');
        $(this).html('<i class="bi bi-eye"></i>')
        $(this).data('show', 0);
    }
});