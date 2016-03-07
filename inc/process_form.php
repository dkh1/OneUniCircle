<?php

if ( isset($_POST['First_Name']) ) {
    $errors = array();
    if ( !preg_match('/^[\w!#$%&\'*+\/=?`{|}~^-]+(?:\.[\w!#$%&\'*+\/=?`{|}~^-]+)*@(?:[A-Z0-9-]+\.)+[A-Z]{2,6}$/i',$_POST['Email_Address']) ) {
        $errors[] = 'email';
    }
    if ( strlen($_POST['First_Name']) < 3 ) {
        $errors[] = 'First Name';
    }
    if ( strlen($_POST['Last_Name']) < 3 ) {
        $errors[] = 'Last Name';
    }
    if ( !preg_match('/^([0-9]{3})-([0-9]{3})-([0-9]{4})/',$_POST['Phone_Number']) ) {
        $errors[] = 'Phone Number';
    }
}

if ( isset($errors) && count($errors) < 1 ):
    require "PHPMailer/PHPMailerAutoload.php";
    $body = sprintf("<p>There has been a new submission on your landing page.</p>\n\n<p><b>First Name:</b> %s<br>\n<b>Last Name:</b> %s<br>\n<b>Email Address:</b> %s<br>\n<b>Phone:</b> %s</p>\n", $_POST['First_Name'], $_POST['Last_Name'], $_POST['Email_Address'], $_POST['Phone_Number']);

    $mailer = new PHPMailer;
    $mailer->isSMTP();
    $mailer->Host = 'smtpout.secureserver.net';
    $mailer->SMTPAuth = true;
    $mailer->Username = 'david@dkhcreative.com';
    $mailer->Password = '!Cle37Mal';
    $mailer->SMTPSecure = 'ssl';
    $mailer->Port = 465;
    $mailer->setFrom('david@dkhcreative.com', '212 Clayton Form');

    // Set recipients
    if ( $_SERVER['REMOTE_ADDR'] == '76.16.132.79' ) $mailer->addAddress('david@dkhcreative.com','David');
    else $mailer->addAddress('davidhornreich@gmail.com');
    // $mailer->addBcc('jeff@mauge.com','Jeff Kitler');


    $mailer->Subject = 'Someone is interested in 212 Clayton';
    $mailer->Body = $body;
    $mailer->AltBody = strip_tags($body);

    if(!$mailer->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mailer->ErrorInfo;
    } else {
        $message = "Thank-you for your submission.<br>We'll be in touch as details become available.";
        $send = true;
    }
endif;

if ( isset($send) && $send == true ) {
    echo sprintf('<div class="success">%s</div>',$message);
} else {
    ?>
    <form id="form" method="post">
      <div class="row">
        <input type="text" class="autoclear input text" name="First_Name" id="first_name" value="First name"><input type="text" class="autoclear input text" name="Last_Name" id="last_name" value="Last Name">
      </div>
      <div class="row">
        <input type="text" class="autoclear input text email" name="Email_Address" id="email_address" value="Email Address"><input type="tel" class="autoclear input text tel" name="Phone_Number" id="phone_number" value="Phone Number">
      </div>
      <div class="row">
        <button type="submit" class="input button">Submit</button>
      </div>
    </form>

    <?php
}
