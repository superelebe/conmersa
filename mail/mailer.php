<?php

    require("class.phpmailer.php");

    $errors = '';

$nombre = $_POST['nombre']; 
$empresa = $_POST['empresa']; 
$email =$_POST['email'];
$telefono = $_POST['telefono'];
$msj= $_POST['msj'];

$asunto ="Gracias por contactarte con nosotros.";


$myemail_1 ='benjamin.gomez@elebegraph.com';
$myemail_2 ='contacto@conmersa.com';
// $myemail_3 ='eachavezp@guanajuato.gob.mx';
// , mporras@inmersa.com.mx, benjamin.gomez@elebegraph.com, lem.montserratporras@gmail.com';//<-----Put Your email address here.

    
    $mailuser = $email;
    
            if( empty($errors))
            
            {
                         
        
        $mail2 = new PHPMailer();
        $mail2->Host = "localhost";
        $mail2->From = $_POST['email'];
        $mail2->FromName = $_POST['nombre'];
        $mail2->Subject ="¡Hola $mail2->FromName! Gracias por contactarte con nosotros.";
        $mail2->AddAddress($_POST['email']);
        $mail2->AddAddress($myemail_1);
        $mail2->AddAddress($myemail_2);
        // $mail2->AddAddress($myemail_3);
        
        
        if ($varname != "") {
            $mail2->AddAttachment($vartemp, $varname);
        }
        $link2 ="http://www.conmersa.com"; //"http://".$_SERVER['SERVER_NAME'];
        $body ="<html>
<html xmlns'http://www.w3.org/1999/xhtml'>
<html lang'es' class'no-js'>
<meta http-equiv'Content-Type' content'text/html; charset=UTF-8' />
<head>
</head>
<body>          


<table class='body-wrap'>
    <tr>
        <td></td>
        <td class='container' >

            <div class='content'>
            <table>
                <tr>
                    <td>
                    <img src='http://conmersa.com/images/logo_cont_mini.png' alt='Conmersa_logo' width='100px'>
                        <h3 style='color:black' >Gracias $nombre por contactarnos</h3>
                        <p style='color:#666' class='lead'>Confirmamos tus datos :</p>
                        <p>
                            
                           <strong style='color:#0069a4; font-ewight:bolder;' >Email:</strong>". $email."<br/>
                         <strong style='color:#0069a4; font-ewight:bolder;' >Teléfono:</strong>". $telefono."<br/>
                            <strong style='color:#0069a4; font-ewight:bolder;' >Empresa:</strong>". $empresa."<br/>
                            
                            <strong style='color:#0069a4; font-ewight:bolder;' > Mensaje:</strong>  ".$msj. " <br/>
                            
                        </p>
                        <!-- Callout Panel -->
                        <p style='color:#666' class='callout'>
                            A la brevedad contestaremos tus dudas y comentarios.<br/><br/>
                                                
                        <!-- social & contact -->
                        <table class='social' width='100%'>
                            <tr>
                                <td>
                                                                      
                                    <!-- column 2 -->
                                    <table align='left' class='column'>
                                        <tr>
                                            <td>                
                                                                            
                                                <h5 style='color:#666' class=''>CONMERSA</h5>                                               
                                                <p><strong> Conexión en Mercadotecnia S.A. de C.V.</strong><br/>
                                                Email: <strong><a href='emailto:'>contacto@conmersa.com </a></strong></p>
                                                <p>Teléfono: <strong> 477 7 514 6666</strong></p>
                
                                            </td>
                                        </tr>
                                    </table><!-- /column 2 -->
                                    
                                    <span class='clear'></span> 
                                    
                                </td>
                            </tr>
                        </table><!-- /social & contact -->
                        
                    </td>
                </tr>
            </table>
            </div>
                                    
        </td>
        <td></td>
    </tr>
</table>


<table class='footer-wrap'>
    <tr>
        <td></td>
        <td class='container'>
            
                <!-- content -->
                <div class='content'>
                <table>
                <tr>
                    <td align='center'>
                        <p>
                            © Todos los derechos Reservados, 2017.<a href='' >Aviso de Privacidad</a>.
                        </p>
                    </td>
                </tr>
            </table>
                </div><!-- /content -->
                
        </td>
        <td></td>
    </tr>
</table>
</body>         
</html>  ";
            
            
                $mail2->Body = $body;
                $mail2->IsHTML(true);
                // Activo condificacción utf-8
                $mail2->CharSet = 'UTF-8';
                echo $mail2->Send();



    
                
                
             
  
 }   
?>












