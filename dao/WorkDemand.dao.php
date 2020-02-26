<?php

require_once 'DAO.php';
require_once '../controllers/User.controller.php';

class WorkDemandDAO extends DAO {

  public static function getCard($client_id, $worker_id, $specialization_id, $card_id) {
    $card['worker'] = UserController::getBasicUserById($worker_id);
    $card['client'] = UserController::getBasicUserById($client_id);
    $sql = "SELECT * From Card WHERE client_id = :client_id AND worker_id = :worker_id AND specialization_id = :specialization_id AND id = :card_id;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $statement->bindParam(':worker_id', $worker_id, PDO::PARAM_INT);
    $statement->bindParam(':specialization_id', $specialization_id, PDO::PARAM_INT);
    $statement->bindParam(':card_id', $card_id, PDO::PARAM_INT);
    $statement->execute();
    $card['card'] = $statement->fetch(PDO::FETCH_ASSOC);
    return $card;

  }

  public static function getAll($user_id) {

    $sql = "SELECT * From Card WHERE client_id = :user_id;";
    $sql = "SELECT * From Card WHERE (client_id = :user_id) OR (worker_id = :user_id);";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);

  }

  public static function getAllByStatus($user_id, $status) {

    $sql = "SELECT * From Card WHERE client_id = :user_id AND status = :status;";
    $sql = "SELECT * From Card WHERE (client_id = :user_id) OR (worker_id = :user_id) AND status = :status;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':status', $status, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);

  }

}