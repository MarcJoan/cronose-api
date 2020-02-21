<?php

require_once 'Model.php';
require_once '../dao/City.dao.php';

class CityModel {

  public static function getAll() {
    return CityDAO::getAll();
  }

  public static function getByCp($cp) {
    return CityDAO::getByCp($cp);
  }

  public static function getByProvinceId($province) {
    return CityDAO::getByProvinceId($province);
  }

}