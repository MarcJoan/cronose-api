<?php

require_once 'DAO.php';

class ChatDAO extends DAO {

  public static function showChat($sender, $receiver) {
    $sql = "select sender_id,receiver_id,(select name from User where sender_id = id) as name,sended_date,message from Message
where (sender_id = '" . $sender . "' and receiver_id = '" . $receiver . "') or (sender_id = '" . $receiver . "' and receiver_id = '" . $sender . "') order by sended_date;";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function sendMSG($sender, $receiver, $msg) {
    $sql = "insert into Message value('$sender', '$receiver', now(), '$msg');";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function showChats($receiver) {
    $sql = "select User.name,User.initials,User.tag from User,Message where User.id = sender_id and receiver_id = ${receiver} group by sender_id;";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

}
