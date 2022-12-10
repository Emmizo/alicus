<!-- jQuery -->
<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<!---boostrap toogle--->
<script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('custom/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('custom/sweetalert.js') }}"></script>
<script src="{{ asset('custom/adminLTE/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('custom/adminLTE/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('js/bootstrapValidator.min.js') }}"></script>
<!--- Summer Note -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src='https://foliotek.github.io/Croppie/croppie.js'></script>
<!--<script src='https://www.jqueryscript.net/demo/Select-Option-Icons-customSelect/customSelect.jquery.min.js'></script>-->
<script src='https://www.jqueryscript.net/demo/Select-Option-Icons-customSelect/customSelect.jquery.min.js'></script>
<script src="{{ asset('select2/dist/js/select2.min.js') }}" type='text/javascript'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="{{ asset('assets/js/slick.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
{{-- qrcode --}}
<script src="https://jeromeetienne.github.io/jquery-qrcode/src/jquery.qrcode.js"></script>
<script src="https://jeromeetienne.github.io/jquery-qrcode/src/qrcode.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.dirtyFields.packed.js') }}"></script>

<script src="{{ asset('jSignature-master/libs/jSignature.min.js') }}"></script>
<script src="{{ asset('jSignature-master/libs/modernizr.js') }}"></script>


<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
    rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js">
</script>




<footer class="main-footer print">
    <strong>Staff {{ Auth::user()->first_name . '  ' . Auth::user()->last_name }} on
        {{ date('Y-m-d H:i:s') }}</strong>


</footer>
<footer class="main-footer d-print-none">
    <strong>{{ config('app.name') }} &copy; {{ date('Y') }} .</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
    </div>
</footer>
