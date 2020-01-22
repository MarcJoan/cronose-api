<?php

require_once '../models/Achievement.model.php';

class AchievementController {

  public static function getAll($lang) {
  	$achievements = AchievementModel::getAll($lang);
    return $achievements;
  }

  public static function getById($id, $lang) {
    $achievements = AchievementModel::getById($id, $lang);
    return $achievements;
  }

  public static function getAllByLang($lang) {
  	$achievements = AchievementModel::getAll();
    return $achievements;
  }

  public static function getAllByUser($id) {
  	$achievements = AchievementModel::getAllByUser($id);
    return $achievements;
  }

  public static function getDescription($lang) {
    $achievements = AchievementModel::getDescription($lang);
    return $achievements;
  }

  public static function setAchievement($user_id, $achi_id){
    $achievements = AchievementModel::setAchievement($user_id, $achi_id);
    return $achievements;
  }

  public static function haveAchi($user_id, $achi_id){
    $achievements = AchievementModel::haveAchi($user_id, $achi_id);
    if ($achievements) return true;

    return false;
  }

}