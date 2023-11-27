<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;
   
   //Load Composer's autoloader
    require 'Mailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'Mailer/vendor/phpmailer/phpmailer/src/Exception.php';
    require 'Mailer/vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'Mailer/vendor/autoload.php';

    class Emails
    {
        public function  Viszaigazolas($kereseredm)
        {
            $megkeres = new Muveletek();
            $eredmeny = $megkeres -> SzolgaltatasKeres($kereseredm["szolgaltatas"]);
            $eredmenytomb = json_decode($eredmeny, true);
            $targy = "Foglalás visszaigazolás";
            $uzenet = "<h1>Kedves ".$kereseredm["nev"]."!</h1><br>
            <div style='margin-top: 2.5rem; width: 100%;'><div style='border: 1px solid #dee2e6; border-radius: 1rem; margin-bottom: 20px;'><img src='https://i.imgur.com/Dw3msqu.jpg' style='max-width: 100%; border-top-left-radius: 1rem; border-top-right-radius: 1rem;' alt='...'>
            <div style='text-align: center; padding: 1rem;'><h5 style='margin-bottom: 0.5rem; font-size: 2rem !important; margin-top: 1rem;'>Premium Barbershop</h5><p style='margin-bottom: 0; font-size: 1rem;'>8143 Sárszentmihály Kossuth Lajos utca 15</p></div>
            <ul style='height: 120px; margin: 0 rem; padding: 0; list-style: none; text-align:center;'>
            <li style='margin: auto; padding: 3rem; border: 1px solid #dee2e6; border-radius: 0.25rem; font-size: 1rem;'>".$eredmenytomb[0]["nev"]."<br><br>Várunk a következő időpontban, ".date('Y-m-d H:i', strtotime($kereseredm["kezdes"]))."</li>
            </ul>
            <div style='display: flex; padding: 2rem; vertical-align:middle; margin-top:40px;'>
            <span style='font-weight: 700 !important; margin:auto; font-size: 1.3rem;'>Végösszeg:</span>
            <span style='font-weight: 700 !important; margin:auto; font-size: 1.3rem;'>".$eredmenytomb[0]["koltseg"]." Ft</span></div></div></div>";


            $mail = new PHPMailer(true);  
            try {
                //Server settings
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                    );

                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host       = 'smtp.hostinger.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'support@f1-35tech.com';
                $mail->Password   = "j9aC#iAT&uPtGH;B;/U|QO-3q)I|_hrL'x;u";
                $mail->SMTPSecure = "tls";
                $mail->Port = 587;
                $mail->CharSet = "UTF-8";
            
                //Recipients
                $mail->setFrom('support@f1-35tech.com', 'PREMIUM Barbershop');
                $mail->addAddress($kereseredm["email"]);
        

                $mail->isHTML(true);
                $mail->Subject = $targy;
                $mail->Body = $uzenet;
                $mail->SMTPDebug = 0;
                $mail->send();
            } catch (Exception $e) 
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }

        public function Levelkuldes($email, $veletlenjelszo, $fnev)
        {

            $uzenet = "<h1>Kedves ". $fnev ."!</h1><br><p style='font-size:18px;'>Az Ön új jelszava, amivel be tud jelentkezni:<strong>". $veletlenjelszo ."</strong>.</p><br><p>Kérjük bejelentkezés után azonnal változtassa meg!</p>";


            $mail = new PHPMailer(true);  
            try {
                //Server settings
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                    );

                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host       = 'smtp.hostinger.com'; 
                $mail->SMTPAuth   = true;
                $mail->Username   = 'support@f1-35tech.com';
                $mail->Password   = "j9aC#iAT&uPtGH;B;/U|QO-3q)I|_hrL'x;u";                           
                $mail->SMTPSecure = "tls";
                $mail->Port = 587;
                $mail->CharSet = "UTF-8";
            
                //Recipients
                $mail->setFrom('support@f1-35tech.com', 'PREMIUM Barbershop');
                $mail->addAddress($email);
            
            
                //Content
                $mail->isHTML(true);
                $mail->Subject = "Jelszó Visszaállítása";
                $mail->Body = $uzenet;
                $mail->SMTPDebug = 0;
                $mail->send();
            } catch (Exception $e) 
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>