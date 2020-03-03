<?php

require_once '../dao/User.dao.php';

// JWT
require_once '../utilities/JWTManager.php';

// Utilities
require_once '../utilities/Mailer.php';
require_once '../utilities/Logger.php';

class UserController {

  public static function getAll() {
    return UserDAO::getAll();
  }

  public static function getUserByInitialsAndTag($initials, $tag) {
    return UserDAO::getUserByInitialsAndTag($initials, $tag);
  }

  public static function getId($initials, $tag) {
    return UserDAO::getId($initials, $tag);
  }

  public static function getBasicUserById($id, $avatar = false) {
    return UserDAO::getBasicUserById($id, $avatar);
  }

  public static function getUserById($user_id) {
    return UserDAO::getUserById($user_id);
  }

  public static function getUsersBySearch($text) {
    return UserDAO::getUsersBySearch($text);
  }

  public static function register($user, $files) {
    return $user = UserDAO::saveUser($user, $files);
  }
  
  public static function userLogin($email, $password) {
    $userPassword = UserDAO::getPassword($email);
    if ($userPassword != $password) {
      http_response_code(400);
      return ["message" => "Invalid email or password"];
    }
    return [
      "message" => "Login",
      "jwt" => createJWT(["email" => $email, "password" => $password])
    ];
  }

  public static function validateUser($token) {
    UserDAO::validateUser($token);
  }

  public static function getAllDirections() {
    return UserDAO::getAllDirections();
  }

}

?>
