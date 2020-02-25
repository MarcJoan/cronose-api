<?php

require_once 'DAO.php';

class SpecializationDAO extends DAO {

  public static function getAll() {
    $sql = "SELECT id, category_id FROM Specialization";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getAllByLang($lang) {
    $sql = "SELECT Specialization.id, category_id, Specialization_Language.name 
      FROM Specialization, Specialization_Language 
      WHERE Specialization.id = Specialization_Language.specialization_id
      AND language_id = :lang";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':lang', $lang, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getByIDAndLang($id, $lang) {
    $sql = "SELECT Specialization_Language.name
      FROM Specialization_Language 
      WHERE specialization_id = :id
      AND language_id = :lang";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':lang', $lang, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

}