<?php

require_once 'Model.php';
require_once '../dao/Chat.dao.php';

class ChatModel extends Model {

  public static function showChat($sender, $receiver) {
    return ChatDAO::showChat($sender, $receiver);
  }

  public static function sendMSG($sender, $receiver, $msg) {
    return ChatDAO::sendMSG($sender, $receiver, $msg);
  }

	public static function showChats($receiver) {
    return ChatDAO::showChats($receiver);
  }

}
