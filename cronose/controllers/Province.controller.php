<?php

require_once '../models/Province.model.php';
require_once 'City.controller.php';

class ProvinceController {

  public static function getAll() {
  	return ProvinceModel::getAll();
  }

  public static function getById($id) {
    $province = ProvinceModel::getById($id);
    $province['cities'] = CityController::getByProvinceId($id);
    return $province;
  }

}