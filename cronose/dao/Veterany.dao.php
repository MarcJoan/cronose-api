<?php

require_once 'DAO.php';

class VeteranyDAO extends DAO {

  public static function getVet($id){
    $sql = "SELECT * FROM Change_Veteranity WHERE user_id = " . $id . ";";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

}