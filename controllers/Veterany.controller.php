<?php

require_once '../dao/Veterany.dao.php';

class VeteranyController {

  public static function getVeterany($id) {
  	return VeteranyModel::getVeterany($id);
  }

  public static function getRange($id) {
    return VeteranyDAO::getRange($id);
  }

}
