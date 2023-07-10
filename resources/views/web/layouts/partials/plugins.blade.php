<?php
/**
 * Plugins
 */
?>
<script src="{{ asset('static/web/scripts/default/jquery.min.js') }}"></script>
<script src="{{ asset('static/web/scripts/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('static/web/scripts/plugins/lazysizes.min.js') }}"></script>
<script src="{{ asset('static/web/scripts/plugins/owl.carousel.min.js') }}"></script>
<script src="{{ asset('static/web/scripts/plugins/particles.min.js') }}"></script>
<script src="{{ asset('static/web/scripts/plugins/jquery.mCustomScrollbar.min.js') }}"></script>
<script src="{{ asset('static/web/scripts/plugins/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('static/web/scripts/plugins/chart.js') }}"></script>
<script src="{{ asset('static/web/scripts/plugins/aos.js') }}"></script>
<script src="{{ asset('static/web/scripts/ui.js') }}"></script>


<script src="{{ asset('static/web/scripts/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('static/web/scripts/default/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('static/web/scripts/default/validate/additional-methods.js') }}"></script>


<script src="{{ asset('static/web/scripts/ajax.js') }}"></script>

<script>
  let _getProductCategory = '{{route('web.ajax.getProductCategory')}}';
  let _saveContactUri = '{{route('web.ajax.contact.form')}}';
</script>
