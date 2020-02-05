<?php

require_once 'Model.php';
require_once '../dao/Offer.dao.php';

class OfferModel extends Model {

  public static function getAllOffers() {
    return OfferDAO::getAllOffers();
  }

  public static function getOffersByLang($lang) {
    return OfferDAO::getOffersByLang($lang);
  }

	public static function getOffersByIdAndLang($id, $lang) {
    return OfferDAO::getOffersByIdAndLang($id, $lang);
  }

  public static function getOffer($userInitials,$userTag,$offerEsp) {
    return OfferDAO::getOffer($userInitials,$userTag,$offerEsp);
  }

  public static function setNewOffer($offer, $user){
    return OfferDAO::setNewOffer($offer, $user);
  }

//   public static function getOffersByUsername($username) {
//     $statement = self::query("select Language_Translation.translation,User.name,Offer_Language.title,Offer_Language.description,concat(Media.url,Media.extension) as media
// from Offer,Offer_Language,User,Language,Language_Translation,Media,Load_Media
// where User.dni = Offer.user_dni and Offer.user_dni = Offer_Language.user_dni and Language.id = Offer_Language.language_id
// and Offer.specialization_id = Offer_Language.specialization_id and Offer.user_dni = Offer_Language.user_dni
// and Language_Translation.language_id = Language.id and Language_Translation.translation = 'Spanish'
// and Media.id = Load_Media.media_id and Load_Media.user_dni = Offer.user_dni and Load_Media.specialization_id = Offer.specialization_id
// and User.name = '$username'");
//     return $statement->fetchAll();
//   }

}
