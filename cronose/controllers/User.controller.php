<?php

require_once '../models/User.model.php';

// Utilities
require_once '../utilities/Mailer.php';
require_once '../utilities/Logger.php';

class UserController {

  /*public static function getProfileInfo($username) {
    $profile = UserModel::getUserByUsername($username);
    if ($profile) $achievement = AchievementController::getAllByUser($profile['id']);

    if ($profile) return [
      "status" => "success",
      "profile" => $profile,
      "achievement" => $achievement
    ];
    else return [
      "status" => "error",
      "msg" => "That profile doesn't exists!"
    ];
  }*/

  public static function getUserByInitialsAndTag($initials, $tag) {
    $profile = UserModel::getUserByInitialsAndTag($initials, $tag);
    $achievement = AchievementController::getAllByUser($profile['id']);
    if ($profile) return [
      "status" => "success",
      "profile" => $profile,
      "achievement" => $achievement
    ];
    else return [
      "status" => "error",
      "msg" => "That profile doesn't exists!"
    ];
  }

  public static function getId($initials, $tag) {
    $id = UserModel::getId($initials, $tag);
    if ($id) return [
      "status" => "success",
      "user" => $id,
    ];
    else return [
      "status" => "error",
      "msg" => "That user doesn't exists!"
    ];
  }

  public static function getUsersBySearch($text) {
    $users = UserModel::getUsersBySearch($text);
    if ($users) return [
      "status" => "success",
      "users" => $users
    ];
    else return [
      "status" => "error",
      "msg" => "That user doesn't exists!"
    ];
  }


  public static function register($user) {
    $user = UserModel::saveUser($user);
    if (!$user) return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];

    $fullName = "${user['name']} ${user['surname']} ${user['surname_2']}";
    $message = "Hello ${fullName},\nNice to see you on our platform, I hope you make some profit with it!";
    Mailer::sendMailTo("Welcome to Cronose", $message, $user['email']);

    return [
      "status" => "success",
      "user" => $user
    ];
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
    if (!$user) return [
      "status" => "error",
      "msg" => "Something go wrong!"
    ];

    $fullName = "${user['name']} ${user['surname']} ${user['surname_2']}";
    Mailer::sendMailTo("Welcome to Cronose", "Hello ${fullName}, we're happy to see you back!", $email);

    return [
      "status" => "success",
      "msg" => "Successfully logged!"
    ];
  }

  public static function userLogout() {
    $_SESSION['user'] = null;
  }

  public static function getAllDirections() {
    $directions = UserModel::getAllDirections();
    if ($directions) return [
      "status" => "success",
      "direction" => $directions
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

}

?>
