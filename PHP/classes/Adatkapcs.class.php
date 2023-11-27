<?php
    class Adatkapcs
    {
        private $host ="localhost";
        private $name = "barbershop";
        private $user = "root";
        private $pwd = "";
        public $connect;
        public $connect2;


        protected function connection()
        {
            $conn = new mysqli($this -> host, $this -> user, $this -> pwd, $this -> name);
            $this -> connect = $conn;
        }


        protected function connection2()
        {
            $hostbelso = $this -> host;
            $namebelso = $this -> name;
            $userbelso = $this -> user;
            $pwdbelso = $this -> pwd;
            $conn2 = new PDO("mysql:host=$hostbelso;dbname=$namebelso", $userbelso, $pwdbelso);
            $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this -> connect2 = $conn2;
        }


        protected function getDatas($sql)
        {
            $result = $this -> connect -> query($sql);
            if(is_object($result))
            {
                if($result -> num_rows != 0)
                {
                    $data = $result -> fetch_all(MYSQLI_ASSOC);
                    return json_encode($data, JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    $data = array(0);
                    return json_encode($data, JSON_UNESCAPED_UNICODE);
                }
            }
            else
            {
                return $this -> connect -> error;
            }
        }


        protected function getDatas2($sql, $nev, $tel, $email, $kezdes, $vege, $szolgaltatas, $teljesitve)
        {
            try 
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':nev', $nev);
                $stmt->bindParam(':telszam', $tel);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':kezdes', $kezdes);
                $stmt->bindParam(':vege', $vege);
                $stmt->bindParam(':szolgID', $szolgaltatas);
                $stmt->bindParam(':teljesitve', $teljesitve);

                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt -> fetchAll();
    
                if(is_array($result) && !empty($result))
                {
                    json_encode($result, JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    json_encode(array("valasz" => "Nincs találat!"), JSON_UNESCAPED_UNICODE);
                }
            } 
            catch(PDOException $e) 
            {
            }
            $this -> connect2 = null;
        }


        protected function getDatas3($sql, $id)
        {
            try 
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':id', $id);

                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt -> fetchAll();
    
                if(is_array($result) && !empty($result))
                {
                    return json_encode($result, JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    return json_encode(array("valasz" => "Nincs találat!"), JSON_UNESCAPED_UNICODE);
                }
            } 
            catch(PDOException $e) 
            {
                echo "Hiba: " . $e->getMessage();   
            }
            $this -> connect2 = null;
        }


        protected function getDatas4($sql, $email)
        {
            try
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                return $stmt;
    
            } 
            catch(PDOException $e) 
            {
                echo "Hiba: " . $e->getMessage();
            }
            $this -> connect2 = null;
        }


        protected function getDatas5($sql, $email, $hashjelszo)
        {
            try
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':jelszo', $hashjelszo);
                $stmt->execute();
                return $stmt;
    
            } 
            catch(PDOException $e) 
            {
                echo "Hiba: " . $e->getMessage();
            }
            $this -> connect2 = null;
        }


        protected function getDatas6($sql, $email)
        {
            try
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                return $stmt;
    
            } 
            catch(PDOException $e) 
            {
                echo "Hiba: " . $e->getMessage();
            }
            $this -> connect2 = null;
        }


        protected function getDatas7($sql, $jelszo, $email)
        {
            try
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':jelszo', $jelszo);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                return $stmt;
    
            } 
            catch(PDOException $e) 
            {
                echo "Hiba: " . $e->getMessage();
            }
            $this -> connect2 = null;
        }


        protected function getDatas8($sql, $fnev, $emailcim, $jelszo, $socska)
        {
            try
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':email',$emailcim);
                $stmt->bindParam(':fnev', $fnev);
                $stmt->bindParam(':jelszo', $jelszo);
                $stmt->bindParam(':so', $socska);
                $stmt->execute();


                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt -> fetchAll();
    
                if(is_array($result) && !empty($result))
                {
                    return json_encode($result, JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    return json_encode(array("valasz" => "Nincs találat!"), JSON_UNESCAPED_UNICODE);
                }
            } 
            catch(PDOException $e) 
            {
                
            }
            $this -> connect2 = null;
        }


        protected function getDatas9($sql, $nev, $koltseg, $ido, $idoegyseg, $aktiv)
        {
            try
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':nev', $nev);
                $stmt->bindParam(':koltseg', $koltseg);
                $stmt->bindParam(':ido', $ido);
                $stmt->bindParam(':idoegyseg', $idoegyseg);
                $stmt->bindParam(':aktiv', $aktiv);
                $stmt->execute();


                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt -> fetchAll();
    
                if(is_array($result) && !empty($result))
                {
                    return json_encode($result, JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    return json_encode(array("valasz" => "Nincs találat!"), JSON_UNESCAPED_UNICODE);
                }
            } 
            catch(PDOException $e) 
            {
                
            }
            $this -> connect2 = null;
        }


        protected function getDatas10($sql, $id, $nev, $koltseg, $ido, $idoegyseg, $aktiv)
        {
            try
            {
                $stmt = $this -> connect2 -> prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nev', $nev);
                $stmt->bindParam(':koltseg', $koltseg);
                $stmt->bindParam(':ido', $ido);
                $stmt->bindParam(':idoegyseg', $idoegyseg);
                $stmt->bindParam(':aktiv', $aktiv);
                $stmt->execute();


                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt -> fetchAll();
    
                if(is_array($result) && !empty($result))
                {
                    return json_encode($result, JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    return json_encode(array("valasz" => "Nincs találat!"), JSON_UNESCAPED_UNICODE);
                }
            } 
            catch(PDOException $e) 
            {
                
            }
            $this -> connect2 = null;
        }


        protected function Querymuv($sql)
        {
           return $this -> connect -> query($sql);
        }


        protected function Tomb($eredm)
        {
           return $eredm -> fetch_array();
        }


        protected function Tomb2($eredm)
        {
            $eredm->setFetchMode(PDO::FETCH_ASSOC);
            $result = $eredm -> fetchAll();
            return $result;
        }

    } 
?>