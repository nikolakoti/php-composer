<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';




$config = require_once __DIR__ . '/config.php';

//print_r($config); die();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

$smtpHost = $config['smtpHost'];
$smtpUsername = $config['smtpUsername'];
$smtpPassword = $config['smtpPassword'];

$successMessage = '';

if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
$errorMessage = '';
$formData = array(
    "name" => "",
    "email" => "",
    "subject" => "",
    "message" => ""
);

$formErrors = array();

if (isset($_POST["submit"]) && $_POST["submit"] == "sendEmail") {

    /*     * ********* filtriranje i validacija polja *************** */


    if (isset($_POST["name"])) {
        //Filtering 1
        $formData["name"] = trim($_POST["name"]);
        //Filtering 2
        //Filtering 3
        //Filtering 4
        //...
        //Validation - if required
        if ($formData["name"] === "") {
            $formErrors["name"][] = "Polje name ne sme biti prazno";
        }

        //Validation 2
        //Validation 3
        //Validation 4
        //...
    } else {
        //if required
        $formErrors["name"][] = "Polje name mora biti prosledjeno";
    }

    if (isset($_POST["email"])) {
        //Filtering 1
        $formData["email"] = trim($_POST["email"]);
        //Filtering 2
        //Filtering 3
        //Filtering 4
        //...
        //Validation - if required
        if ($formData["email"] === "") {
            $formErrors["email"][] = "Polje email ne sme biti prazno";
        }

        //Validation 2
        //Validation 3
        //Validation 4
        //...

        if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $formErrors["email"][] = "Polje email nije validna email adresa";
        }
    } else {
        //if required
        $formErrors["email"][] = "Polje email mora biti prosledjeno";
    }
    /*     * ********* filtriranje i validacija polja *************** */

    if (isset($_POST["subject"])) {
        //Filtering 1
        $formData["subject"] = trim($_POST["subject"]);
        //Filtering 2
        //Filtering 3
        //Filtering 4
        //...
        //Validation - if required
        if ($formData["subject"] === "") {
            $formErrors["subject"][] = "Polje subject ne sme biti prazno";
        }

        //Validation 2
        //Validation 3
        //Validation 4
        //...
    } else {
        //if required
        $formErrors["subject"][] = "Polje subject mora biti prosledjeno";
    }
    
    if (isset($_POST["g-recaptcha-response"]) && (!empty($_POST["g-recaptcha-response"]))) {
        //Filtering 1
        $formData["g-recaptcha-response"] = trim($_POST["g-recaptcha-response"]);
        
        $recaptcha = new \ReCaptcha\ReCaptcha($config['recaptchaSecretKey']);
        $resp = $recaptcha->verify($_POST["g-recaptcha-response"], $_SERVER['REMOTE_ADDR']);
    
    if (!$resp->isSuccess()) {
        
        $formErrors["g-recaptcha-response"][] = "Niste prosli bot proveru";
        
       } 
        
    } else {
        //if required
        $formErrors["g-recaptcha-response"][] = "Molimo Vas da potvrdite da niste robot.";
    }

    if (isset($_POST["message"])) {
        //Filtering 1
        $formData["message"] = trim($_POST["message"]);
        //Filtering 2
        //Filtering 3
        //Filtering 4
        //...
        //Validation - if required
        if ($formData["message"] === "") {
            $formErrors["message"][] = "Polje message ne sme biti prazno";
        }

        //Validation 2
        //Validation 3
        //Validation 4
        //...
    } else {
        //if required
        $formErrors["message"][] = "Polje message mora biti prosledjeno";
    }

//    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
//    $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
//    
//    if ($resp->isSuccess()) {
//        // verified!
//        // if Domain Name Validation turned off don't forget to check hostname field
//        // if($resp->getHostName() === $_SERVER['SERVER_NAME']) {  }
//    } else {
//        $errors = $resp->getErrorCodes();
//    }

    //Ukoliko nema gresaka 
    if (empty($formErrors)) {
        //Uradi akciju koju je korisnik trazio

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $smtpHost;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $smtpUsername;                 // SMTP username
            $mail->Password = $smtpPassword;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom(
                    $formData['email'], $formData['name']
            );
            $mail->addAddress('koti.matic@gmail.com', 'Nikola Kotarac');     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Kontakt forma - ' . $formData['subject'];
            $mail->Body = $formData['message'];
            $mail->AltBody = strip_tags($formData['message']);

            $mail->send();
            $successMessage = 'Message has been sent';

            $_SESSION['success_message'] = $successMessage;

            header('Location: /kontakt-forma.php');
            die();
        } catch (PHPMailerException $e) {
            $errorMessage = 'Error occured while sending email, please try again';

            echo $ex->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Contact Form - Get in touch - F1</title>

        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Cubes School</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container">
            <div class="page-header">
                <h1>Get in touch</h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
<?php if (!empty($successMessage)) { ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span><?php echo htmlspecialchars($successMessage); ?></span>
                        </div>
<?php } ?>
<?php if (!empty($errorMessage)) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span><?php echo htmlspecialchars($errorMessage); ?></span>
                        </div>
<?php } ?>
                </div>
            </div>
            <div class="row">
                <form action="" method="post" role="form" class="form container-fluid">
                    <fieldset class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="name" id="name" value="<?php echo isset($formData["name"]) ? htmlspecialchars($formData["name"]) : ""; ?>" placeholder="Your Name" required="required" type="text">
                                <div class="validation">
<?php
if (isset($formErrors["name"])) {
    foreach ($formErrors["name"] as $errorMessage) {
        ?>
                                            <span class="text-danger"><?php echo $errorMessage; ?></span>
        <?php
    }
}
?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="email" id="email" value="<?php echo isset($formData["email"]) ? htmlspecialchars($formData["email"]) : ""; ?>" placeholder="Your Email" required="required" type="email">
                                <div class="validation">
                                    <?php
                                    if (isset($formErrors["email"])) {
                                        foreach ($formErrors["email"] as $errorMessage) {
                                            ?>
                                            <span class="text-danger"><?php echo $errorMessage; ?></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" value="<?php echo isset($formData["subject"]) ? htmlspecialchars($formData["subject"]) : ""; ?>" placeholder="Subject" required="required" type="text">
                                <div class="validation">
                                    <?php
                                    if (isset($formErrors["subject"])) {
                                        foreach ($formErrors["subject"] as $errorMessage) {
                                            ?>
                                            <span class="text-danger"><?php echo $errorMessage; ?></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required="required"><?php echo isset($formData["message"]) ? htmlspecialchars($formData["message"]) : ""; ?></textarea>
                                <div class="validation">
                                    <?php
                                    if (isset($formErrors["message"])) {
                                        foreach ($formErrors["message"] as $errorMessage) {
                                            ?>
                                            <span class="text-danger"><?php echo $errorMessage; ?></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="row">
                        <div class="col-md-6">
                            <!-- OVDE IDE DIV ZA RECAPTCHA-u!!!-->
                            <div class="g-recaptcha" data-sitekey="6LcFH0AUAAAAAF0GxwnvhmfOEcJL3M1oQGjn4W5q"></div>
                             <div class="validation">
                                    <?php
                                    if (isset($formErrors["g-recaptcha-response"])) {
                                        foreach ($formErrors["g-recaptcha-response"] as $errorMessage) {
                                            ?>
                                            <span class="text-danger"><?php echo $errorMessage; ?></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-default pull-right" type="submit" name="submit" value="sendEmail">Send Now</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
