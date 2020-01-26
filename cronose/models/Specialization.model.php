<?php

require_once '../dao/Specialization.dao.php';

class SpecializationModel {

  public static function getAll($lang) {
    return SpecializationDAO::getAll($lang);
  }

  public static function getAllByLanguage($language) {
    $sql = "SELECT * FROM Specialization_Language WHERE language_id = ".$language."";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function getById($specialization_id) {
    $sql = "SELECT * FROM  Specialization WHERE id = '" . $specialization_id . "';";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function getByCategoryId($id, $lang) {
    return SpecializationDAO::getByCategoryId($id, $lang);
  }

}
