<?php

require_once 'Model.php';
require_once '../dao/Category.dao.php';

class CategoryModel extends Model {

  public static function modelValidation($body) {
    $body = json_decode($body);
    return true;
  }

  public static function getAll() {
    return CategoryDAO::getAll();
  }

  public static function getById($id) {
    return CategoryDAO::getById($id);
  }

  public static function getByName($name) {
    return CategoryDAO::getByName($name);
  }

  public static function getByIdAndLang($id, $lang) {
    return CategoryDAO::getByIdAndLang($id, $lang);
  }

  public static function getAllByLang($lang) {
    return CategoryDAO::getAllByLang($lang);
  }

  public static function getCountSpecialization($lang) {
    return CategoryDAO::getCountSpecialization($lang);
  }


}
