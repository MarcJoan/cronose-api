<?php

require_once '../dao/Province.dao.php';
require_once 'City.controller.php';

class ProvinceController {

  public static function getAll() {
  	return ProvinceDAO::getAll();
  }

  public static function getById($id) {
    $province = ProvinceDAO::getById($id);
    $province['cities'] = CityController::getByProvinceId($id);
    return $province;
  }

}