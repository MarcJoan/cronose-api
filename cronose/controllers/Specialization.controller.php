<?php

require_once '../models/Specialization.model.php';

class SpecializationController {

  public static function getAll($lang) {
    return SpecializationModel::getAll($lang);
  }

  public static function getByCategoryId($id, $lang) {
    return SpecializationModel::getByCategoryId($id, $lang);
  }

}
