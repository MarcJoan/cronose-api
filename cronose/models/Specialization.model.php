<?php

require_once '../dao/Specialization.dao.php';

class SpecializationModel{

  public static function getAll() {
    return SpecializationDAO::getAll();
  }

  public static function getAllByLang($lang) {
    return SpecializationDAO::getAllByLang($lang);
  }

  public static function getAllByIDAndLang($id, $lang) {
    return SpecializationDAO::getAllByIDAndLang($id, $lang);
  }

}
