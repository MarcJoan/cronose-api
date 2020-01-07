<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/utilities/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/utilities/Logger.php';

class Model {

  protected $model;
  protected $schema;
  private static $DB;

  public function __construct() {
    $this->model = str_replace('Model', '', get_called_class());
    self::$DB = DB::connect();
  }

  public function modelValidation($body) { return false; }

  public static function getAll() {
    $model = str_replace('Model', '', get_called_class());
    $sql = "SELECT * FROM " . $model;
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll() || [];
  }

  public function save() {
    $keys = implode(", ", array_keys($this->schema));
    $values = implode("', '", $this->schema);
    $sql = "INSERT INTO " . $this->model . "(" . $keys . ") VALUES ('" . $values . "')";
    $statement = self::$DB->prepare($sql);
    try {
      $statement->execute();
      if ($statement->fetch(PDO::FETCH_ASSOC) > 0) return Logger::log("ERROR", "This " . $this->model . " already exists.");
      Logger::log("INFO", "New " . $this->model . " saved.");
      return $statement || null;
    } catch (PDOException $e) {
      Logger::log("ERROR", $e->getMessage());
      return null;
    }
  }

  public function getById($id) {
    $sql = "SELECT FROM " . $this->model . " WHERE id = " . $id . ";";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement || null;
  }

  public function updateById($id, $body) {
    $body = json_decode($body, true);
    if ( !self::getById($id) ) return Logger::log("ERROR", "No " . $this->model . " with id = " . $id);
    $updatedSchema = array_merge($this->schema, $body);
    $lastKey = array_key_last ($updatedSchema);

    $sql = "UPDATE " . $this->model . " SET ";
    foreach ($updatedSchema as $key => $value) {
      $sql = $sql . $key . " = '" . $value . "'";
      if( $lastKey !== $key ) $sql = $sql . ",";
    }
    $sql = $sql . " WHERE id = " . $id . ";";

    $statement = self::$DB->prepare($sql);
    $statement->execute();
    if($statement->fetch(PDO::FETCH_ASSOC) > 0) return Logger::log("ERROR", "This " . $this->model . " already exists.");
    Logger::log("INFO", "Updated " . $this->model . " with id = " . $id);
    return $statement || null;
  }

  public static function deleteById($id) {
    $model = str_replace('Model', '', get_called_class());
    $sql = "DELETE FROM " . $model . " WHERE id = " . $id . ";";
    $statement = self::$DB->prepare($sql);
    if (!self::getById($id)) return Logger::log("ERROR", "No " . $model . " with id = " . $id);
    try {
      $statement->execute();
      Logger::log("WARNING", "Deleted " . $model . " with id = " . $id);
      return $statement || null;
    } catch (PDOException $e) {
      Logger::log("ERROR", $e->getMessage());
      return null;
    }
  }

}