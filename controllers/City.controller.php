<?php

require_once '../models/City.model.php';

class CityController {

  public static function getAll() {
  	return CityModel::getAll();
  }

  public static function getByCp($cp) {
    return CityModel::getByCp($cp);
  }

  public static function getByProvinceId($province) {
    return CityModel::getByProvinceId($province);
  }

}