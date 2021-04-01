<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="_token" content="{{csrf_token()}}" />
        <title>@yield('title') - Absen Kantor</title>
        <link rel="icon" type="image/x-icon" href="{{ url('favicon.png') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ url('favicon.png') }}">
        <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ url('plugins/jqvmap/jqvmap.min.css')}}">
        <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        @stack('css')
    </head>
    <body class="sb-nav-fixed">
        @include('app.navbar')
        <div id="layoutSidenav">
            @include('app.sidenav')
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                @include('app.footer')
            </div>
            @stack('modal')
        </div>
        
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('assets/js/scripts.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('assets/assets/demo/datatables-demo.js') }}"></script>
        <script src="{{ url('plugins/sparklines/sparkline.js')}}"></script>
        <script src="{{ url('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{ url('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
        <script src="{{ url('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
        <script src="{{ url('plugins/moment/moment.min.js')}}"></script>
        <script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <script src="{{ url('plugins/summernote/summernote-bs4.min.js')}}"></script>
        <script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script >
            window.setTimeout("waktu()", 1000);
 
            function waktu() {
                var waktu = new Date();
                setTimeout("waktu()", 1000);
                document.getElementById("jam").innerHTML = waktu.getHours();
                document.getElementById("menit").innerHTML = waktu.getMinutes();
                document.getElementById("detik").innerHTML = waktu.getSeconds();
            }
        </script>
        <script>
            var notificationsWrapper   = $('.dropdown-notifications');
            var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
            var notificationsCountElem = notificationsToggle.find('i[data-count]');
            var notificationsCount     = parseInt(notificationsCountElem.data('count'));
            var notifications          = notificationsWrapper.find('div.dropdown-item');

            

            Pusher.logToConsole = true;

            var pusher = new Pusher('c482b81f1d886622f42e', {
                authEndpoint: '/pusher/auth',
                cluster: 'ap1',
                encrypted: true
            });
            var channel = pusher.subscribe('pengajuancuti.{{Auth::user()->notif}}');
            channel.bind('pengajuan', function(data) {
                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
            });

            var channel = pusher.subscribe('approvalcuti.{{Auth::user()->notif}}');
            channel.bind('approval', function(data) {
                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
            });
            

            $('#calendar').fullCalendar({
                editable : false,
            });

            $(document).ready(function(){
                $(document).on('click', '#detail', function(){
                    var id = $(this).data('id');
                    var nama = $(this).data('nama');
                    var jk = $(this).data('jk');
                    var email = $(this).data('email');
                    var telp = $(this).data('telp');
                    var alamat = $(this).data('alamat');
                    var level = $(this).data('level');
                    $('#id').text(id);
                    $('#nama').text(nama);
                    $('#jk').text(jk);
                    $('#email').text(email);
                    $('#telp').text(telp);
                    $('#alamat').text(alamat);
                    $('#level').text(level);
                });
            });
            jQuery(document).ready(function(){
                $('input[name="daterange"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
                });

                $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

            });
        </script>
        @stack('js')
    </body>
</html>
