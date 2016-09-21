<?php require 'email.php'; ?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Bootstrap Contact Form</title>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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
        <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="contactform">
          <fieldset>
            <legend>Send Us a Message</legend>

            <?php if(isset($hasError)) { //If errors are found ?>
              <p class="alert alert-danger">Please check if you've filled all the fields with valid information and try again. Thank you.</p>
            <?php } ?>

            <?php if(isset($emailSent) && $emailSent == true): //If email is sent ?>
              <div class="alert alert-success">
                <p><strong>Message Successfully Sent!</strong></p>
                <p>Thank you for using our contact form, <strong><?php echo $name;?></strong>! Your email was successfully sent and we&rsquo;ll be in touch with you soon.</p>
              </div>
            <?php else :  ?>

            <div class="form-group">
              <label for="name">Your Name<span class="help-required">*</span></label>
              <input type="text" name="contactname" id="contactname" class="form-control" required role="input" aria-required="true" value="<?php if (!empty($_POST['contactname'])){echo $_POST['contactname'];} ?>" />
							<?php if (isset($nameError)) { echo "<div class='alert alert-warning' role='alert'>" . $nameError . "</div>"; } ?>
            </div>

            <div class="form-group">
              <label for="phone">Your Phone Number<span class="help-required">*</span></label>
              <input type="text" name="phone" id="phone" class="form-control" required role="input" aria-required="true" value="<?php if (!empty($_POST['phone'])){echo $_POST['phone'];} ?>"  />
							<?php if (isset($phoneError)) { echo "<div class='alert alert-warning' role='alert'>" . $phoneError . "</div>"; } ?>
            </div>

            <div class="form-group">
              <label for="email">Your Email<span class="help-required">*</span></label>
              <input type="text" name="email" id="email" class="form-control email" required role="input" aria-required="true" value="<?php if (!empty($_POST['email'])){echo $_POST['email'];} ?>"/>
							<?php if (isset($emailError)) { echo "<div class='alert alert-warning' role='alert'>" . $emailError . "</div>"; } ?>
            </div>

						<div class="form-group">
              <label for="subject">Subject<span class="help-required">*</span></label>

              <select name="subject" id="subject" class="form-control required" role="select" aria-required="true">
                <option value=""></option>
                <option value="one">One</option>
                <option value="two">Two</option>
              </select>
							<?php if (isset($subjectError)) { echo "<div class='alert alert-warning' role='alert'>" . $subjectError . "</div>"; } ?>
            </div>

            <div class="form-group">
              <label for="weburl">Your Website</label>
              <input type="text" name="weburl" id="weburl" value="<?php if (!empty($_POST['weburl'])){echo $_POST['weburl'];} ?>" class="form-control url" role="input" aria-required="true" />
							<?php if (isset($websiteError)) { echo "<div class='alert alert-warning' role='alert'>" . $websiteError . "</div>"; } ?>
            </div>

						<div class="form-group hidden">
              <label for="amce">AMCE</label>
              <input type="text" name="amce" id="amce" value="AMCE" class="form-control acme" role="input" aria-required="true" />
							<?php if (isset($acmeError)) { echo "<div class='alert alert-warning' role='alert'>" . $acmeError . "</div>"; } ?>
            </div>

            <div class="form-group">
              <label for="message">Message<span class="help-required">*</span></label>
              <textarea rows="8" name="message" id="message" class="form-control"required role="textbox" aria-required="true"><?php if (!empty($_POST['message'])){echo $_POST['message'];} ?></textarea>
							<?php if (isset($messageError)) { echo "<div class='alert alert-warning' role='alert'>" . $messageError . "</div>"; } ?>
            </div>

            <div class="actions">
              <input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn btn-primary" title="Click here to submit your message!" />
            </div>
          </fieldset>
        </form>
      </div><!-- col -->
    </div><!-- row -->
		<?php endif; ?>
      <hr>

      <div class="footer">
        <p>&copy; Company <?php echo date('Y'); ?></p>
      </div>

    </div> <!-- /container -->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" async defer></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" async defer></script>
</body>
</html>
