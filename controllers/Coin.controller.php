<?php

require_once '../controllers/User.controller.php';
require_once '../controllers/WorkDemand.controller.php';

class CoinController {

  public function getCoinHistory($user_id) {
    $actualCoin = UserController::getUserById($user_id);
    $jobs = WorkDemandController::getAllByStatus($user_id, 'done');
    $historial = "";
    foreach ($job as $jobs) {
      if($job['worker_id'] === $user_id){
        $historial['date'] = $job['work_date'];
        $historial['coins'] = $actualCoin . $job['coin_price'];
      }
    }
    return $actualCoin['coins'];
  }

}

