<?php

require_once 'Model.php';
require_once '../dao/Province.dao.php';

class ProvinceModel extends Model {

  public static function modelValidation($body) {
    $body = json_decode($body);
    return true;
  }

  public static function getById($id) {
    return ProvinceDAO::getById($id);
  }

  public static function getAll() {
    return ProvinceDAO::getAll();
  }

}