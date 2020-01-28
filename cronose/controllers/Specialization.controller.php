<?php

require_once '../models/Specialization.model.php';

class SpecializationController {

  public static function getAll() {
  	$specializations = SpecializationModel::getAll();
    return $specializations;
  }

  public static function getAllByLang($lang) {
  	$specializations = SpecializationModel::getAllByLang($lang);
    return $specializations;
  }

  public static function getAllByIDAndLang($id, $lang) {
    $specializations = SpecializationModel::getAllByIDAndLang($id, $lang);
    return $specializations;
  }

}
