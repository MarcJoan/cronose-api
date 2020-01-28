<?php

require_once 'Model.php';
require_once '../dao/Offer.dao.php';

class OfferModel extends Model {

  

  public static function getAllOffersByLang($lang) {
    return OfferDAO::getAllOffersByLang($lang);
  }

	public static function getOffersByIdAndLang($id, $lang) {
    return OfferDAO::getOffersByIdAndLang($id, $lang);
  }

  public static function getOffer($userInitials,$userTag,$offerEsp) {
    return OfferDAO::getOffer($userInitials,$userTag,$offerEsp);
  }

  // ------------------------------------

  public static function getAllOffers() {
    return OfferDAO::getAllOffers();
  }

  public static function getOffers($limit, $offset) {
    return OfferDAO::getOffers($limit, $offset);
  }

  public static function getOffersByLang($limit, $offset, $lang) {
    return OfferDAO::getOffersByLang($limit, $offset, $lang);
  }

  public static function getOfferLangs($user_id, $specialization_id) {
    return OfferDAO::getOfferLangs($user_id, $specialization_id);
  }
  
  public static function getFilteredOffers($filter) {
    return OfferDAO::getFilteredOffers($filter);
  }

}
