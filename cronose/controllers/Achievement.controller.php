<?php

require_once '../models/Achievement.model.php';

class AchievementController {

  public static function getAll($lang) {
  	return AchievementModel::getAll($lang);
  }

  public static function getById($id, $lang) {
    return AchievementModel::getById($id, $lang);
  }

  public static function getAllByLang($lang) {
  	return AchievementModel::getAll();
  }

  public static function getAllByUser($id) {
  	return AchievementModel::getAllByUser($id);
  }

  public static function getDescription($lang) {
    return AchievementModel::getDescription($lang);
  }

  public static function setAchievement($user_id, $achi_id) {
    return AchievementModel::setAchievement($user_id, $achi_id);
  }

  public static function haveAchi($user_id, $achi_id) {
    $achievements = AchievementModel::haveAchi($user_id, $achi_id);
    if ($achievements) return true;
    return false;
  }

}