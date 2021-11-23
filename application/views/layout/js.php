<!-- plugins:js -->
<script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?= base_url() ?>assets/js/shared/off-canvas.js"></script>
<script src="<?= base_url() ?>assets/js/shared/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= base_url() ?>assets/js/demo_1/dashboard.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/datatable/datatables.js"></script>
<!-- select2 -->
<script src="<?= base_url() ?>assets/select2/select2.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="<?php echo base_url() ?>assets/sweetalert/sweetalert2.js"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/dateFormat/dateFormat.min.js"></script>
<script src="<?php echo base_url() ?>assets/datepicker/bootstrap-datepicker.js"></script>
<!-- boostrap slider -->
<script src="<?php echo base_url() ?>assets/bootstrap-slider/js/bootstrap-slider.min.js"></script>
<!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
<!-- mask nnumber -->
<script src="<?php echo base_url() ?>assets/mask_number/jquery-mask-as-number.min.js"></script>
<!-- numeric -->
<script src="<?php echo base_url() ?>assets/numeric/jquery.numeric-min.js"></script>
<!-- Include SmartWizard JavaScript source -->
<script type="text/javascript" src="<?= base_url() ?>assets/smartWizard/js/jquery.smartWizard.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/validator/js/validator.js"></script> -->
<script src="<?= base_url() ?>assets/divider/number-divider.min.js"></script>

<script>
    $(document).ready( function () {

        $('.angka').numeric({
            negative: false
        })

        $('.separator').divide({
            delimiter: '.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.separator').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        // $('.table').DataTable();

        $('.datepicker2').datepicker({
            autoclose     : true,
            format        : "dd-M-yyyy",
            todayHighlight: true
        });

        $('.datepicker3').datepicker({
            autoclose     : true,
            format        : "yyyy-mm-dd",
            todayHighlight: true
        });

        $('.bulan_date').datepicker({
            autoclose       : true,
            format          : "MM yyyy",
            viewMode        : "months", 
            minViewMode     : "months",
            todayHighlight  : true
        });

        var btnFinish = $('<button></button>').text('Finish')
                                          .addClass('btn btn-info')
                                          .on('click', function(){ alert('Finish Clicked'); });
        var btnCancel = $('<button></button>').text('Cancel')
                                          .addClass('btn btn-danger')
                                          .on('click', function(){ $('#smartwizard').smartWizard("reset"); });

        // Smart Wizard initialize
        $('#smartwizard').smartWizard({
          selected        : 0,
          theme           : 'circles',
          transitionEffect:'fade',
          toolbarSettings: {toolbarPosition: 'bottom',
                            toolbarExtraButtons: [btnFinish, btnCancel]
                          }
        });

    } );

    // $('body').tooltip({selector: '[data-toggle="tooltip"]', trigger: "hover"});
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});

    $('select').each(function () {
        $(this).select2({
            theme       : 'bootstrap4',
            width       : 'style',
            placeholder : $(this).attr('placeholder'),
            allowClear  : Boolean($(this).data('allow-clear'))
        });
    });
</script>