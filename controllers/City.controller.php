<?php

require_once '../models/City.model.php';
require_once '../controllers/Province.controller.php';

class CityController {

  public static function getAll() {
  	return CityModel::getAll();
  }

  public static function getByCp($cp) {
    $city = CityModel::getByCp($cp);
    $city['province'] = ProvinceController::getById($city['province_id']);
    unset($city['province_id'], $city['province']['cities']);
    return $city;
  }

  public static function getByProvinceId($province) {
    return CityModel::getByProvinceId($province);
  }

}