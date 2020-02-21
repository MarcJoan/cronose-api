<?php

require_once 'DAO.php';

class CityDAO extends DAO {

  public static function getAll(){
    $sql = "SELECT *
      FROM City";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getByCp($cp) {
    $sql = "SELECT *
      FROM City
      WHERE City.cp = :cp";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':cp', $cp, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function getByProvinceId($province) {
    $sql = "SELECT cp, name, longitude, latitude
      FROM City
      WHERE City.province_id = :province";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':province', $province, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

}