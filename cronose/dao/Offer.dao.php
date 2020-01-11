<?php

require_once 'DAO.php';

class OfferDAO extends DAO {

  public static function getAllOffers() {
    $sql = "select Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
from Offer,Offer_Language,User where Offer.user_dni = Offer_Language.user_dni
and Offer.specialization_id = Offer_Language.specialization_id and User.dni = Offer.user_dni";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function getOffersByLang($lang) {
    $sql = "select Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
from Offer,Offer_Language,User where Offer.user_dni = Offer_Language.user_dni
and Offer.specialization_id = Offer_Language.specialization_id and User.dni = Offer.user_dni
and Offer_Language.language_id='$lang'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

}