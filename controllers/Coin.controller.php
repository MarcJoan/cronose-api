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
        $historial[$job['id']]['new_coins'] = number_format(floatval($historial[$job['id']]['new_coins']), 2, '.', ',');
        $actualCoin += floatval($job['coin_price']['coin_price']);

      }else{

        $historial[$job['id']]['new_coins'] = $actualCoin - $job['coin_price']['coin_price'];
        $historial[$job['id']]['new_coins'] = number_format(floatval($historial[$job['id']]['new_coins']), 2, '.', ',');
        $actualCoin -= floatval($job['coin_price']['coin_price']);
      }
      $demand['id'] = $job['Demand_id'];
      $demand['client_id'] = $job['client_id'];
      $demand['worker_id'] = $job['worker_id'];
      $demand['specialization_id'] = $job['specialization_id'];
      $demand['demanded_at'] = $job['demanded_at'];

      $work['id'] = $job['id'];
      $work['status'] = $job['status'];
      $work['work_date'] = $job['work_date'];
      $work['qr_code_id'] = $job['qr_code_id'];
      $work['cancelation_policy'] = $job['cancelation_policy_id'];

      $historial[$job['id']]['demand'] = $demand;
      $historial[$job['id']]['work'] = $work;
    }

    return $historial;
  }

}

