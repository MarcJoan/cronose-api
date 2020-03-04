<?php

require_once '../dao/Token.dao.php';
require_once '../utilities/Mailer.php';

class TokenController {

  public static function createNewUser($userId, $email) {
    
    $subject = "User validate";
    $title = "User_validate";
    $message = "Haga click en el siguiente enlace para validar su cuenta: ";

    self::sendToken($userId, $email, $subject, $message, $title);
  }

  public static function resetPassword($email) {
    $userId = UserController::getIdByEmail($email);

    $title = "Password reset";
    $subject = "Restore_pswd";
    $message = "Haga click en el siguiente enlace para resetear su contraseña: ";

    self::sendToken($userId, $email, $subject, $message, $title);
  }

  public static function createToken($userId, $type) {
    return TokenDAO::createToken($userId, $type);
  }

  public static function sendToken($userId, $emai, $subject, $message, $title) {

    $token = self::createToken($userId, $subject);

    $completeMessage = $message + "http://devapi.cronose.dawman.info/validate/&token=$token";

    Mailer::sendMailTo($title, $completeMessage, $email, $from = null, $headers = "");
  }

}