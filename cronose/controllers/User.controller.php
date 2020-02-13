<?php

require_once '../models/User.model.php';

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
    $profile = UserModel::saveUser($user);
    if ($profile) return [
      "status" => "success",
      "profile" => $profile
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

  public static function isValid($username, $password) {
    $user = UserModel::getUserByUsername($username);
    if (!$user) return false;
    if ($user['password'] != $password) return false;
    $_SESSION['user'] = json_encode($user);
    return true;
  }

  public static function userLogin($username, $password) {
    $response = self::isValid($username, $password);
    if (!$response) return [
      "status" => "error",
      "msg" => "Something go wrong!"
    ];

    self::sendMailTo("Hello From Server", "Hello ${username}", "", "josep.oliverr@gmail.com", "From: josep@grup-c.c.daw-1819.internal");

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

  private static function sendMailTo($subject, $message, $from, $to, $headers = "") {
    $message = wordwrap($message, 70);
    mail($to, $subject, $message, $headers);
  }

}

?>
