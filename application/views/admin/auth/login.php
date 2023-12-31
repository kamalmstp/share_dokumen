<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('admin/partials/head.php') ?>
</head>
<body class="hold-transition login-page" style="
        background-image: url(<?= base_url('assets/images/background/bg1.jpg')?>);
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: -10;
        top: 0;
        left: 0;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-info">
    <div class="card-header text-center">
      <a href="<?= site_url('admin/auth/login') ?>" class="h1"><b>Share</b>Dokumen</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?= form_open('admin/auth/login') ?>

        <?php if($mode == 'username') { ?>
        <div class="input-group mb-3">
          <input type="text" name="_username_" class="form-control" placeholder="Username" value="<?= set_value('_username_'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <?php } elseif($mode == 'email') { ?>
        <div class="input-group mb-3">
          <input type="email" name="_email_" class="form-control" placeholder="Email" value="<?= set_value('_email_'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php } ?>

        <div class="input-group mb-3">
          <input type="password" name="_password_" class="form-control" placeholder="Password" value="<?= set_value('_password_'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-info">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-info btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>

      <?= form_close() ?>

      <!-- <a href="<?= site_url('admin/auth/register') ?>" class="text-center">Register a new membership</a> -->

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php $this->load->view('admin/partials/javascript.php') ?>

</body>
</html>