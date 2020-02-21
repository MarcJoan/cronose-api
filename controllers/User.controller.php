<?php

require_once '../dao/User.dao.php';

// Utilities
require_once '../utilities/Mailer.php';
require_once '../utilities/Logger.php';

class UserController {

  public static function getAll() {
    return UserDAO::getAll();
  }

  public static function getUserByInitialsAndTag($initials, $tag) {
    $profile = UserDAO::getUserByInitialsAndTag($initials, $tag);
    $profile['achievements'] = AchievementController::getAllByUser($profile['id']);
    return $profile;
  }

  public static function getId($initials, $tag) {
    return UserDAO::getId($initials, $tag);
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

  public static function isValid($email, $password) {
    $user = UserDAO::getUserByEmail($email);
    if (!$user) return false;
    if ($user['password'] != $password) return false;
    $_SESSION['user'] = json_encode($user);
    return $user;
  }

  public static function userLogin($email, $password) {
    $user = self::isValid($email, $password);
    if (!$user) return "Something go wrong!";

    $fullName = "${user['name']} ${user['surname']} ${user['surname_2']}";
    Mailer::sendMailTo("Welcome to Cronose", "Hello ${fullName}, we're happy to see you back!", $email);

    return "Successfully logged!";
  }

  public static function userLogout() {
    $_SESSION['user'] = null;
  }

  public static function getAllDirections() {
    return UserDAO::getAllDirections();
  }

}

?>
