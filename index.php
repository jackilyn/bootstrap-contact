<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	//Check to make sure that the phone field is not empty
	if(trim($_POST['phone']) == '') {
		$hasError = true;
	} else {
		$phone = trim($_POST['phone']);
	}

	//Check to make sure that the name field is not empty
	if(trim($_POST['weburl']) == '') {
		$hasError = true;
	} else {
		$weburl = trim($_POST['weburl']);
	}

	//Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!filter_var( trim($_POST['email'], FILTER_VALIDATE_EMAIL ))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'you@yourwebsite.com'; // Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nPhone Number: $phone \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Bootstrap Contact Form</title>

<link rel="stylesheet" type="text/css" href="bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.pack.js" type="text/javascript"></script>
<script src="js/bootstrap-contact.js" type="text/javascript"></script>

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-push-1">
        <div class="jumbotron">
          <h1>Bootstrap Contact</h1>

          <p class="lead">A simple PHP contact form that uses Bootstrap, from Twitter, for a base and has jQuery validation.</p>

          <h3>Fork on Github</h3>
          <p>Want to add a contact form to your implementation of <a href="http://twitter.github.com/bootstrap/" title="Bootstrap, from Twitter">Bootstrap</a>? Download, fork, pull, file issues or whatever with my repo Github.</p>

          <p><a class="btn btn-large btn-primary" href="http://www.github.com/jackilyn/bootstrap-contact/">View Repo on Github &raquo;</a></p>
        </div><!-- jumbotron -->
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-md-push-3">
        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
          <fieldset>
            <legend>Send Us a Message</legend>

            <?php if(isset($hasError)) { //If errors are found ?>
              <p class="alert alert-danger">Please check if you've filled all the fields with valid information and try again. Thank you.</p>
            <?php } ?>

            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
              <div class="alert alert-success">
                <p><strong>Message Successfully Sent!</strong></p>
                <p>Thank you for using our contact form, <strong><?php echo $name;?></strong>! Your email was successfully sent and we&rsquo;ll be in touch with you soon.</p>
              </div>
            <?php } ?>

            <div class="form-group">
              <label for="name">Your Name<span class="help-required">*</span></label>
              <input type="text" name="contactname" id="contactname" value="" class="form-control required" role="input" aria-required="true" />
            </div>

            <div class="form-group">
              <label for="phone">Your Phone Number<span class="help-required">*</span></label>
              <input type="text" name="phone" id="phone" value="" class="form-control required" role="input" aria-required="true" />
            </div>


            <div class="form-group">
              <label for="email">Your Email<span class="help-required">*</span></label>
              <input type="text" name="email" id="email" value="" class="form-control required email" role="input" aria-required="true" />
            </div>

            <div class="form-group">
              <label for="weburl">Your Website<span class="help-required">*</span></label>
              <input type="text" name="weburl" id="weburl" value="" class="form-control required url" role="input" aria-required="true" />
            </div>


            <div class="form-group">
              <label for="subject">Subject<span class="help-required">*</span></label>
              <select name="subject" id="subject" class="form-control required" role="select" aria-required="true">
                <option></option>
                <option>One</option>
                <option>Two</option>
              </select>
            </div>

            <div class="form-group">
              <label for="message">Message<span class="help-required">*</span></label>
              <textarea rows="8" name="message" id="message" class="form-control required" role="textbox" aria-required="true"></textarea>
            </div>

            <div class="actions">
              <input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn btn-primary" title="Click here to submit your message!" />
              <input type="reset" value="Clear Form" class="btn btn-danger" title="Remove all the data from the form." />
            </div>
          </fieldset>
        </form>
      </div><!-- col -->
    </div><!-- row -->

      <hr>

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div> <!-- /container -->
</body>
</html>
