<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo_prov.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/logo_prov.png') }}">

    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('private/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->



    <link rel="stylesheet" type="text/css"
        href="{{ asset('private/vendors/css/tables/datatable/datatables.min.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/components.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/core/colors/palette-gradient.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('private/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('private/css/core/colors/palette-callout.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('add-plugins/datepicker/bootstrap-datepicker3.min.css') }}">





    <style>
        html {
            //overflow-y: scroll;
            /* Scrollbar selalu ada meskipun konten sedikit */
        }

        body {
            //  overflow-y: scroll;
            padding-right: 0 !important;
        }

        body.modal-open {
            padding-right: 0 !important;
        }

        #loading-spinner {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .loading-text {
            font-weight: bold;
        }
    </style>

    <div id="loading-spinner" class="d-none">
        <div class="d-flex align-items-center">
            <div class="spinner-border text-primary mr-2" role="status"></div>

            <span class="loading-text">Loading......</span>
        </div>
    </div>

</head>


<body id="mainBody"
    class="vertical-layout vertical-menu 2-columns fixed-navbar content-left-sidebar email-application sidebar-toggle"
    data-open="click" data-menu="vertical-menu" data-col="2-columns content-left-sidebar">


    @include('private/layout/header')


    @include('private/layout/sidebar')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            @yield('isi')
        </div>
    </div>


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('private/layout/footer')


</body>



<script src="{{ asset('private/vendors/js/vendors.min.js') }}"></script>

<script src="{{ asset('private/js/core/app-menu.js') }}"></script>
<script src="{{ asset('private/js/core/app.js') }}"></script>

<script src="{{ asset('private/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('private/js/scripts/tables/datatables/datatable-basic.js') }}"></script>

<script src="{{ asset('private/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('private/js/myscript.js') }}"></script>


<script src="{{ asset('add-plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.id.min.js">
</script>  --}}

<script>
    $.fn.datepicker.dates['id'] = {
        days: ["Minggu", "Senin", "Hari Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
        daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        daysMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        today: "Hari ini",
        clear: "Bersihkan",
        format: "dd-mm-yyyy",
        titleFormat: "MM yyyy",
        weekStart: 0
    }
</script>



@if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var status = "{{ session('status') }}";
            var message = "{{ session('message') }}";
            var icon = "{{ session('icon') }}";
            Swal.fire(status, message, icon);
        });
    </script>
@endif



<script>
    (function() {
        const body = document.getElementById('mainBody') || document.body;
        const storageKey = 'sidebarCollapsed';

        function setCookie(name, value, days = 365) {
            const d = new Date();
            d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${encodeURIComponent(value)};path=/;expires=${d.toUTCString()}`;
        }

        function applyState() {
            const saved = localStorage.getItem(storageKey);
            if (saved === 'true') body.classList.add('menu-collapsed');
            else if (saved === 'false') body.classList.remove('menu-collapsed');
        }

        function saveState() {
            const isCollapsed = body.classList.contains('menu-collapsed');
            localStorage.setItem(storageKey, isCollapsed ? 'true' : 'false');
            // optional: set cookie so backend can use it
            setCookie(storageKey, isCollapsed ? '1' : '0', 365);
        }

        // Bind common toggle selectors (sesuaikan jika togglemu beda)
        const toggleSelectors = [
            '.nav-toggle',
            '.menu-toggle',
            '.sidebar-toggle',
            '.toggle-sidebar',
            '[data-toggle="sidebar"]',
            '[data-toggle="menu"]'
        ];

        function bindToggles() {
            toggleSelectors.forEach(sel => {
                document.querySelectorAll(sel).forEach(el => {
                    if (el.dataset._sidebarBound) return;
                    el.addEventListener('click', () => {
                        // beri delay kecil supaya script lain punya waktu mengubah class dulu
                        setTimeout(saveState, 80);
                    });
                    el.dataset._sidebarBound = '1';
                });
            });
        }

        // Apply saved state on DOM ready & on window load (safer)
        document.addEventListener('DOMContentLoaded', () => {
            applyState();
            bindToggles();
        });
        window.addEventListener('load', applyState);

        // Jika DOM berubah (mis. toggle dibuat dinamis), re-bind
        const domObs = new MutationObserver(bindToggles);
        domObs.observe(document.body, {
            childList: true,
            subtree: true
        });

        // Observe class changes pada body — bila ada perubahan class record ke storage
        const classObs = new MutationObserver(muts => {
            for (const m of muts) {
                if (m.attributeName === 'class') {
                    saveState();
                    break;
                }
            }
        });
        classObs.observe(body, {
            attributes: true,
            attributeFilter: ['class']
        });

    })();
</script>


</script>


</html>
