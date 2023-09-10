<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-primary position-sticky top-0 mb-4">
<div class="container-fluid">
<a class="navbar-brand" href="#">
  <img src="<?php echo URLROOT; ?>/img/logo.png" width="50" height="30" class="d-inline-block align-top" alt="ArcelorMittal White-Logo">
<span class="brand-color-text">Site</span> name
</a>
<!-- Hamburger button -->
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarColor01">
  <ul class="navbar-nav me-auto">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/index">Home site</a>
    </li>
    <?php if(isset($_SESSION['user_id'])) : ?>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/pages/index">Statistics</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/pages/reports">Reports</a>
    </li>
    <?php endif; ?>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <?php if(isset($_SESSION['user_id'])) : ?>
      <li class="nav-item">
        <a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_name']; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
      </li>
    <?php else : ?>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
    </li>
  <?php endif; ?>
  </ul>
  <div class="d-flex">
    <!-- type="search" -->
    <input class="form-control me-sm-2 search-textarea" onkeyup="myFunction()" placeholder="Szukaj w pliku">
    <!-- type="submit" -->
    <!-- <button type="submit" class="btn btn-secondary my-2 my-sm-0 me-sm-2 btn-search">Szukaj</button> -->
  </div>
    <button type="submit" class="btn btn-secondary my-sm-1 me-sm-2 d-flex changeTheme">Change Theme</button>

<!-- <botton class="btn btn-circle btn-lg btn-secondary my-sm-1 me-sm-2">PR</botton> -->
</div>
</div>
</nav>
