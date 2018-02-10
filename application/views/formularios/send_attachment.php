<?php
foreach($informacion as $data)
{
    //Get uploaded file data
    $file_tmp_name    = $data['full_path'];
    $file_name        = $data['file_name'];
    $file_size        = $data['file_size'];
    $file_type        = $data['file_ext'];
}


$from_email         = $mail; //from mail, it is mandatory with some hosts
$recipient_email    = 'pgarcia@grimoldi.com'; //recipient email (most cases it is your personal email)

//Capture POST data from HTML form and Sanitize them,
$sender_name    = $nombre; //sender name
$reply_to_email = $mail; //sender email used in "reply-to" header
$subject        = "Curriculum"; //get subject from HTML form
$message        = $consulta; //message



//$file_error       = $_FILES['my_file']['error'];


//read from the uploaded file & base64_encode content for the mail
$handle = fopen($file_tmp_name, "r");
$content = fread($handle, $file_size);
fclose($handle);
$encoded_content = chunk_split(base64_encode($content));

$boundary = md5("sanwebe");
//header
$headers = "MIME-Version: 1.0\r\n";
$headers .= "From:".$from_email."\r\n";
$headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

//plain text
$body = "--$boundary\r\n";
$body .= "Content-Type: ".$data['file_ext']." text/plain; charset=ISO-8859-1\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
$body .= chunk_split(base64_encode($message));

//attachment
$body .= "--$boundary\r\n";
$body .="Content-Type: $file_type; name=".$file_name."\r\n";
$body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
$body .="Content-Transfer-Encoding: base64\r\n";
$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n";
$body .= $encoded_content;

$sentMail = mail($recipient_email, $subject, $body, $headers);
if($sentMail) //output success or failure messages
{
    die('Thank you for your email');
}else{
    die('Could not send mail! Please check your PHP mail configuration.');
}
