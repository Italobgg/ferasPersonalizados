<?php
$filenameee = $_FILES['picture__input']['name'];
$fileName = $_FILES['picture__input']['tmp_name'];
$name = $_POST['name'];
$email = $_POST['email'];
$cityAndState = $_POST['cityAndState'];
$streetOrAvenue = $_POST['streetOrAvenue'];
$CEP = $_POST['CEP'];



$message =
    "Nome = " . $name . "\r\n 
    Email = " . $email . "\r\n 
    CEP = " . $CEP . "\r\n 
    Cidade e estado = " . $cityAndState . "\r\n 
    Rua ou avenida =" . $streetOrAvenue . "\r\n 
    Numero =" . $numberHouse . "\r\n 
    Complemento =" . $complement;


$subject = "Compra realizada";
$fromname = "Contato Feras";
$fromemail = 'contato@feraspersonalizados.com.br';
/* $mailto = 'feraspersonalizados@gmail.com'; */
$mailto = 'italobgg00@gmail.com';
$content = file_get_contents($fileName);
$content = chunk_split(base64_encode($content));

$separator = md5(time());

$eol = "\r\n";

$headers = "From: " . $fromname . " <" . $fromemail . ">" . $eol;
$headers .= "MIME-Version: 1.0" . $eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
$headers .= "This is a MIME encoded message." . $eol;

$body = "--" . $separator . $eol;
$body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
$body .= "Content-Transfer-Encoding: 8bit" . $eol;
$body .= $message . $eol;

$body .= "--" . $separator . $eol;
$body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
$body .= "Content-Transfer-Encoding: base64" . $eol;
$body .= "Content-Disposition: attachment" . $eol;
$body .= $content . $eol;
$body .= "--" . $separator . "--";
//SEND Mail
if (mail($mailto, $subject, $body, $headers)) {
    header('Location: ../../pages/enviaEmail/recebido.html'); // Escolha para onde mandar depois de enviar o e-mail


} else {
    echo "mail send ... ERROR!";
    print_r(error_get_last());
}