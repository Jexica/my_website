<?

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$myEmail = "jessica.lm15@yahoo.no";

$success = mail($myEmail, "$name ($email)", $message);

if ($success) {
    header("HTTP/1.1 303 See Other");
    header('Location: ./?thankyou');
} else {
    header("HTTP/1.1 500 Internal Server Error");
    echo <<<HTML
<h1>Oops!</h1>
<p>Something went wrong, the email could not be sent.</p>
<p>Please try again later, or manually send an email to $myEmail</p>
HTML;
}
