<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=yes minimum-scale=1, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes">
    <title>PRÉMIUM BARBER SHOP</title>
    <link rel="stylesheet" href="Main\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" href="Main/css/index.css">
    <link rel="stylesheet" media="screen and (min-width: 280px) and (max-width: 320px)" href="Main/css/telo320.css"/>
    <link rel="stylesheet" media="screen and (min-width: 321px) and (max-width: 360px)" href="Main/css/telo360.css" />
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 400px)" href="Main/css/telo400.css" />
    <link rel="stylesheet" media="screen and (min-width: 401px) and (max-width: 440px)" href="Main/css/telo440.css" />
    <link rel="stylesheet" media="screen and (min-width: 441px) and (max-width: 480px)" href="Main/css/telo480.css" />
    <link rel="stylesheet" media="screen and (min-width: 481px) and (max-width: 991px)" href="Main/css/tablet_hamburger.css" />
    <link rel="stylesheet" media="screen and (min-width: 992px) and (max-width: 1200px)" href="Main/css/tablet.css" />
    <link rel="stylesheet" media="screen and (min-width: 1201px) and (max-width: 1660px)" href="Main/css/laptop.css" />
    <script src="Main/js/jquery/jquery-3.6.3.min.js"></script>
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark transparent-navbar position-fixed w-100" id="nagynav">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="navbar-nav w-75 m-auto">
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('elsotartalom')">Rólunk</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('harmadiktartalom')">Szolgáltatások</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('negyediktartalom')">Nyitvatartás</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a href="http://localhost/Barber"><img class="img-fluid logokep" src="Main/img/logo.png" width="120" alt=""></a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('hetediktartalom')">Árlista</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('nyolcadiktartalom')">Kapcsolat</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)">Galéria</a>
            </h5>
        </div>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark transparent-navbar position-fixed w-100" id="kisnav" display="hidden">
  <div class="container-fluid">
    <a href="http://localhost/Barber" class="m-auto ps-5"><img class="img-fluid logokep" src="Main/img/logo.png" width="100" alt=""></a>
    <button class="navbar-toggler" type="button" id="hamburgermenu" data-bs-toggle="collapse" data-bs-target="#navbarNav2" aria-controls="navbarNav2" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav2">
        <div class="navbar-nav w-75 m-auto">
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('elsotartalom'); hamburgermenubezar();">Rólunk</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('harmadiktartalom'); hamburgermenubezar();">Szolgáltatások</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('negyediktartalom'); hamburgermenubezar();">Nyitvatartás</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('hetediktartalom'); hamburgermenubezar();">Árlista</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)" onclick="scrollToElement('nyolcadiktartalom'); hamburgermenubezar();">Kapcsolat</a>
            </h5>
            <h5 class="nav-item text-center m-auto">
                <a class="nav-link" href="javascript:void(0)">Galéria</a>
            </h5>
        </div>
    </div>
  </div>
</nav>
<!--Navbar-->


<div class=hatter>
    <img class=" hatterkep" src="Main/img/hatter.jpg" alt="Image by rawpixel.com on Freepik">
    <div class="hattersz">
        <div>
            <h1 class="display-1">PRÉMIUM BARBER SHOP</h1> 
            <br>
            <h3 class="display-1">BUDAPEST SZÍVÉBEN</h3>
            <br>
            <h3 class="display-1">1088 BUDAPEST, RÁKÓCZI ÚT 9. | ASTORIA</h3>
            <br><br>
            <a href="Aloldalak\Foglalas\foglalas.php">
                <button type="button" class="btn foglalas" id="foglalas">IDŐPONTFOGLALÁS</button>
            </a>
        </div>
    </div>
</div>


<div class="elsotartalom w-100 justify-content-center" id="elsotartalom">
    <div class="row justify-content-center m-auto w-75">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 col-xs-12 text-center">
            <img class="w-50 rolunkep" src="Main/img/rolunk.jpg" alt="">
        </div>
        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12 col-xs-12 m-auto">
            <h3 class="display-1 elsotartcim">
                Rólunk
            </h3>
            <p class="elsosz">
                Sziasztok, Adrián vagyok.
            </p>
            <p class="justified-text elsosz">
                Már régóta érdekel a barber világa, tetszik a légkör és ennek az egésznek a hangulata, szeretek beszélgetni, új embereket megismerni és ami a legfontosabb, hogy szeretek alkotni. <br> Jó érzéssel tölt el amikor a székből felállva a vendég elégedetten néz bele a tükörbe és szívesen tér vissza hozzám hétről hétre, ezért is választottam ezt a hivatást és ez miatt töltöm ezzel a minden napjaimat. <br> A szakmát Budapesten a Prémium Barber School, borbély iskolában végeztem, ahol nemzetközileg elismert barber oktatóktól tanultam meg a szakma alapjait és elsajátíthattam az izgalmas és trendi technikákat. <br> Ha kiváncsi vagy milyen a barber élmény nálam, foglalj helyet a székemben és várlak szeretettel.
            </p>
        </div>
    </div>
</div>

<div class="masodiktartalom w-100 mt-5 mb-5 text-center">
    <div class="velemeny">
        <h3 class="display-1 velemenysz">Számos oka van annak, hogy miért vagyok elégedett a<br> Premium Barber Shoppal,  de a legfontosabb hogy mindig<br> azt kapom amit megálmodtam. <br><br></h3>
        <p class="velemenysz2">- Bálint -</p>
    </div>
</div>


<div class="harmadiktartalom w-100" id="harmadiktartalom">
    <h3 class="display-1 text-center elsotartcim">Szolgáltatások</h3>
    <div class="row w-75 szolgaltatasoksor justify-content-center m-auto text-center mt-5">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card mb-5 m-auto" style="width: 18rem; height: 23rem;">
                <img src="Main/img/okkok.png" class="card-img-top mt-3 w-50 m-auto">
                <div class="card-body">
                    <p class="card-text">Minden szolgáltatásunk tartalmazza az előzetes konzultációt, igény szerint a hajmosást, illetve a munka elkészültével a finish termék kiválasztását.</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card mb-5 m-auto" style="width: 18rem; height: 23rem;" >
                <img src="Main/img/pamacs.png" class="card-img-top mt-3 w-50 m-auto">
                <div class="card-body">
                    <p class="card-text">Üzletünkben nem csak az enteriőr designnal, és szolgáltatásaink minőségével igyekszünk a maximumot nyújtani. A teljes borbély élményhez hozzátartozó, friss kávé, és üdítő ingyen jár vendégeink számára.</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card mb-5 m-auto" style="width: 18rem; height: 23rem;">
                <img src="Main/img/borotva.png" class="card-img-top mt-3 w-50 m-auto">
                <div class="card-body">
                    <p class="card-text">Csak igazíttatnál büszkeségeden, vagy teljesen új fazonra vágysz, esetleg csak frissen borotváltan szeretnél megjelenni a randidon? Nem számít, hisz számos szolgáltatásunk között biztosan megtalálod a neked tetszőt!</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card mb-5 m-auto" style="width: 18rem; height: 23rem;">
                <img src="Main/img/apafia.png" class="card-img-top mt-3 w-50 m-auto">
                <div class="card-body">
                    <p class="card-text">Nincs is jobb „pasis” program, mint a közös hajvágás! Üzletünkben édesapák és fiaik életkortól függetlenül közös hajvágásban részesülhetnek, kedvezményes áron.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="negyediktartalom w-100 justify-content-center" id="negyediktartalom">
    <h3 class="display-1 text-center elsotartcim">Nyitvatartás</h3>
    <div class="row w-75 nyitvatartassor justify-content-center m-auto text-center mt-5">
        <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-3 col-xl-1 ms-3 me-5 mb-4 elsocol nyitvatartascol">
            <div class="card nyitvatartascard m-auto" style="width: 8rem; height: 8rem;">
                <div class="card-body szineskartya">
                    <h5 class="card-title mt-4 elsotartcim telonapnev">Hétfő</h5>
                    <h6 class="card-subtitle mb-2 text-muted idopont">8:00 - 20:00</h6>
                </div>
            </div>
        </div>
        <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-3 col-xl-1 me-5 mb-4 nyitvatartascol">
            <div class="card nyitvatartascard m-auto" style="width: 8rem; height: 8rem;">
                <div class="card-body szineskartya">
                    <h5 class="card-title mt-4 elsotartcim telonapnev">Kedd</h5>
                    <h6 class="card-subtitle mb-2 text-muted idopont">8:00 - 20:00</h6>
                </div>
            </div>
        </div>
        <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-3 col-xl-1 me-5 mb-4 nyitvatartascol">
            <div class="card nyitvatartascard m-auto" style="width: 8rem; height: 8rem;">
                <div class="card-body szineskartya">
                    <h5 class="card-title mt-4 elsotartcim telonapnev">Szerda</h5>
                    <h6 class="card-subtitle mb-2 text-muted idopont">8:00 - 20:00</h6>
                </div>
            </div>
        </div>
        <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-3 col-xl-1 me-5 mb-4 nyitvatartascol">
            <div class="card nyitvatartascard m-auto" style="width: 8rem; height: 8rem;">
                <div class="card-body szineskartya">
                    <h5 class="card-title mt-4 elsotartcim telonapnev">Csütörtök</h5>
                    <h6 class="card-subtitle mb-2 text-muted idopont">8:00 - 20:00</h6>
                </div>
            </div>
        </div>
        <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-3 col-xl-1 me-5 mb-4 nyitvatartascol">
            <div class="card nyitvatartascard m-auto" style="width: 8rem; height: 8rem;">
                <div class="card-body szineskartya">
                    <h5 class="card-title mt-4 elsotartcim telonapnev">Péntek</h5>
                    <h6 class="card-subtitle mb-2 text-muted idopont">8:00 - 20:00</h6>
                </div>
            </div>
        </div>
        <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-3 col-xl-1 me-5 mb-4 nyitvatartascol">
            <div class="card nyitvatartascard m-auto" style="width: 8rem; height: 8rem;">
                <div class="card-body szineskartya">
                    <h5 class="card-title mt-4 elsotartcim telonapnev">Szombat</h5>
                    <h6 class="card-subtitle mb-2 text-muted idopont">Zárva</h6>
                </div>
            </div>
        </div>
        <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-3 col-xl-1 me-5 mb-4 nyitvatartascol">
            <div class="card nyitvatartascard m-auto" style="width: 8rem; height: 8rem;">
                <div class="card-body szineskartya">
                    <h5 class="card-title mt-4 elsotartcim telonapnev">Vasárnap</h5>
                    <h6 class="card-subtitle mb-2 text-muted idopont">Zárva</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 otodiktartalom m-auto">
        <div class="row">
            <div class="col-7 m-auto">
                <h2 class="otodikcim">FOGLALJ IDŐPONTOT</h2>
            </div>
            <div class="col-5 m-auto">
                <a href="Aloldalak\Foglalas\foglalas.php">
                    <button type="button" class="btn foglalas2"  id="foglalas2">FOGLALÁS</button>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="hatodiktartalom w-100 mt-5 mb-5 text-center">
    <div class="velemeny2">
        <h3 class="display-1 velemenysz3">Minden korosztály számára megtaláljuk a megfelelő stílust.</h3>
    </div>
</div>


<div class="hetediktartalom w-100 mt-5 mb-5 justify-content-center" id="hetediktartalom">
    <table class="table caption-top m-auto">
        <caption><h3 class="display-1 elsotartcim betol">Áraink</h3></caption>
        <tr>
            <td><b class="fs-5 betol text">Hajvágás egyhosszra</b> <br> <p class="card-subtitle mt-2 text-muted betol vagasiido">15 perc</p></td>
            <td class="text-end"><b class="fs-5 kihuz text">1.800 Ft</b></td>
        </tr>
        <tr>
            <td class="pt-4"><b class="fs-5 betol">Hajvágás</b><br> <p class="card-subtitle mt-2 text-muted betol vagasiido">45 perc</p></td>
            <td class="text-end pt-4"><b class="fs-5 kihuz">3.300 Ft</b></td>
        </tr>
        <tr>
            <td class="pt-4"><b class="fs-5 betol">Szakáll igazítás</b><br> <p class="card-subtitle mt-2 text-muted betol vagasiido">30 perc</p></td>
            <td class="text-end pt-4"><b class="fs-5 kihuz">2.000 Ft</b></td>
        </tr>
        <tr>
            <td class="pt-4"><b class="fs-5 betol">Haj- és szakállvágás</b><br> <p class="card-subtitle mt-2 text-muted betol vagasiido">60 perc</p></td>
            <td class="text-end pt-4"><b class="fs-5 kihuz">4.800 Ft</b></td>
        </tr>
        <tr>
            <td class="pt-4"><b class="fs-5 betol">Gyermek Hajvágás</b><br> <p class="card-subtitle mt-2 text-muted betol vagasiido">45 perc</p></td>
            <td class="text-end pt-4"><b class="fs-5 kihuz">2.300 Ft</b></td>
        </tr>
    </table>
</div>


<div class="nyolcadiktartalom w-100 mt-5 mb-5 text-center" id="nyolcadiktartalom">
    <h3 class="display-1 elsotartcim">Elérhetőségek</h3>
    <div class="row w-75 elerhetosegeksor justify-content-center m-auto text-center mt-5">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <img src="Main/img/hely.png" width="60" class="footerkep"><br><br>
            <b class="fs-6">Cím</b>
            <p class="card-subtitle mt-2 text-muted elerhetoseg">8143 Sárszentmihály Kossuth Lajos utca 15</p>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <img src="Main/img/telo.png" width="60" class="footerkep"><br><br>
            <b class="fs-6">Telefonszám</b>
            <p class="card-subtitle mt-2 text-muted elerhetoseg">06 30 123 4567</p>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <img src="Main/img/email.jpg" width="60" class="footerkep"><br><br>
            <b class="fs-6">E-mail Cím</b>
            <p class="card-subtitle mt-2 text-muted elerhetoseg">premiumbarbershop@gmail.com</p>
        </div>
    </div>
</div>


<div class="map w-100">
    <div class="mapouter w-100">
        <div class="gmap_canvas w-75 m-auto">
            <hr>
            <iframe class="gmap_iframe m-auto" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?hl=en&amp;q=8143 SÁRSZENTMIHÁLY, KOSSUTH LAJOS UTCA 15&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
            </iframe>
            <hr>
        </div>
    </div>
</div>


<footer class="footer" id="kapcsolat">
    <div class="w-100 text-center">
        <p class="pt-5">Premium Barber Shop Copyright 2023 Minden Jog Fenntartva!</p>
    </div>
</footer>

<!--visszaigazolás modal-->
<div class="modal fade bd-example-modal-xl" id="visszamodal" data-target="visszamodal" tabindex="-1" aria-labelledby="visszamodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content visszamodalbody">
      <div class="modal-header visszamodal-header">
        <h5 class="modal-title visszamodalcim ms-3">Visszaigazolás</h5>
        <button type="button" class="btn-close me-3 btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center visszamodal-body">
        <h1 class="text-center display-1" id="modalfocim">Foglalásodat sikeresen rögzítettük!</h1>
        <div class="text-center mt-5" style="margin-bottom: 5%;" id="modalsz">
          <h3 class="display-1">Foglalásodról e-mailben is küldünk visszaigazolást!</h3>
        </div>
        <img src="Main/img/logo.png" class="logokep" id="logokep">
      </div> 
    </div> 
  </div> 
</div>
<!--visszaigazolás modal-->


<script src="Main/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Main/js/index.js"></script>
</body>
</html>