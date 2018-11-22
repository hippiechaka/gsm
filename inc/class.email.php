<?php

class EnvioEmails
{
	
	function __construct()
	{
		date_default_timezone_set('Etc/UTC');
	}
	function enviar($to,$nameto,$subject,$body,$from,$fromname,$scriptorigen="sections/mail/"){




    		$mail = new PHPMailer\PHPMailer\PHPMailer();
			

			$mail->IsSMTP();
			$mail->SMTPDebug  = 0;
			$mail->Debugoutput = 'html';
			$mail->Host       = 'mail.k-i.co'; 
			$mail->Port       = 587;
			$mail->SMTPSecure = "tls";
			$mail->SMTPAuth   = true;
			$mail->Username   = 'gmi@k-i.co';  
			$mail->Password   = 'x52AuQn_x[-';  
			$mail->SetFrom($from, $fromname);
			$mail->AddReplyTo($from, $fromname);
			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);

			$cuentas=explode(",",$to);
			foreach ($cuentas as $key => $value) {
				if ($key>0) $mail->AddBCC($value,$nameto);
				else $mail->AddAddress($value,$nameto);
			}
			
			
			$mail->Subject = $subject;
			$mail->MsgHTML($body);
			$mail->AltBody = "UTILICE UN CLIENTE DE CORREO CON SOPORTE HTML  ";
			
			if(!$mail->Send()) {
				//echo "Mailer Error: " . $mail->ErrorInfo;
				return 0;
			} else {
			  	return 1;
			}
	}
	function leer($lru){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $lru);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		$feedData = curl_exec($ch); 
		curl_close($ch); 
		return @$feedData;
	}
}
?>