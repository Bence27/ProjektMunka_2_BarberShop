<?php
    session_start();
    class Admin extends Adatkapcs
    {
        public $uzenet = "";
        public function ellenorzes($fnev, $email, $jelszo, $jelszo2) 
        {
            if (empty($fnev) || empty($email) || empty($jelszo) || empty($jelszo2)) 
            {
                $this -> uzenet = "Kérem töltsön ki minden mezőt!";
                return false;
            }
            else if ($jelszo != $jelszo2) 
            {
                $this -> uzenet = "A két jelszó nem azonos!";
                return false;
            }
            else 
            {
                return true;
            }
        }


        //vizsgálat hogy van-e ilyen admin már
        public function ujadmin($fnev) 
        {
            $this -> connection2();
            $vanilyen = "SELECT fnev
                        FROM adminok
                        WHERE fnev = :email";

            $eredmeny = $this -> getDatas4($vanilyen, $fnev);

            if ($eredmeny->rowCount() == 0)
            {
                return true;
            }
            else
            {
                $this -> uzenet = "Foglalt email/felhasználónév!";
                return false;
            }
        }


        public function Regisztracio()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);

            $ures = $this -> ellenorzes($kereseredm["fnev"], $kereseredm["email"], $kereseredm["jelszo1"], $kereseredm["jelszo2"]);
            $van = $this -> ujadmin($kereseredm["fnev"]);
            if ($ures && $van)
            {
                $so = $this -> sozas(3);
                $kereseredm["jelszo1"].=$so;
                $reg = "INSERT INTO adminok (fnev, email, jelszo, so)
                        VALUES (:fnev, :email, :jelszo, :so)";
                $fnev = $kereseredm["fnev"];
                $emailcim = $kereseredm["email"];
                $jelszo = hash("sha256",$kereseredm["jelszo1"]);
                $socska = $so;


                $this -> connection2();
                $this -> getDatas8($reg, $fnev, $emailcim, $jelszo, $socska);

                $this -> uzenet = "Regisztráció sikeres!";
            }

            return json_encode($this -> uzenet, JSON_UNESCAPED_UNICODE);
        }


        //Űrlap kitöltöttségének ellenőrzése:
        function Urlapellenorzes($email,$jelszo) 
        {
            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            $jelszo = htmlspecialchars($jelszo, ENT_QUOTES, 'UTF-8');
            if ($email == "" || $jelszo == "") 
            { 	
                $this -> uzenet = "Kérem töltsön ki minden mezőt!";
                return false;
            }
            else 
            {
                return true;
            }
        }
        

        //A felhasználónév meglétének ellenőrzése illetve a só lekérése:
        function fnevSo($fnev, $jelszo)
        {
            $fnev = htmlspecialchars($fnev, ENT_QUOTES, 'UTF-8');
            $jelszo = htmlspecialchars($jelszo, ENT_QUOTES, 'UTF-8');
            $s = "SELECT so
            FROM adminok
            WHERE fnev = :email";
            $this -> connection2();
            $eredmeny = $this -> getDatas4($s, $fnev);

            if ($eredmeny->rowCount() != 0)
            {
                $so = $this -> Tomb2($eredmeny);
                $jelszo.=$so[0]['so'];
                return $jelszo;
            }
            else 
            {
                $this -> uzenet = "Rossz felhasználónév, vagy jelszó!";
                return false;
            }	
        }


        //Felhasználó bejelentkeztetése:
        function belepes()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);
            if ($kereseredm["token"] === $_SESSION['csrf_token']) 
            {
                $ellenorzes = $this -> Urlapellenorzes($kereseredm["fnev"], $kereseredm["jelszo"]);
                $sozas = $this -> fnevSo($kereseredm["fnev"], $kereseredm["jelszo"]);
                if ($ellenorzes && $sozas)
                {
                    $fnev = $kereseredm['fnev'];
                    $fnev = htmlspecialchars($fnev, ENT_QUOTES, 'UTF-8');

                    $hashjelszo = hash('sha256',$sozas);
                    $belep = "SELECT id, fnev, jelszo
                    FROM adminok
                    WHERE fnev = :email AND jelszo = :jelszo";
                    $this -> connection2();
                    $e = $this -> getDatas5($belep, $fnev, $hashjelszo);

                    $id = "SELECT id
                    FROM adminok
                    WHERE fnev = :email";
                    $this -> connection2();
                    $er = $this -> getDatas4($id, $fnev);

                    if ($e->rowCount() != 0)
                    {
                        $_SESSION["fnev"] = $kereseredm["fnev"];


                        $azon = $this -> Tomb2($er);
                        $_SESSION["felhId2"] = $azon[0]['id'];


                        $this -> uzenet = "Sikeres bejelentkezés";
                    }
                    else 
                    {
                        $this -> uzenet = "Nem megfelelő jelszó!";
                    }
                }
            }
            else
            {
                $this -> uzenet = "Nem megfelelő CSRF token!";
            }
            return json_encode($this -> uzenet, JSON_UNESCAPED_UNICODE);
        }


        function ujjelszo() 
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);
            if ($kereseredm["token"] === $_SESSION['csrf_token']) 
            {
                $jelszo1 = $kereseredm["jelszo"];
                $jelszo2 = $kereseredm["jelszo2"];
                $jelszo1 = htmlspecialchars($jelszo1, ENT_QUOTES, 'UTF-8');
                $jelszo2 = htmlspecialchars($jelszo2, ENT_QUOTES, 'UTF-8');

                if ($jelszo1 != "" && $jelszo2 != "") 
                {
                    if ($jelszo1 == $jelszo2) 
                    {
                        
                        //só lekérdezése:
                        $sessionfnev = $_SESSION["fnev"];
                        $s = "SELECT so
                            FROM adminok
                            WHERE fnev = :email";
                        $this -> connection2();
                        $so = $this -> getDatas4($s, $sessionfnev);

        
                        //ha megvan a só:
                        if ($so->rowCount() != 0)
                        {
                            $soz = $this -> Tomb2($so);
                            $jelszo1.=$soz[0]['so'];
                            $jelszoval = "UPDATE adminok
                            SET jelszo = :jelszo
                            WHERE fnev = :email";
                            $this -> connection2();
                            $this -> getDatas5($jelszoval, $_SESSION["fnev"], hash('sha256', $jelszo1));
        
                                    //ha sikerült az adatbázisban módosítani:
                                    $this -> uzenet = "Jelszóváltás sikeres!";
                        }
                        //ha nincs meg a só:
                        else 
                        {
                            $this -> uzenet = "Sajnos nem sikerült, próbálja meg újra!";
                        }
                    }
                    //ha nem egyezik a két jelszó:
                    else 
                    {
                        $this -> uzenet = "A két jelszó nem egyezik!";
                    }	
                }
                //ha nem töltötte ki az űrlap mezők valamelyikét (vagy egyiket sem)
                else 
                {
                    $this -> uzenet = "Kérem adja meg az adatokat!";
                }
            }
            else
            {
                $this -> uzenet = "Nem megfelelő CSRF token!";
            }
            return json_encode($this -> uzenet, JSON_UNESCAPED_UNICODE);
        }


        function felejt() 
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);
            if ($kereseredm["token"] === $_SESSION['csrf_token']) 
            {
                $emailcim = $kereseredm["email"];
                $emailcim = htmlspecialchars($emailcim, ENT_QUOTES, 'UTF-8');
                if ($emailcim != "") 
                {
                    $uj="SELECT email, so, fnev
                        FROM adminok
                        WHERE email = :email";

                    $this ->connection2();
                    $lekerdezes = $this -> getDatas6($uj, $emailcim);
                    
                    
                    if ($lekerdezes->rowCount() != 0) 
                    {
                        //új jelszó generálása
                        $veletlenjelszo = $this -> sozas(10);
                        //só hozzátétele:
                        $so = $this -> Tomb2($lekerdezes);
                        $jelszo = $veletlenjelszo.$so[0]['so'];
                        $fnev = $so[0]["fnev"];
                        //felülírás az adatbázisban:
                        $update = "UPDATE adminok
                                    SET jelszo = :jelszo 
                                    WHERE email = :email"; 
                            
                        $this ->connection2();
                        $this -> getDatas7($update, hash("sha256",$jelszo), $emailcim);
                        $this -> uzenet = "Új jelszavát elküldtük az emailcímére!";


                        //elküldés emailben:
                        $emailkuldes = new Emails();
                        $emailkuldes -> Levelkuldes($emailcim, $veletlenjelszo, $fnev);
                    }							
                    else 
                    {
                        $this -> uzenet = "Az e-mail nem megfelelő!";
                    }
                }
                else 
                {
                    $this -> uzenet = "Kérem adjon meg minden adatot!";
                }
            }
            else
            {
                $this -> uzenet = "Nem megfelelő CSRF token!";
            }
            return json_encode($this -> uzenet, JSON_UNESCAPED_UNICODE);
        }

        
        function kijelentkezes()
        {
            unset($_SESSION["fnev"]);
            unset($_SESSION["csrf_token"]);
            unset($_SESSION["felhId2"]);
            $this -> uzenet = "Sikeres kijelentkezés!";
            return json_encode($this -> uzenet, JSON_UNESCAPED_UNICODE);
        }


        //só generálás
        public function sozas($x) 
        {  
            $so = "";  
                for ($i = 0; $i<$x; $i++) 
                {  
                    $veletlenszam = rand(48,57);  
                    $so .= Chr($veletlenszam); // [48,57]=>[0,9]
                    
                    $veletlenNB = rand(65,90);
                    $so .= Chr($veletlenNB); // [65,90] => [A,Z]  
                    
                    $veletlenKB = rand(97,122);
                    $so.= Chr($veletlenKB); // [97,122] => [a,z]   
                }
            return $so;  
        }
    }
?>