<div class="row " style="margin-left: 0; margin-right: 0">

<?php if (isset($_SESSION['user'])):?>


<label for="sidebar-toggle" class="menu-bg"></label>
<nav class="vertical-nav">
  <section class="navbar">
    <label for="sidebar-toggle" class="menu-icon"><i class="hamburger"></i></label>
    <div class="btn-group">
      <!-- <button type="button" class="btn bg-white dropdown-toggle ml-1 mt-1 pt-1 pb-1 pl-1 pr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?= $_SESSION['lang'] ?? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ?>
      </button> -->
    </div>
    <div class="container m-0">
      <div class="mb-4 mt-3">
        
        <div class="d-flex align-items-center"><img src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_960_720.png" alt="..." width="70" class="mr-3 rounded-circle shadow-sm">
          <div class="media-body" >
            <h4 class="m-0 text-white" id="nav-text"><?=$user->name;?></h4>
          </div>
        </div>
      </div>
    </div>
    <div class="container p-0">
      <ul class="nav flex-column mb-0">
        <li class="nav-item pt-3">
            <a class="btn text-white" href="/<?=$displayLang;?>/wallet"><i class="material-icons">account_balance_wallet</i> <span id="nav-text"> <?=strtoupper($lang[$displayLang]['wallet']);?></span></a>
        </li>
        <li class="nav-item pt-3">
          <a class="btn text-white" href="/<?=$displayLang;?>/profile"><i class="material-icons"> perm_identity </i><span id="nav-text"> <?=strtoupper($lang[$displayLang]['profile']);?></span></a>
        </li>
        <li class="nav-item pt-3">
          <a class="btn text-white" href="/<?=$displayLang;?>/chat"><i class="material-icons">chat</i> <span id="nav-text"> <?=strtoupper($lang[$displayLang]['chat']);?></span></a>
        </li>
        <li class="nav-item pt-3">
            <a class="btn text-white" href="/<?=$displayLang;?>/market"><i class="material-icons">local_offer</i><span id="nav-text"> <?=strtoupper($lang[$displayLang]['market']);?></span></a>
        </li>
        <li class="nav-item pt-3">
            <a class="btn text-white" href="/<?=$displayLang;?>/my-works"><i class="material-icons"> work </i> <span id="nav-text"> <?=strtoupper($lang[$displayLang]['myOffers']);?></span></a>
        </li>
      </ul>
    </div>
    <div class="form-group mt-4">
      <select class="form-control" id="language_selector">
        <option value="es">ES</option>
        <option value="ca">CA</option>
        <option value="en">EN</option>
      </select>
    </div>
    <div class="container">
      <ul class="nav flex-column mb-0">
        <li class="nav-item pt-3">
            <a class="btn text-white" href="/logout"><i class="material-icons">power_settings_new</i></a>
        </li>
      </ul>
    </div>
      
  </section>
</nav>
<!-- 
<nav class="vertical-nav">
  <button onclick="toogleNav()"><i class="fas fa-bars"></i></button>

</nav> -->

<?php else :?>

<div class="col-12 p-0">
  <nav id ="horizontalMenu" class="navbar navbar-expand-md navbar-dark bg-primary">
    <a class="navbar-brand order-0 order-md-0" href="/<?=$displayLang;?>/home"><strong>CRONOSE</strong></a>

    <button class="order-2 order-md-3 navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3 order-md-1" id="language">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="btn" href="/<?=$displayLang;?>/about-us"><i class="fa fa-address-card"></i> <?=strtoupper($lang[$displayLang]['aboutUs']);?></a>
        </li>
        <li class="nav-item">
          <a class="btn" href="/<?=$displayLang;?>/home"><i class="fas fa-map-pin"></i> <?=strtoupper($lang[$displayLang]['howWorks']);?></a>
        </li>
        <li class="nav-item">
          <a class="btn" href="/<?=$displayLang;?>/home"><i class="fas fa-map-pin"></i> <?=strtoupper($lang[$displayLang]['contact']);?></a>
        </li>
        <li class="nav-item">
          <a class="btn" href="/<?=$displayLang;?>/home"><i class="fas fa-map-pin"></i> FAQ</a>
        </li>
        <li class="nav-item">
          <a class="btn" href="/<?=$displayLang;?>/market"><i class="fas fa-map-pin"></i> <?=strtoupper($lang[$displayLang]['market']);?></a>
        </li>
      </ul>
      <div class="dropdown-divider"></div>
      <ul class="navbar-nav" id="language_selector" name="lang">
        <li class="nav-item" value="es" id="es">
          <a href="/es/<?= $auxUriString; ?>" class="nav-link">ES <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item" value="ca" id="ca">
          <a href="/ca/<?= $auxUriString; ?>" class="nav-link">CA</a>
        </li>
        <li class="nav-item" value="en" id="en">
          <a href="/en/<?= $auxUriString; ?>" class="nav-link">EN</a>
        </li>
      </ul>
    </div>
    <div class="order-1 order-md-2">
      <a class="login-btn" href="/login"><?=$lang[$displayLang]['logIn'];?></a>
      <a href="/register"><button type="button" class="btn btn-secondary btn-lg register"><?=$lang[$displayLang]['register'];?></button></a>

    </div>
  </nav>

<?php endif ?>

<script>
  $(document).ready(function(){

    $('#language_selector .nav-item').each(function(index) {
      const target = $(this);
      if (target.attr('value') == '<?= $displayLang ?? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ?>') {
        target.addClass('active');
      }
    });
  });
</script>
