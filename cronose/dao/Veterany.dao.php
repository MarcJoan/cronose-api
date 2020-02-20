<?php

require_once 'DAO.php';

class VeteranyDAO extends DAO {

  public static function getVet($id){
    $sql = "SELECT * FROM Change_Veteranity 
      WHERE user_id = :id;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function getRange($id){
    $sql = "SELECT Change_Veteranity.veteranity_level, Veteranity.points 
      FROM Change_Veteranity,Veteranity 
      WHERE Change_Veteranity.veteranity_level = Veteranity.level
      AND user_id = :id;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

}
