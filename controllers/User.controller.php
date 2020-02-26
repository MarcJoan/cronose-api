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

  public static function getUsersBySearch($text) {
    return UserDAO::getUsersBySearch($text);
  }

  public static function register($user) {
    $user = UserDAO::saveUser($user);
    if (!$user) return "Something went wrong!";

    $fullName = "${user['name']} ${user['surname']} ${user['surname_2']}";
    $message = "Hello ${fullName},\nNice to see you on our platform, I hope you make some profit with it!";
    Mailer::sendMailTo("Welcome to Cronose", $message, $user['email']);

    return $user;
  }

  // public static function isValid($email, $password) {
  //   $user = UserDAO::getUserByEmail($email);
  //   if (!$user) return false;
  //   $userPassword = UserDAO::getUserPassword($user);
  //   if ($userPassword != $password) return false;
  //   return $user;
  // }

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

  public static function getAllDirections() {
    return UserDAO::getAllDirections();
  }

}

?>
