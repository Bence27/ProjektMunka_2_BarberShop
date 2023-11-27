<?php
    class Route
    {
        private $fullUrl;
        private $url;

        public function __construct($fullUrl)
        {
            $this -> fullUrl = $fullUrl;
            $this -> url = explode("/", $fullUrl);
        }

        public function urlRoute()
        {
            switch(end($this -> url))
            {
                case "foglaltidopontok":
                    {
                        $foglaltidopontok = new Muveletek();
                        echo $foglaltidopontok -> Osszes_Foglalt_Idopont();
                        break;
                    }
                    
                case "foglalasleadas":
                    {
                        $foglalasleadas = new Muveletek();
                        echo $foglalasleadas -> FoglalasLeadas();
                        break;
                    }

                case "Foglalas_Torol":
                    {
                        $Foglalas_Torol = new Muveletek();
                        echo $Foglalas_Torol -> Foglalas_Torol();
                        break;
                    }

                case "Teljesites_Rogzites":
                    {
                        $Teljesites_Rogzites = new Muveletek();
                        echo $Teljesites_Rogzites -> Teljesites_Rogzites();
                        break;
                    }

                case "szolgaltatasLekeres":
                    {
                        $szolgaltatasLekeres = new Muveletek();
                        echo $szolgaltatasLekeres -> Szolgaltatas_Lekeres();
                        break;
                    }

                case "foglalasokLekeres":
                    {
                        $foglalasokLekeres = new Muveletek();
                        echo $foglalasokLekeres -> FoglalasokLeker();
                        break;
                    }

                case "OsszesszolgaltatasLekeres":
                    {
                        $OsszesszolgaltatasLekeres = new Muveletek();
                        echo $OsszesszolgaltatasLekeres -> Osszes_Szolgaltatas_Lekeres();
                        break;
                    }

                case "OsszesAktSzolg":
                    {
                        $OsszesAktSzolg = new Muveletek();
                        echo $OsszesAktSzolg -> OsszesAktSzolg();
                        break;
                    }

                case "Szolgaltatas_Aktiv_Modosit":
                    {
                        $Szolgaltatas_Aktiv_Modosit = new Muveletek();
                        echo $Szolgaltatas_Aktiv_Modosit -> Szolgaltatas_Aktiv_Modosit();
                        break;
                    }

                case "Szolgaltatas_Torol":
                    {
                        $Szolgaltatas_Torol = new Muveletek();
                        echo $Szolgaltatas_Torol -> Szolgaltatas_Torol();
                        break;
                    }

                case "Uj_Szolgaltatas_Mentes":
                    {
                        $Uj_Szolgaltatas_Mentes = new Muveletek();
                        echo $Uj_Szolgaltatas_Mentes -> Uj_Szolgaltatas_Mentes();
                        break;
                    }

                case "Szolgaltatas_Modosit_Betolt":
                    {
                        $Szolgaltatas_Modosit_Betolt = new Muveletek();
                        echo $Szolgaltatas_Modosit_Betolt -> Szolgaltatas_Modosit_Betolt();
                        break;
                    }

                case "Szolgaltatas_Modosit_Mentes":
                    {
                        $Szolgaltatas_Modosit_Mentes = new Muveletek();
                        echo $Szolgaltatas_Modosit_Mentes -> Szolgaltatas_Modosit_Mentes();
                        break;
                    }

                case "bejelentkezesADMIN":
                    {
                        $bejelentkezes = new Admin();
                        echo $bejelentkezes -> belepes();
                        break;
                    }
    
                case "regisztracioADMIN":
                    {
                        $regisztracio = new Admin();
                        echo $regisztracio -> Regisztracio();
                        break;
                    }
    
                case "jelmodADMIN":
                    {
                        $jelszovaltas = new Admin();
                        echo $jelszovaltas -> ujjelszo();
                        break;
                    }
    
                case "ujjelszoADMIN":
                    {
                        $ujjelszo = new Admin();
                        echo $ujjelszo -> felejt();
                        break;
                    }
    
                case "kijelentkezesADMIN":
                    {
                        $kijelentkezes = new Admin();
                        echo $kijelentkezes -> kijelentkezes();
                        break;
                    }

                case "Admin_Leker":
                    {
                        $Admin_Leker = new Muveletek();
                        echo $Admin_Leker -> Admin_Leker();
                        break;
                    }

                case "Admin_Torol":
                    {
                        $Admin_Torol=new Muveletek();
                        echo $Admin_Torol-> Admin_Torol();
                        break;
                    }
                default:
                {
                    include "PHP/tartalom.php";
                }
            }
        }
    }
?>
