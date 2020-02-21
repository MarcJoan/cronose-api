<?php

require_once 'DAO.php';

class UserDAO extends DAO {

  private static $returnFields = "id, name, surname, surname_2, email, tag, initials, coins, avatar_id";

  public static function getAll() {
    $fields = self::$returnFields;
    $sql = "SELECT ${fields} FROM User";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getUserByInitialsAndTag($initials, $tag) {
    $fields = self::$returnFields;
    $sql = "SELECT ${fields} FROM User WHERE initials = :initials and tag = :tag;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':initials', $initials, PDO::PARAM_STR);
    $statement->bindParam(':tag', $tag, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function getUserByDni($dni) {
    $fields = self::$returnFields;
    $sql = "SELECT ${fields} FROM User WHERE dni = :dni;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':dni', $dni, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function getUserByEmail($email) {
    $fields = self::$returnFields;
    $sql = "SELECT ${fields} FROM User WHERE email = :email;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function getUsersBySearch($text) {
    $text = '%'.$text.'%';
    $fields = self::$returnFields;
    $sql = "SELECT ${fields} FROM User WHERE initials LIKE :text or tag LIKE :text or name LIKE :text or surname LIKE :text;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':text', $text, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getId($initials, $tag) {
    $sql = "SELECT id FROM User WHERE initials = :initials and tag = :tag;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':initials', $initials, PDO::PARAM_STR);
    $statement->bindParam(':tag', $tag, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function getUserByTag($tag) {
    $fields = self::$returnFields;
    $sql = "SELECT ${fields} FROM User WHERE tag = :tag;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':tag', $tag, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function saveUser($user) {
    /* DEFAULT VALUES */
    $user['surname_2'] = $user['surname_2'] ?? "";
    $user['private'] = $user['private'] ?? true;
    $user['avatar'] = $user['avatar'] ?? 'null';
    /* SAVE FILES */

    /* SQL BEGIN CONSTRUCTION */
    $fields = "dni, name, surname, surname_2, email, password, tag, initials, coins, registration_date, points, private, city_cp, province_id, avatar_id, dni_photo_id";
    $values = "'${user['dni']}', '${user['name']}', '${user['surname']}', '${user['surname_2']}', '${user['email']}', '${user['password']}', ";
    $tag = mt_rand(1000, 9999);
    $words = preg_split("/\s+/", "${user['name']} ${user['surname']} ${user['surname_2']}");
    $initials = "";
    foreach ($words as $w) {
      $initials .= $w[0];
    }
    $date = date("Y-m-d H:i:s");
    $values = $values."${tag}, '${initials}', 0, '${date}', 0, ${user['private']}, ${user['city_cp']}, ${user['province_id']}, ${user['avatar']}, ${user['dni_photo_id']}";
    $sql = "INSERT INTO User (${fields}) VALUES (${values})";
    Logger::log("DEBUG", $sql);
    /* SQL END CONSTRUCTION */
    $statement = self::$DB->prepare($sql);
    try {
      $statement->execute();
      $errors = $statement->errorInfo();
      if ($errors[1]) return Logger::log("ERROR", $errors);
      Logger::log("INFO", "New User saved with dni = ${user['dni']}");
      return self::getUserByDni($user['dni']);
    } catch (PDOException $e) {
      var_dump($statement->columnCount());
      Logger::log("ERROR", $e->getMessage());
      return null;
    }
  }

  public static function getAllDirections() {
    $sql = "SELECT DISTINCT City.name,City.longitude,City.latitude FROM City, User";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

}
