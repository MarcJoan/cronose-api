<?php

require_once '../dao/Token.dao.php';
require_once '../utilities/Mailer.php';

class TokenController {

  public static function createNewUser($userId, $email) {
    $token = self::createToken($userId, "User_validate");

    $subject = "User validate";
    $message = "http://devapi.cronose.dawman.info/validate/$token";
    Mailer::sendMailTo($subject, $message, $email, $from = null, $headers = "");
  }

  public static function createToken($userId, $type) {
    return TokenDAO::createToken($userId, $type);
  }

}