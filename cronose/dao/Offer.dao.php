<?php

require_once 'DAO.php';

class OfferDAO extends DAO {

  public static function getAllOffers() {
    $sql = "select Offer.user_id,Offer.specialization_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
from Offer,Offer_Language,User where Offer.user_id = Offer_Language.user_id
and Offer.specialization_id = Offer_Language.specialization_id and User.id = Offer.user_id";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getOffersByLang($lang) {
    $sql = "select Offer.specialization_id,CONCAT(User.initials,User.tag)As tag_user ,User.tag,User.initials,Offer.user_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
from Offer,Offer_Language,User where Offer.user_id = Offer_Language.user_id
and Offer.specialization_id = Offer_Language.specialization_id and User.id = Offer.user_id
and Offer_Language.language_id='$lang'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
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

}
