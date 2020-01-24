<?php

require_once 'Model.php';
require_once '../dao/Veterany.dao.php';

class VeteranyModel extends Model {

  public static function getVet($id) {
    return VeteranyDAO::getVet($id);
  }

  public static function getRange($id) {
    return VeteranyDAO::getRange($id);
  }
}
