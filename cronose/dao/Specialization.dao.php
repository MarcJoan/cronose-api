<?php

require_once 'DAO.php';

class SpecializationDAO extends DAO {

  public static function getAll() {
    $sql = "SELECT * FROM Specialization";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function getAllByLang($lang) {
    $sql = "SELECT Specialization.id, Specialization_Language.name 
      FROM Specialization, Specialization_Language 
      WHERE Specialization.id = Specialization_Language.specialization_id
      AND language_id = '${lang}'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getAllByIDAndLang($id, $lang) {
    $sql = "SELECT Specialization.id, Specialization_Language.name 
      FROM Specialization, Specialization_Language 
      WHERE Specialization.id = Specialization_Language.specialization_id
      AND category_id = ${id}
      AND language_id = '${lang}'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

}