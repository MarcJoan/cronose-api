<?php

require_once 'Model.php';
require_once '../dao/Media.dao.php';

class MediaModel extends Model {

  public static function modelValidation($body) {
    $body = json_decode($body);
    return true;
  }

  public static function getById($id) {
    return MediaDAO::getById($id);
  }

  public static function getAll() {
    return MediaDAO::getAll();
  }

}