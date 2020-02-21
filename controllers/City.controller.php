<?php

require_once '../dao/City.dao.php';

class CityController {

  public static function getAll() {
  	return CityDAO::getAll();
  }

  public static function getByCp($cp) {
    $city = CityDAO::getByCp($cp);
    $city['province'] = ProvinceController::getById($city['province_id']);
    unset($city['province_id'], $city['province']['cities']);
    return $city;
  }

  public static function getByProvinceId($province) {
    return CityDAO::getByProvinceId($province);
  }

}