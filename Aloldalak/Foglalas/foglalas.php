<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=yes minimum-scale=1, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes">
    <title>PRÉMIUM BARBER SHOP</title>
    <link rel="stylesheet" href="../../Main/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" media="screen and (min-width: 280px) and (max-width: 320px)" href="css/telo320.css"/>
    <link rel="stylesheet" media="screen and (min-width: 321px) and (max-width: 360px)" href="css/telo360.css" />
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 400px)" href="css/telo400.css" />
    <link rel="stylesheet" media="screen and (min-width: 401px) and (max-width: 440px)" href="css/telo440.css" />
    <link rel="stylesheet" media="screen and (min-width: 441px) and (max-width: 480px)" href="css/telo480.css" />
    <link rel="stylesheet" media="screen and (min-width: 481px) and (max-width: 991px)" href="css/tablet_hamburger.css" />
    <link rel="stylesheet" media="screen and (min-width: 992px) and (max-width: 1200px)" href="css/tablet.css" />
    <link rel="stylesheet" media="screen and (min-width: 1201px) and (max-width: 1660px)" href="css/laptop.css" />
    <script src="../../Main/js/jquery/jquery-3.6.3.min.js"></script>
</head>
<body>
<div class="container-fluid mt-5 maindiv">
  <div class="row teloelrejt">
    <h2 style="text-align:center">Szolgáltatás kiválasztása</h2>
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="card mt-5" style="margin:auto">
            <ul class="list-group list-group-flush" id="radiosPlace">

            </ul>
        </div>

        <div class="card mt-5 datum_card" id="datumokdiv" style="display:none">
          <div class="card-body datumok_div d-flex justify-content-center" id="datumok_div">
            
          </div>
        </div>

        <div class="card mt-5 idopont_card justify-content-center text-center" id="idopontokdiv" style="display:none">

        </div>


        <div class=" mt-5 mb-5" style="text-align:center">
            <a href="../../index.php">
                <button type="button" class="btn foglalas2"  id="foglalas2">Vissza</button>
            </a>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="card foglalascard">
        <img src="../../Main/img/foglalas.jpg" class="card-img-top img-fluid" alt="...">
        <div class="card-body" style="text-align:center">
            <h5 class="card-title">Premium Barbershop</h5>
            <p class="card-text szoveg">8143 Sárszentmihály Kossuth Lajos utca 15</p>
        </div>
        <ul class="list-group list-group-flush" style="height:120px;">
            <li class="list-group-item szoveg" id="kiv_szolgaltatas" style="margin:auto">Nincs még szolgáltatás kiválasztva</li>
            
        </ul>
        <div class="card-body d-flex justify-content-between hidden-card-body" style="display:none !important;">
            <span class="fw-bold szoveg">Végösszeg</span>
            <span class="fw-bold szoveg" id="ar">ingyenes</a>
        </div>
        <div class="card-body hidden-card-body" style="text-align:center; display:none !important;">
            <button type="button" id="but_folyt" onclick="Modal_betolt()" class="btn btn-dark folytatasbtn" style="width:100%"disabled >Folytatás</button>
        </div>
        </div>
    </div>
  </div>


  <div class="row teloelo">
    <div class="col-12 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <img src="../../Main/img/foglalas.jpg" class="card-img-top img-fluid" alt="...">
          <div class="card-body" style="text-align:center">
              <h5 class="card-title">Premium Barbershop</h5>
              <p class="card-text szoveg">8143 Sárszentmihály Kossuth Lajos utca 15</p>
          </div>
          <ul class="list-group list-group-flush" style="height:120px;">
              <li class="list-group-item szoveg" id="kiv_szolgaltatas2" style="margin:auto">Nincs még szolgáltatás kiválasztva</li>
              
          </ul>
          <div class="card-body d-flex justify-content-between hidden-card-body" style="display:none !important;">
              <span class="fw-bold szoveg">Végösszeg</span>
              <span class="fw-bold szoveg" id="ar2">ingyenes</a>
          </div>
          <div class="card-body hidden-card-body" style="text-align:center; display:none !important;">
              <button type="button" id="but_folyt2" onclick="Modal_betolt()" class="btn btn-dark folytatasbtn" style="width:100%"disabled >Folytatás</button>
          </div>
        </div>
    </div>

    <div class="col-12 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12 mt-5">
        <h2 style="text-align:center">Szolgáltatás kiválasztása</h2>
        <div class="card mt-5" style="margin:auto">
            <ul class="list-group list-group-flush" id="radiosPlace2">

            </ul>
        </div>

        <div class="card mt-5 datum_card" id="datumokdiv2" style="display:none">
          <div class="card-body datumok_div d-flex justify-content-center" id="datumok_div2">
            
          </div>
        </div>

        <div class="card mt-5 idopont_card2 justify-content-center text-center" id="idopontokdiv2" style="display:none">

        </div>


        <div class=" mt-5 mb-5" style="text-align:center">
            <a href="../../index.php">
                <button type="button" class="btn foglalas2"  id="foglalas22">Vissza</button>
            </a>
        </div>
      </div>
    </div>
</div>


<!--Modal-->
<div class="modal" tabindex="-1" id="Foglalas_Modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Foglalási adatok</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div class="alert alert-warning text-center" role="alert" style="display:none">
            A név és email mező kitöltése kötelező!!
      </div>

        <label for="name" class="mt-2 w-100 text-center fs-6">Név*</label>
        <input type="text" placeholder="Példa: Gipsz Jakab" class="form-control w-100 mt-3 text-start" name="" id="name" style="display:block">

        <label for="name" class="mt-4 w-100 text-center fs-6">Email*</label>
        <input type="email" placeholder="Példa: gipsz.jakab@gmail.com" class="form-control w-100 mt-3 text-start" name="" id="email" style="display:block">

        <label for="name" class="mt-4 w-100 text-center fs-6">Telefonszám (opcionális)</label>
        <input type="text" placeholder="Példa: +36 30/123-4567" class="form-control w-100 mt-3 text-start" name="" id="tel" style="display:block">

        <label for="name" class="mt-4 w-100 text-center fs-6">Időpont</label>
        <p class="mt-2 w-100 text-center fw-bold" id="idopont"></p>

        <label for="name" class="mt-4 w-100 text-center fs-6">Szolgáltatás</label>
        <p class="mt-2 w-100 text-center fw-bold" id="szolg_modal"></p>

        <label for="name" class="mt-4 w-100 text-center fs-6">Fizetendő összeg</label>
        <p class="mt-2 w-100 text-center fw-bold" id="ar_modal"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="FoglalasLead()">Foglalás</button>
      </div>
    </div>
  </div>
</div>



<script src="../../Main/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/foglalas.js"></script>
</body>
</html>