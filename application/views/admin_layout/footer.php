</div>
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<footer class="footer">
    <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="http://www.whatsupitec.com/" target="_blank">Whatsupitec Limited</a>. All rights reserved.</span>
<!--        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>-->
    </div>
</footer>
<!-- partial -->
</div>
<!-- row-offcanvas ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->

<script src="<?php echo base_url('assets/app_assets/plugins/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets/app_assets/plugins/bootstrap-4/js/bootstrap.min.js')?>"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?php echo base_url('assets/app_assets/plugins/off-canvas.js')?>"></script>
<!--<script src="--><?php //echo base_url('assets/app_assets/plugins/misc.js')?><!--"></script>-->
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
<div id="print-div" class="print-div qr-data" style="display: none;position: relative">
</div>
</body>

</html>
<script type="text/javascript">
        var ur = window.location;
        active_url();

        function active_url() {
            $('li div ul li a').each(function () {
                var currentPage=$(this).attr('href');
                if (ur == currentPage) {
                    $(this).parent().parent().parent().parent().find('.nav-link').attr('aria-expanded',true);
                    $(this).parent().parent().parent().toggleClass('show');
                }
            });
        }
        $('.nav-item').click(function () {
            $('a').attr('aria-expanded',false);
            $('div').removeClass('show');
        });

        $('#language').change(function () {
            var val=$(this).val();
            var url=$(this).attr('about');
            var location=$(this).attr('role');
            window.location.href=url+val+'/'+location;
        });
</script>