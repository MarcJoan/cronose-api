<?php

require_once '../models/Veterany.model.php';

class VeteranyController {

  public static function getVeterany($id) {
  	return VeteranyModel::getVeterany($id);
  }

  public static function getRange($id) {
    return VeteranyModel::getRange($id);
  }

}
