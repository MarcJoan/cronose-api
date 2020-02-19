<?php

require_once '../models/Specialization.model.php';

class SpecializationController {

  public static function getAll() {
    $specializations = SpecializationModel::getAll();
    $langs = LanguageController::getLangs();
    foreach ($specializations as &$specialization) {
      foreach($langs as $lang) {
        $specialization['translations'][$lang] = SpecializationModel::getByIDAndLang($specialization['id'], $lang);
      }
    }
    return $specializations;
  }

  public static function getAllByLang($lang) {
  	return $specializations = SpecializationModel::getAllByLang($lang);
  }

  public static function getAllByIDAndLang($id, $lang) {
    return $specializations = SpecializationModel::getAllByIDAndLang($id, $lang);
  }

}
