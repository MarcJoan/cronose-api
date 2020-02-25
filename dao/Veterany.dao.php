<?php

require_once 'DAO.php';

class VeteranyDAO extends DAO {

  public static function getVeterany($id){
    $sql = "SELECT * FROM Change_Veterany 
      WHERE user_id = :id;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function getRange($id){
    $sql = "SELECT Change_Veterany.veterany_level, Veterany.points 
      FROM Change_Veterany,Veterany 
      WHERE Change_Veterany.veterany_level = Veterany.level
      AND user_id = :id;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

}
