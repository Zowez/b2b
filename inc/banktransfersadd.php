<?php 

require_once '../system/function.php';

if (@$_SESSION['login'] != @sha1(md5(IP() . $seller_code))) {
    go(site);
}

if($_POST){

    $bank      = post('bank');
    $date      = post('transfer_date');
    $time      = post('time');
    $amount     = post('amount');
    $description      = post('description');

    if(!$bank || !$date || !$time || !$amount ){

        echo 'empty';

    }else{
       
        if(!is_numeric($amount)){
            echo 'number';
        }else{


            $result = $db->prepare("INSERT INTO bank_transfers SET
                seller  =:s,
                transfer_date =:td,
                time  =:t,
                amount =:a,
                description   =:d,
                bank       =:b,
                ip        =:i
            ");

            $result->execute([
                ':s'   => $seller_code,
                ':td'  => $date,
                ':t'   => $time,
                ':a'   => $amount,
                ':d'   => $description,
                ':b'   => $bank,
                ':i'   => IP()
            ]);

            if($result->rowCount()){

                
                // require_once 'class.phpmailer.php';
                // require_once 'class.smtp.php';

                // $mail = new PHPMailer();
                // $mail->Host       = $arow->smtphost;
                // $mail->Port       = $arow->smtpport;
                // $mail->SMTPSecure = $arow->smtpsec;
                // $mail->Username   = $arow->smtpmail;
                // $mail->Password   = $arow->smtpsifre;
                // $mail->SMTPAuth   = true;
                // $mail->IsSMTP();
                // $mail->AddAddress($arow->smtpkime);

                // $mail->From       = $arow->smtpmail;
                // $mail->FromName   = "Numan Doğan | B2B Havale Bildirimi";
                // $mail->CharSet    = 'UTF-8';
                // $mail->Subject    = "Havale bildirimi";
                // $mailcontent      = "
                // <p><b>Bayi Kodu :</b>".$bcode."</p>
                // <p><b>Tarih:</b>".$date."</p>
                // <p><b>Saat:</b>".$time."</p>
                // <p><b>Tutar:</b>".$amount."</p>
                // <p><b>Not :</b>".$description."</p>
                // <p><b>IP :</b>".IP()."</p>
                // ";

                // $mail->MsgHTML($mailcontent);
                // $mail->Send();

                $log = $db->prepare("INSERT INTO seller_logs SET
                    seller     =:s,
                    ip       =:i,
                    descriptions =:d
                ");
                $log->execute([
                    ':s'   => $seller_code,
                    ':i'   => IP(),
                    ':d'   => "Yeni havale bildirimi yaptı"
                ]);

                echo 'ok';
            }else{
                echo 'error';
            }


        }

        
    }

}

?>