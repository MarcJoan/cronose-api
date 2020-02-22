<?php

require_once '../dao/Card.dao.php';

class CardController {

  public static function getCard($client_id, $worker_id, $specialization_id, $card_id) {
    return CardDAO::getCard($client_id, $worker_id, $specialization_id, $card_id);
  }

  public static function getAll($user_id) {
    return CardDAO::getAll($user_id);
  }

  public static function getAllByStatus($user_id, $status) {
    return CardDAO::getAllByStatus($user_id, $status);
  }

}