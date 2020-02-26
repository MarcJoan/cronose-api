<?php

require_once '../controllers/User.controller.php';
require_once '../controllers/WorkDemand.controller.php';
require_once '../controllers/Category.controller.php';

class CoinController {

  public function getCoinHistory($user_id) {
    $actualCoin = UserController::getUserById($user_id);
    $actualCoin = $actualCoin['coins'];
    $jobs = WorkDemandController::getAllByStatus($user_id, 'accepted');
    $historial;

    foreach ($jobs as $job) {
      
      $job['coin_price'] = categoryController::getPriceBySpecialization($job['specialization_id']);
      $historial[$job['id']]['date'] = $job['work_date'];
      
      if($job['worker_id'] === $user_id){

        $historial[$job['id']]['new_coins'] = $actualCoin + floatval($job['coin_price']['coin_price']);
        $actualCoin += floatval($job['coin_price']['coin_price']);

      }else{

        $historial[$job['id']]['new_coins'] = $actualCoin - $job['coin_price']['coin_price'];

        $actualCoin -= floatval($job['coin_price']['coin_price']);
      }
    }

    return $historial;
  }

}

