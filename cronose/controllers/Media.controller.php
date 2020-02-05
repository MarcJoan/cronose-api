<?php

require_once '../models/Media.model.php';

class MediaController {

  public static function getAll() {
  	$cities = ProvinceModel::getAll();
    return $cities;
  }

  public static function getById($id) {
    return ProvinceModel::getById($id);
  }

}