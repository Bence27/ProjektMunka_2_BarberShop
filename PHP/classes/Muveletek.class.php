<?php
    session_start();
    class Muveletek extends Adatkapcs
    {          
        public $uzenet = "";
        public function Osszes_Szolgaltatas_Lekeres()
        {
            $sql="SELECT id, nev, koltseg, ido, idoegyseg, aktiv FROM szolgaltatasok";
            $this -> connection();
            return $this -> getDatas($sql);
        }

        
        public function OsszesAktSzolg()
        {
            $aktiv = 1;
            $sql="SELECT id, nev, koltseg, ido, idoegyseg, aktiv FROM szolgaltatasok WHERE aktiv = :id";
            $this -> connection2();
            return $this->getDatas3($sql, $aktiv);
        }


        public function Szolgaltatas_Aktiv_Modosit()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);
            $id = $kereseredm["id"];
            $aktiv = $kereseredm["aktiv"];

            if($aktiv == 0)
            {
                $sql="UPDATE szolgaltatasok SET aktiv = '1' WHERE id = :id";
            }
            else
            {
                $sql="UPDATE szolgaltatasok SET aktiv = '0' WHERE id = :id";
            }
            $this -> connection2();
            return $this->getDatas3($sql, $id);
        }


        public function Szolgaltatas_Torol()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);

            $id=$kereseredm["id"];
            $sql="DELETE FROM szolgaltatasok WHERE id = :id";

            $this -> connection2();
            return $this->getDatas3($sql,$id);
        }


        public function Uj_Szolgaltatas_Mentes()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);
            $nev=$kereseredm["nev"];
            $koltseg=$kereseredm["koltseg"];
            $ido=$kereseredm["ido"];
            $idoegyseg=$kereseredm["idoegyseg"];
            $aktiv=$kereseredm["aktiv"];

            $sql="INSERT INTO szolgaltatasok (nev, koltseg, ido, idoegyseg, aktiv)
            VALUES (:nev, :koltseg, :ido, :idoegyseg, :aktiv)";
            $this -> connection2();
            return $this->getDatas9($sql, $nev, $koltseg, $ido, $idoegyseg, $aktiv);
        }


        public function Szolgaltatas_Modosit_Betolt()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);

            $id=$kereseredm["id"];
            $sql="SELECT * FROM szolgaltatasok WHERE id = :id";
            $this -> connection2();
            return $this->getDatas3($sql,$id);
        }


        public function Szolgaltatas_Modosit_Mentes()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);

            $id=$kereseredm["id"];
            $nev=$kereseredm["nev"];
            $koltseg=$kereseredm["koltseg"];
            $ido=$kereseredm["ido"];
            $idoegyseg=$kereseredm["idoegyseg"];
            $aktiv=$kereseredm["aktiv"];

            $sql="UPDATE szolgaltatasok SET nev = :nev, koltseg = :koltseg, ido = :ido, idoegyseg = :idoegyseg, aktiv = :aktiv WHERE id = :id";
            $this -> connection2();
            return $this->getDatas10($sql, $id, $nev, $koltseg, $ido, $idoegyseg, $aktiv);
        }


        public function Osszes_Foglalt_Idopont()
        {
            $sql="SELECT kezdes, vege FROM foglalasok";
            $this -> connection();
            return $this -> getDatas($sql);
        }


        public function FoglalasokLeker()
        {
            $sql="SELECT * FROM foglalasok";
            $this -> connection();
            return $this -> getDatas($sql);
        }


        public function Foglalas_Torol()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);
            $id=$kereseredm["id"];
            $sql="DELETE FROM foglalasok WHERE id=:id";
            $this -> connection2();
            return $this->getDatas3($sql, $id);
        }



        public function Teljesites_Rogzites()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);
            $id=$kereseredm["id"];
            $sql="UPDATE foglalasok SET teljesitve='1' WHERE id = :id";

            $this -> connection2();
            return $this->getDatas3($sql, $id);
        }


        public function Admin_Leker()
        {
            $sql="SELECT * FROM adminok";
            $this ->connection();
            return $this->getDatas($sql);
        }


        public function Admin_Torol()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);
            $id=$kereseredm["id"];
            $sql="DELETE FROM adminok WHERE id = :id";
            $this -> connection2();
            return $this->getDatas3($sql, $id);
        }


        public function SzolgaltatasKeres($id)
        {
            $sql="SELECT id, nev, koltseg, ido, idoegyseg FROM szolgaltatasok WHERE id = :id";
            $this -> connection2();
            return $this -> getDatas3($sql, $id);
        }


        public function Szolgaltatas_Lekeres()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);

            $id=$kereseredm["szolgID"];
            
            $sql="SELECT id, nev, koltseg, ido, idoegyseg FROM szolgaltatasok WHERE id = :id";
            $this -> connection2();
            return $this -> getDatas3($sql, $id);
        }


        public function FoglalasLeadas()
        {
            $adatok = file_get_contents("php://input");
            $kereseredm = json_decode($adatok, true);

            $nev = $kereseredm["nev"];
            $tel = $kereseredm["tel"];
            $email = $kereseredm["email"];
            $kezdes = $kereseredm["kezdes"];
            $vege = $kereseredm["vege"];
            $szolgaltatas = $kereseredm["szolgaltatas"];
            $teljesitve = 0;
            
            $sql="INSERT INTO foglalasok (nev, telszam, email, kezdes, vege, szolgID, teljesitve)
            VALUES (:nev, :telszam, :email, :kezdes, :vege, :szolgID, :teljesitve)";
            $this -> connection2();
            $this -> getDatas2($sql, $nev, $tel, $email, $kezdes, $vege, $szolgaltatas, $teljesitve);
            $this -> uzenet = "Sikeres rendelés leadás!";

            $mail = new Emails();
            $mail -> Viszaigazolas($kereseredm);

            return json_encode($this -> uzenet, JSON_UNESCAPED_UNICODE);
        }
    }
?>