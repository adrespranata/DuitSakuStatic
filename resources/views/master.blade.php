<!DOCTYPE html>
<html lang="en">

{{-- Section styles --}}
@include('includes.head')
{{-- Section styles --}}

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            {{-- Section Footer --}}
            @yield('content')
            {{-- Section Footer End --}}

            {{-- Section Footer --}}
            @include('includes.footer')
            {{-- Section Footer End --}}
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- Section Logout Modal --}}
    @include('includes.logout')
    {{-- Section Logout Modal End --}}

    {{-- Section Script --}}
    @include('includes.script')
    {{-- Section Script End --}}

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        </script>
    @endif
</body>

</html>
