<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= (!empty($page)) ? $page." | " : '' ?>AJK</title>
    <!-- <script src="<?= base_url() ?>template/assets/vendors/js/vendor.bundle.base.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- plugins:css -->
    <?php $this->load->view('layout/css') ?>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php $this->load->view('layout/header')?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php $this->load->view('layout/sidebar')?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper" style="margin-left: 270px;">
            <?= $konten ?>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php $this->load->view('layout/footer') ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php $this->load->view('layout/js')?>
    <!-- End custom js for this page-->
  </body>
</html>