<?php

require_once 'Model.php';
require_once '../dao/User.dao.php';

class UserModel extends Model {

  public static function getUserByUsername($username) {
    return UserDAO::getUserByUsername($username);
  }

  public static function getUserByEmail($email) {
    return UserDAO::getUserByEmail($email);
  }

  public static function getUserByInitialsAndTag($initials, $tag) {
    return UserDAO::getUserByInitialsAndTag($initials, $tag);
  }

  public static function getUsersBySearch($text) {
    return UserDAO::getUsersBySearch($text);
  }

  public static function saveUser($user) {
    return UserDAO::saveUser($user);
  }

  public static function getAllDirections() {
    return UserDAO::getAllDirections();
  }

  public static function getId($initials, $tag) {
    return UserDAO::getId($initials, $tag);
  }

  

  // private $username;
  // private $email;
  // private $password;
  // private $valid = false;

  // public function __construct($username, $password, $email = '') {
  //     $this->username = $username;
  //     $this->password = $password;
  //     $this->valid = UserController::isValid($this);
  //     if ($this->valid) {
  //         // $this->email = DB::getEmailByUsername($this->username);
  //     } else {
  //         // $this->email = $email;
  //     }
  // }

  // public function isValid() {
  //     return $this->valid;
  // }
  // public function validate() {
  //     $this->valid = UserController::isValid($this);
  // }

  // public function getUsername() {
  //     return $this->username;
  // }
  // public function getEmail() {
  //     return $this->email;
  // }
  // public function getPassword() {
  //     return $this->password;
  // }


}
