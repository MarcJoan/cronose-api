<?php

require_once '../dao/Token.dao.php';
require_once '../utilities/Mailer.php';

class TokenController {

  public static function createNewUser($userId, $type) {
    $token = self::createToken($userId, $type);

  }

  public static function createToken($userId, $type) {
    return TokenDAO::createToken($userId, $type);
  }

}