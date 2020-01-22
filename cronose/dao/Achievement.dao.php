<?php

require_once 'DAO.php';

class AchievementDAO extends DAO {

  public static function getAll($lang){
    $sql = "SELECT * FROM Achievement_Language WHERE language_id = '" . $lang . "'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getById($id, $lang) {
    $sql = "SELECT * FROM Achievement_Language WHERE achievement_id = " . $id . " AND language_id = '" . $lang . "';";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getByName($name) {
    $sql = "SELECT * FROM Achievement_Language WHERE name = " . $name . ";";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getByIdAndLang($id, $lang) {
    $sql = "SELECT * FROM Achievement_Language WHERE language_id = " . $lang . " AND achievement_id = " . $id . ";";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getByLang($lang) {
    $sql = "SELECT * FROM Achievement_Language WHERE language_id = " . $lang . ";";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getAllByUser($id) {
    $sql = "SELECT * FROM Obtain WHERE user_id = " . $id . ";";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getDescription($lang){
    $sql = "SELECT description FROM Achievement_Language WHERE language_id = '" . $lang . "';";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function haveAchi($user_id, $achi_id){
    $sql = "SELECT * FROM Obtain WHERE achievement_id = '" . $achi_id . "' AND user_id = " . $user_id . ";";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function setAchievement($user_id, $achi_id){
    $sql = "INSERT INTO Obtain VALUES (${achi_id}, ${user_id}, Date(now()) )";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement;
  }
}