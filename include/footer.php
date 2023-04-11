
<!-- BEGIN: Footer-->

<footer class="page-footer footer footer-static footer-dark gradient-45deg-light-blue-cyan gradient-shadow navbar-border navbar-shadow">
    <div class="footer-copyright">
        <div class="container"><span>&copy; <?php date('Y') ?> LOANS-API</span><span class="right hide-on-small-only">Developed by DAVID OMADI</div>
    </div>
</footer>

<script> 
  $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal2').modal();
  });

  // Basic Select2 select
$(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.datepicker').datepicker();
  });

</script>

<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->
<script src="app-assets/js/vendors.min.js"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="app-assets/vendors/chartjs/chart.min.js"></script>
<script src="app-assets/vendors/chartist-js/chartist.min.js"></script>
<script src="app-assets/vendors/chartist-js/chartist-plugin-tooltip.js"></script>
<script src="app-assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js"></script>

<script src="app-assets/vendors/select2/select2.full.min.js"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="app-assets/js/plugins.js"></script>
<script src="app-assets/js/search.js"></script>
<script src="app-assets/js/custom/custom-script.js"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="app-assets/js/scripts/dashboard-modern.js"></script>
<!-- END PAGE LEVEL JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/scripts/advance-ui-modals.js"></script>
    <script src="app-assets/js/scripts/ui-alerts.js"></script>
    <script src="app-assets/js/scripts/form-select2.js"></script>
    <script src="app-assets/js/scripts/form-elements.js"></script>
</body>

</html>