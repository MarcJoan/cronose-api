<?php

require_once '../models/User.model.php';

// Utilities
require_once '../utilities/Mailer.php';
require_once '../utilities/Logger.php';

class UserController {

  public static function getAll() {
    return UserModel::getAll();
  }

  public static function getUserByInitialsAndTag($initials, $tag) {
    $profile = UserModel::getUserByInitialsAndTag($initials, $tag);
    $profile['achievements'] = AchievementController::getAllByUser($profile['id']);
    return $profile;
  }

  public static function getId($initials, $tag) {
    return UserModel::getId($initials, $tag);
  }

  public static function getUsersBySearch($text) {
    return UserModel::getUsersBySearch($text);
  }

  public static function register($user) {
    $user = UserModel::saveUser($user);
    if (!$user) return "Something went wrong!";

    $fullName = "${user['name']} ${user['surname']} ${user['surname_2']}";
    $message = "Hello ${fullName},\nNice to see you on our platform, I hope you make some profit with it!";
    Mailer::sendMailTo("Welcome to Cronose", $message, $user['email']);

    return $user;
  }

  public static function isValid($email, $password) {
    $user = UserModel::getUserByEmail($email);
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
    return UserModel::getAllDirections();
  }

}

?>
