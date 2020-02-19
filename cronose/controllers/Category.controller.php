<?php

require_once '../models/Category.model.php';
require_once 'Language.controller.php';

class CategoryController {

  public static function getAll() {
    $categories = CategoryModel::getAll();
    $langs = LanguageController::getLangs();
    foreach ($categories as &$category) {
      foreach($langs as $lang) {
        $category['translations'][$lang] = CategoryModel::getByIdAndLang($category['id'], $lang);
      }
    }
    return $categories;
  }

  public static function getAllByLang($lang) {
  	$categories = CategoryModel::getAllByLang($lang);
    return $categories;
  }

  public static function getCountSpecialization($lang) {
    $categories = CategoryModel::getCountSpecialization($lang);
    if ($categories) return [
      "status" => "success",
      "offers" => $categories
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

}
