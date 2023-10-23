<nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="<?= base_url('assets/images') ?>/100.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Share Dokumen</span>
      </a>
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Help
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">FAQ</a>
            <a class="dropdown-item" href="#">Support</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Contact</a>
          </div>
        </li>
      </ul>
      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="<?= site_url('admin') ?>" type="btn" class="btn btn-info"><i class="fa fa-sign"></i> Login</a>
        </li>
      </ul>
    </div>
  </nav>