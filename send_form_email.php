<?php
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "contacto@fortuna-e.mx";
 
    $email_subject = "Nuevo Proyecto Chulos";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "Lo sentimos parece ser que hubo algunos errores con los datos ingresados. ";
 
        echo "Los errores apareceran abajo:<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Por favor regresa y verifica esos errores.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['nombre']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['comentarios'])) {
 
        died('Lo sentimos, al parecer hay un problemas con los campos de llenado, vuelve a verificar.');       
 
    }
 
     
 
    $first_name = $_POST['nombre']; // required
 
    $email_from = $_POST['email']; // required
 
    $comments = $_POST['comentarios']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'La dirección de E-mail ingresada parece no ser correcta. <br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'El nombre ingresado parece no ser válido.<br />';
 
  }

 
  if(strlen($comments) < 2) {
 
    $error_message .= 'El mensaje escrito parece no ser válido.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Detalles abajo.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 

}
?>
<?php header( 'Location: http://www.fortuna-e.mx/index.html' );?>