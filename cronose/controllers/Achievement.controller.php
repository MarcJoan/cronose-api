<?php

require_once '../models/Achievement.model.php';

class AchievementController {

  public static function getAll() {
  	$achievements = AchievementModel::getAll();
    $langs = LanguageController::getLangs();
    foreach ($achievements as &$achievement) {
      foreach($langs as $lang) {
        $achievement['translations'][$lang] = AchievementModel::getByIdAndLang($achievement['id'], $lang);
      }
    }
    return $achievements;
  }

  public static function getAllByLang($lang) {
  	return AchievementModel::getAllByLang($lang);
  }

  public static function getById($id, $lang) {
    return AchievementModel::getById($id, $lang);
  }

  public static function getAllByUser($id) {
  	return AchievementModel::getAllByUser($id);
  }

  public static function getDescription($lang) {
    return AchievementModel::getDescription($lang);
  }

  public static function setAchievement($user_id, $achi_id) {
    AchievementModel::setAchievement($user_id, $achi_id);
  }

  public static function haveAchi($user_id, $achi_id) {
    $achievements = AchievementModel::haveAchi($user_id, $achi_id);
    if ($achievements) return true;
    return false;
  }

}