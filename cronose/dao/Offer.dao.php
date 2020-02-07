<?php

require_once 'DAO.php';

class OfferDAO extends DAO {

  public static function getAllOffers() {
    $sql = "select Offer.user_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
from Offer,Offer_Language,User where Offer.user_id = Offer_Language.user_id
and Offer.specialization_id = Offer_Language.specialization_id and User.id = Offer.user_id";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function getOffersByLang($lang) {
    $sql = "select Offer.specialization_id,CONCAT(User.initials,User.tag)As tag_user ,User.tag,User.initials,Offer.user_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
from Offer,Offer_Language,User where Offer.user_id = Offer_Language.user_id
and Offer.specialization_id = Offer_Language.specialization_id and User.id = Offer.user_id
and Offer_Language.language_id='$lang'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function getOffersByIdAndLang($id, $lang) {
    $sql = "select Offer.specialization_id,CONCAT(User.initials,User.tag)As tag_user,User.tag,User.initials,Offer.user_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
from Offer,Offer_Language,User where Offer.user_id = Offer_Language.user_id
and Offer.specialization_id = Offer_Language.specialization_id and User.id= Offer.user_id
and Offer_Language.language_id='$lang' and User.id = '$id'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getOffer($userInitials,$userTag,$offerEsp) {
    $sql = "select Offer.specialization_id,User.tag,User.initials,Offer.user_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
  from Offer,Offer_Language,User where Offer.user_id = Offer_Language.user_id
  and Offer.specialization_id = Offer_Language.specialization_id and User.id = Offer.user_id
  and Offer.specialization_id = $offerEsp
  and User.tag= $userTag
  and User.initials = '$userInitials'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function setNewOffer($offer, $user){

    self::setNewOfferLang($offer, $user);

    $sp = $offer['specialization'];
    $val = $offer['valoration'] * 20;
    $coin_price = self::getCoinPrice($sp);
    $coin_price = $coin_price['coin_price'];

    $sql = "INSERT INTO `Offer` 
    (`user_id`, `specialization_id`, `valoration_avg`, `personal_valoration`, `coin_price`, `offered_at`, `visibility`)
    VALUES ($user->id, $sp, 0, $val, $coin_price, now(), 1 ); ";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
  }

  public static function getCoinPrice($sp){
    $sql = "SELECT coin_price FROM Category, Specialization WHERE $sp = Specialization.id AND Specialization.category_id = Category.id;";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function setNewOfferLang($offer, $user){
    $id = $user->id;
    $lang = $offer['lang'];
    $sp = $offer['specialization'];
    $title = $offer['title'];
    $description = $offer['description'];

    $sql = "INSERT into Offer_language VALUES ('$lang', $id, $sp, '$title','$description');";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
  }

}
