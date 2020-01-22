<?php

require_once '../models/Chat.model.php';
require_once 'Achievement.controller.php';

class ChatController {

  public static function showChat($sender, $reciver) {
    $response = ChatModel::showChat($sender, $reciver);
    if ($response) return [
      "status" => "success",
      "msg" => $response
    ];
    else return [
      "status" => "error",
      "msg" => "Ops!"
    ];
  }

  public static function sendMSG($sender, $reciver, $msg) {
    $response = ChatModel::sendMSG($sender, $reciver, $msg);
    $achi_id = 2;
    if ( !AchievementController::haveAchi($sender, $achi_id) ) {
      AchievementController::setAchievement($sender, $achi_id);
    }
    return json_encode($response);
  }

  public static function showChats($reciver) {
    $response = ChatModel::showChats($reciver);

    if ($response) return [
      "status" => "success",
      "users" => $response
    ];
    else return [
      "status" => "error",
      "msg" => "Ops!"
    ];
  }

}
