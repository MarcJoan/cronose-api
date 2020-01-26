<?php

require_once 'DAO.php';

class SpecializationDAO extends DAO {

  public static function getAll($lang){
    $sql = "SELECT * FROM Specialization_Language WHERE language_id = '${lang}';" ;
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getByCategoryId($id, $lang) {
    $sql = "SELECT * FROM Specialization_Language, Specialization WHERE Specialization.category_id = ${id} AND Specialization.id = Specialization_Language.specialization_id AND Specialization_Language.language_id = '${lang}';" ;
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

}