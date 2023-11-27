<?php
	session_start();
  $csrf_token = bin2hex(random_bytes(32));
  $_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="hu" id="oldal">
<head>
    <meta http-equiv="X-UA-Compatible;" content="IE=edge;text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=yes minimum-scale=1, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes">
    <title>Admin Felület</title>
    <link rel="stylesheet" href="../../Main/bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" media="screen and (min-width: 1201px) and (max-width: 1660px)" href="css/laptop.css" />
    <script src="../../Main/js/jquery/jquery-3.6.3.min.js"></script>
</head>


<?php if (!isset($_SESSION["fnev"])) : ?>
<body style="background-image:url('../../Main/img/hatter.jpg'); background-size:cover; background-repeat: no-repeat;">
<?php else: ?>
<body>
<?php endif; ?>


<div id="ideuzi" class="position-fixed w-100" style="z-index:100;"></div>
<form method="POST">
    <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $csrf_token ?>">
</form>


<?php if (!isset($_SESSION["fnev"])) : ?>
<input type="hidden" name="csrf_token" id="bejelentkezve" value="Bejelentkezés">
<?php else: ?>
<input type="hidden" name="csrf_token" id="bejelentkezve" value="<?php echo $_SESSION["fnev"]; ?>">
<?php endif; ?>


<!-- Button Bejelentkezéshez -->
<?php if (!isset($_SESSION["fnev"])) : ?>

  <div class = "kozepre">
    <div class="text-center m-auto bejelentkezeslogo"><img src="../../Main/img/logo.png" class="logokep mt-5 img-fluid" id="logokep"></div>
      <button type="button" class="btn btn-lg btn-light d-block mt-5 m-auto bejelentkezesgomb" value="Bejelentkezés" data-bs-toggle="modal" id="belepesgomb" data-bs-target="#belepesModal">
          Bejelentkezés
      </button>
  </div>
<?php endif; ?>
<!-- Button Bejelentkezéshez vége -->


<?php if (isset($_SESSION["fnev"])) : ?>
   <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark transparent-navbar">
  <div class="container-fluid">
    <a href="#"><img src="../../Main/img/logo.png" class="logokep ms-5 ps-5" id="logokep"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end pe-5 me-5" id="navbarNav">
      <div class="navbar-nav">

        <h5 class="nav-item"><button class="nav-link me-5 btn"><a href="#" onclick="Vezerlopult_betolt()" class="menu-link anav">Időpontok</a></button></h5>

        <h5 class="nav-item"><button class="nav-link me-5 btn"><a href="#" onclick="SzolgaltatasBetolt()" class="menu-link anav">Szolgáltatások</a></button></h5>

        <h5 class="nav-item"><button class="nav-link me-5 btn"><a href="#" onclick="Admin_Betolt()" class="menu-link anav">Adminisztrátorok</a></button></h5>

        <h5 class="nav-item"><button class="nav-link me-5 btn" data-bs-toggle="modal" data-bs-target="#belepesModal"><a href="#" class="menu-link anav"><?php echo $_SESSION["fnev"]; ?></a></button></h5>

      </div>
    </div>
  </div>
  
</nav>
<!--Navbar-->


<div class="tartalom container-fluid w-75">

</div>
<?php endif; ?>

<!-- Modal Bejelentkezéshez-->
<?php if (!isset($_SESSION["fnev"])) : ?>
<div class="modal fade" id="belepesModal" tabindex="-1" aria-labelledby="belepesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="belepesModalLabel">Üdvözöljük!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
      </div>
      <div class="modal-body">
        <form class="px-4 py-3" method="POST">
          <div class="form-group">
            <label for="exampleDropdownFormEmail1">Felhasználó név</label>
            <input type="text" class="form-control" id="belepofnev" name="belepofnev" required>
          </div>
          <div class="form-group mt-4">
            <label for="exampleDropdownFormPassword1">Jelszó</label>
            <input type="password" class="form-control" id="belepojelszo" name="belepojelszo" required>
          </div>

        </form>
        <div class="text-center"><button type="submit" class="btn btn-primary mt-4" data-bs-dismiss="modal" id="belepes" name="belepes">Belépés</button></div>
      </div>
      <div class="modal-footer">
        <a class="dropdown-item beja" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-dismiss="modal">Elfelejtetted a jelszavad? Új jelszó igénylése</a>
      </div>
    </div>
  </div>
</div>

<?php else: ?>

<div class="modal fade" id="belepesModal" tabindex="-1" aria-labelledby="belepesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title felhId" id="<?php echo $_SESSION["felhId2"]; ?>" >Üdv újra, <?php echo $_SESSION["fnev"]; ?></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body ">

        <a class="dropdown-item beja" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal4" data-bs-dismiss="modal">Jelszó megváltoztatása</a>
        <a class="dropdown-item mt-4 beja" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal5" data-bs-dismiss="modal">Kijelentkezés</a>

      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<!-- Modal Bejelentkezéshez-->




<!-- Modal Elfelejtett jelszó-->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Új jelszó igénylése</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="px-4 py-3" method="POST">
          <div class="form-group">
            <label for="exampleDropdownFormEmail2">Email cím</label>
            <input type="email" class="form-control" id="elfelejtettemail" placeholder="email@example.com" name="elfelejtettemail" required>
          </div>
        </form>
        <div class="text-center"><button type="submit" class="btn btn-primary mt-2" id="ujjelszogomb" name="ujjelszogomb" data-bs-dismiss="modal">Küldés</button></div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Elfelejtett jelszó-->




<?php if (isset($_SESSION["fnev"])) : ?>
<!-- Modal jelszó megváltoztatása-->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Jelszó változtatás</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="px-4 py-3" method="POST">
          <div class="form-group">
            <label for="exampleDropdownFormPassword">Új jelszó</label>
            <input type="password" class="form-control" placeholder="Password" id="jelszomod1" name="jelszomod1" required>
          </div>
          <div class="form-group  mt-4">
            <label for="exampleDropdownFormPassword">jelszó megerősítése</label>
            <input type="password" class="form-control" placeholder="Password" id="jelszomod2" name="jelszomod2" required>
          </div>
        </form>
        <div class="text-center"><button type="submit" class="btn btn-primary mb-3 mt-4" id="jelszomodosito" data-bs-dismiss="modal">Küldés</button></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Biztos ki szeretne jelentkezni?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center"><button type="submit" class="btn btn-primary" id="kijelentkezes" data-bs-dismiss="modal" name="kijelentkezes">Kijelentkezés</button></div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<!-- Modal jelszó megváltoztatása-->




<script src="../../Main/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/Admin_Vezerlopult.js"></script>
<script src="js/Admin_Manager.js"></script>
<script src="js/Admin_Szolgaltatasok.js"></script>
</body>
</html>