<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.meta')
    @include('components.style')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('partials.navbar')

        @include('partials.sidebar')

        @if(session("status"))
            {{-- sweetalert --}}
            @include('sweetalert::alert')
        @endif

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('partials.footer')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    @include('components.js')
</body>
</html>
