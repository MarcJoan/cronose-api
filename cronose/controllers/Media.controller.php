<?php

require_once '../models/Media.model.php';

class MediaController {

  // CREC QUE AIXÓ ESTÀ MALAMENT jaja
  public static function getAll() {
  	return ProvinceModel::getAll();
  }

  public static function getById($id) {
    return ProvinceModel::getById($id);
  }

}