<?php

require_once 'Model.php';
require_once '../dao/Achievement.dao.php';

class AchievementModel {

  public static function modelValidation($body) {
    $body = json_decode($body);
    return true;
  }

  public static function getAll($lang) {
    return AchievementDAO::getAll($lang);
  }

  public static function getById($id, $lang) {
    return AchievementDAO::getById($id, $lang);
  }

  public static function getByName($name) {
    return AchievementDAO::getByName($name);
  }

  public static function getByIdAndLang($id, $lang) {
    return AchievementDAO::getByIdAndLang($id, $lang);
  }

  public static function getByLang($lang) {
    return AchievementDAO::getByLang($lang);
  }

  public static function getAllByUser($id) {
    return AchievementDAO::getAllByUser($id);
  }

  public static function getDescription($lang) {
    return AchievementDAO::getDescription($lang);
  }

  public static function haveAchi($user_id, $achi_id){
    return AchievementDAO::haveAchi($user_id, $achi_id);
  }

  public static function setAchievement($user_id, $achi_id){
    $achievements = AchievementDAO::setAchievement($user_id, $achi_id);
    return $achievements;
  }
}
