<?php

require_once '../models/Offer.model.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Language.controller.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Offer_Language.controller.php';
require_once '../controllers/User.controller.php';

class OfferController {

  public static function getAllOffers() {
    $offers = OfferModel::getAllOffers();
    return $offers;
  }

  public static function getOffersByLang($lang) {
    if (!LanguageController::langExist($lang)) return null;
    $offers = OfferModel::getOffersByLang($lang);
    if ($offers) return [
      "status" => "success",
      "offers" => $offers
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

  public static function getOffersByIdAndLang($id, $lang) {
    $offers = OfferModel::getOffersByIdAndLang($id, $lang);
    if ($offers) return [
      "status" => "success",
      "offers" => $offers
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

  public static function getOffer($userInitials,$userTag,$offerEsp) {
    $offer = OfferModel::getOffer($userInitials,$userTag,$offerEsp);
    if ($offer) return [
      "status" => "success",
      "offers" => $offer
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

  public static function setNewOffer($offer, $user){
    return OfferModel::setNewOffer($offer, $user);
  }

  public static function getNewOffer(){
    return $offer;
  }

}
