<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        var siteUrl = "{{ url('/') }}";
        var csrf_token = "{{ csrf_token() }}";
    </script>
    <title>{{ isset($title) ? $title . ' - ' : '' }} {{ config('app.name', 'ALCUS') }}</title>
    <link rel="icon" href="{{ url('/') }}/images/admin-logo.ico" type="image/gif" sizes="16x16">
    @include('layouts.header')
    <style>
        .tox-statusbar__branding {
            display: none !important;
        }

        .view-tiny .tox-editor-header {
            display: none !important;
            grid-template-columns: 1fr min-content;
            z-index: -11;

        }

        .view-tiny .tox-editor-header .tox-edit-area #group_note_ifr {
            background-color: grey !important;
            pointer-events: none;
        }
    </style>

    @yield('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm sidebar-collapse">
    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('layouts.footer')
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    @yield('script')
</body>

</html>
