<?php

require_once '../models/Veterany.model.php';

class VeteranyController {

  public static function getVet($id) {
  	$achievements = VeteranyModel::getVet($id);
    return $achievements;
  }

}