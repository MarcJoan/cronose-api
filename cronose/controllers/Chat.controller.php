<?php

require_once '../models/Chat.model.php';
require_once 'Achievement.controller.php';

class ChatController {

  public static function showChat($sender, $receiver) {
    return ChatModel::showChat($sender, $receiver);
  }

  public static function sendMSG($sender, $receiver, $msg) {
    $response = ChatModel::sendMSG($sender, $receiver, $msg);
    $achi_id = 2;
    if ( !AchievementController::haveAchi($sender, $achi_id) ) {
      AchievementController::setAchievement($sender, $achi_id);
    }
  }

  public static function showChats($receiver) {
    return ChatModel::showChats($receiver);
  }

}
