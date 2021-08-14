<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
    $email_to = "rekassy66@gmail.com";
    $email_subject = "GitHub mail";
 
    function died($error) {
        // your error code can go here
        echo "Error. ";
        echo "!!!.<br /><br />";
        echo $error."<br /><br />";
        echo "Please, try again.<br /><br />";
        die();
    }
    // validation expected data exists
    if(!isset($_POST['last_name']) ||
        !isset($_POST['email']) ||        
        !isset($_POST['comments'])) {
        died('hiba.');       
    }
 
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required    
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-zöÖüÜóÓőŐúÚéÉáÁűŰíÍ]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= '!!!.<br />';
  }
    $string_exp = "/^[A-Za-zöÖüÜóÓőŐúÚéÉáÁűŰíÍ .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= '!!!.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= '!!!.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= '!!!.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Adatok: \n\n";
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";   
    $email_message .= "Message: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
sleep(2);
echo "<meta http-equiv='refresh' content=\"0; url=https://reka2.github.hu/\">";
?>
 
<?php
}
?>