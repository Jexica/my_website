<?

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$myEmail = "jessica.lm15@yahoo.no";

// Sanitize submitted values
$name = sanitize($name);
$email = sanitize($email);
$message = sanitize($message);

// Validate the form
if (validateForm($name, $email, $message)) {

    // Send the email
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
<p style="margin-top:3em">
    You can <a href="javascript:history.back()">return to the contact form</a>
    or to the <a href="../">home page</a>
</p>
HTML;
    }

} else {
    // The form validation failed
    header("HTTP/1.1 400 Bad Request");
        echo <<<HTML
<h1>Validation failed</h1>
<p>Your submission contains invalid values.</p>
<p>You might have inputted a wrong answer to the Captcha challenge.</p>
<p style="margin-top:3em">
    Please <a href="javascript:history.back()">return to the contact form</a>
    and ensure that all the fields are filled in correctly.
</p>
HTML;
}


/*
 * Helper functions used in this script
 */

// This function removes potentially dangerous content
function sanitize ($value) {
    $value = strip_tags($value);
    $value = htmlspecialchars($value, ENT_QUOTES);
    return $value;
}

/**
 * Validate the form, not including the captcha.
 *
 * @param string $name Value of the name input field
 * @param string $email Value of the email input field
 * @param string $message Value of the message input field
 * @return Whether if the form is valid
 */
function validateForm($name, $email, $message) {
    $valid = true;

    // The name must have at least 2 characters
    if (strlen($name) < 2) {
        $valid = false;
    }

    // The email must be valid
    $emailPattern = '/^\w+@[\w_\-]+?(\.[a-zA-Z]{2,})+$/';
    if (!preg_match($emailPattern, $email)) {
        $valid = false;
    }

    // The message must have a minimum content
    if (strlen($message) < 5) {
        $valid = false;
    }

    return $valid;
}
