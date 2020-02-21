<?php

require_once 'Model.php';
require_once '../dao/Veterany.dao.php';

class VeteranyModel extends Model {

  public static function getVeterany($id) {
    return VeteranyDAO::getVeterany($id);
  }

  public static function getRange($id) {
    return VeteranyDAO::getRange($id);
  }
}
