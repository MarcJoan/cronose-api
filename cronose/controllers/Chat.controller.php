<?php

require_once '../models/Chat.model.php';
require_once 'Achievement.controller.php';

class ChatController {

  public static function showChat($sender, $reciver) {
    return ChatModel::showChat($sender, $reciver);
  }

  public static function sendMSG($sender, $reciver, $msg) {
    $response = ChatModel::sendMSG($sender, $reciver, $msg);
    $achi_id = 2;
    if ( !AchievementController::haveAchi($sender, $achi_id) ) {
      AchievementController::setAchievement($sender, $achi_id);
    }
  }

  public static function showChats($reciver) {
    return ChatModel::showChats($reciver);
  }

}
