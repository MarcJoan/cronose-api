<?php

require_once '../dao/WorkDemand.dao.php';

class WorkDemandController {

  public static function getCard($card_id) {
    return WorkDemandDAO::getCard($card_id);
  }

  public static function getCards($worker_id, $client_id, $specialization_id) {
    return WorkDemandDAO::getCards($worker_id, $client_id, $specialization_id);
  }

  public static function getAll($user_id) {
    return WorkDemandDAO::getAll($user_id);
  }

  public static function getAllByStatus($user_id, $status) {
    return WorkDemandDAO::getAllByStatus($user_id, $status);
  }

}