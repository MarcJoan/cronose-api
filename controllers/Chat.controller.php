<?php

require_once '../dao/Chat.dao.php';
require_once 'Achievement.controller.php';

class ChatController {

  public static function showChat($sender, $receiver) {
    return ChatDAO::showChat($sender, $receiver);
  }

  public static function sendMSG($sender, $receiver, $msg) {
    $response = ChatDAO::sendMSG($sender, $receiver, $msg);
    $achi_id = 2;
    if ( !AchievementController::haveAchi($sender, $achi_id) ) {
      AchievementController::setAchievement($sender, $achi_id);
    }
  }

  public static function showChats($receiver) {
    return ChatDAO::showChats($receiver);
  }

}
