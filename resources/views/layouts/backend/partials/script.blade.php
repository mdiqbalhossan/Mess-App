<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('backend') }}/assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('backend') }}/assets/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('backend') }}/assets/vendor/js/bootstrap.js"></script>
<script src="{{ asset('backend') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="{{ asset('backend') }}/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('backend') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Main JS -->
<script src="{{ asset('backend') }}/assets/js/main.js"></script>

<!-- Page JS -->
@stack('js')

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
    @if(Session::has('message'))
    toastr.options =
    {
    "closeButton" : true,
    "progressBar" : true
    }
    toastr.success("{{ session('message') }}");
    @endif
    
    @if(Session::has('error'))
    toastr.options =
    {
    "closeButton" : true,
    "progressBar" : true
    }
    toastr.error("{{ session('error') }}");
    @endif
    
    @if(Session::has('info'))
    toastr.options =
    {
    "closeButton" : true,
    "progressBar" : true
    }
    toastr.info("{{ session('info') }}");
    @endif
    
    @if(Session::has('warning'))
    toastr.options =
    {
    "closeButton" : true,
    "progressBar" : true
    }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>