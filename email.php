<?php

  require 'vendor/autoload.php';

  if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    $hasError = $emailSent = null;

    $nameError =$phoneError = $emailError =$websiteError = $subjectError = $acmeError = null;

    if (empty($_POST["contactname"])) {
      $nameError = "Name is required";
      $hasError = true;
    } else {
      $name = strip($_POST["contactname"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameError = "Only letters and white space allowed";
        $hasError = true;
      }
    }

    if (empty($_POST["phone"])) {
      $phoneError = "A phone number is required";
      $hasError = true;
    } else {
      $phone = strip($_POST["phone"]);
      // check if it is number
      if(!is_numeric($_POST["phone"])) {
        $phoneError = "Numbers Only.";
        $hasError = true;
      }

      if(strlen($_POST["phone"]) <= 4) {
        $phoneError .= " <br> Phone Number too Short.";
        $hasError = true;
      }

    }

    if (empty($_POST["email"])) {
      $emailError = "Email is required";
      $hasError = true;
    } else {
      $email = strip($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
        $hasError = true;
      }
    }

    if (!empty($_POST["weburl"])) {
      $website = strip($_POST["weburl"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
        $websiteError = "Invalid URL";
        $hasError = true;
      }
    }

    if (empty($_POST["message"])) {
      $messageError = "Leave us a message";
    } else {
      $message = strip($_POST["message"]);
    }

    if (empty($_POST["subject"])) {
      $subjectError = "Select a subject";
      $hasError = true;
    }

    if ($_POST["amce"] !== "AMCE") {
      $acmeError = "Refresh broswer and leave empty.";
      $hasError = true;
    }

    if (!isset($hasError)) {

      ob_start();

      include 'template/default.php';

      $html_temp = ob_get_contents();

      ob_end_clean();

      $dotenv = new Dotenv\Dotenv(__DIR__);

      $dotenv->load();

      $mail = new PHPMailer;

      $mail->setFrom( getenv('EMAIL_FROM') );

      $mail->addAddress(getenv('EMAIL_TO'), getenv('EMAIL_NAME'));

      $mail->Subject = getenv('EMAIL_SUBJECT');

      $mail->msgHTML($html_temp);

      $mail->AltBody = 'Name: ' . $name . '\r\n'. 'Phone Number:' . '\r\n' . 'Email Address: ' . $email . '\r\n' . 'Website URL: ' . '\r\n' . $website . '\r\n' . 'Message: ' . $message;

      if ( !$mail->send() ) {

        echo $mail->ErrorInfo;

        die();

      } else {

        $emailSent = true;

      }

    }

  }

  function strip($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>
