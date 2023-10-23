<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('admin/partials/head.php') ?>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <?php $this->load->view('user/partials/navbar.php') ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->load->view('admin/partials/breadcrumb.php') ?>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <div class="container-fluid">
              <div class="col-lg-12 col-9">
                <div class="container">
                  <!-- <img src="<?php echo base_url('assets/images/kominfo.png')?>" width="50px" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" styleacity: .8; display: block; margin: auto;"> -->
                  <h3 class="text-center"><b>Repositori</b></h3>
                  <p class="lead text-center">List</p>
                </div>
              </div>
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <table id="table-user" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Dokumen</th>
                        <th>File</th>
                        <th>User</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($repositori as $row) { ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['file']?></td>
                            <td><?=$row['account_name']?></td>
                            <td class="text-center">
                                <a href="<?=base_url().'view/get_download/'.$row['file']?>" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-download"> Unduh</i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('admin/partials/footer.php') ?>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php $this->load->view('admin/partials/javascript.php') ?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#table-user').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
