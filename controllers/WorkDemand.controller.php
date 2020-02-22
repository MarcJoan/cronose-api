<?php

require_once '../dao/WorkDemand.dao.php';

class WorkDemandController {

  public static function getCard($client_id, $worker_id, $specialization_id, $card_id) {
    return WorkDemandDAO::getCard($client_id, $worker_id, $specialization_id, $card_id);
  }

  public static function getAll($user_id) {
    return WorkDemandDAO::getAll($user_id);
  }

  public static function getAllByStatus($user_id, $status) {
    return WorkDemandDAO::getAllByStatus($user_id, $status);
  }

}