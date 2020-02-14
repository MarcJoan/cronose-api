<?php

class Mailer {
  
  private $defaultFrom = "cronose@cronose.dawman.info";

  public static function sendMailTo($subject, $message, $to, $from = null, $headers = "") {
    $from = $from || $defaultFrom;
    $headers.= "From: ${from}\r\n";
    $message = wordwrap($message, 70);
    mail($to, $subject, $message, $headers);
  }

}


?>