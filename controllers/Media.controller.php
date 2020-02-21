<?php

require_once '../models/Media.model.php';

class MediaController {

  public static function getAll() {
  	return MediaModel::getAll();
  }

  public static function getById($id) {
    return MediaModel::getById($id);
  }

}