<?php

require_once '../models/Veterany.model.php';

class VeteranyController {

  public static function getVet($id) {
  	return VeteranyModel::getVet($id);
  }

  public static function getRange($id) {
    return VeteranyModel::getRange($id);
  }

}
