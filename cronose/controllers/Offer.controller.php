<?php

require_once '../models/Offer.model.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Language.controller.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Offer_Language.controller.php';
require_once '../controllers/User.controller.php';

class OfferController {

  public static function getAllOffers() {
    $offers = OfferModel::getAllOffers();
  }



// -----------------------------------------------



  public static function getAllOffersGroupByLang($lang) {
    $offers = OfferModel::getAllOffers();
    $list = [];
    
    foreach ($offers as $key => $value) {
      $userId = self::inArray($value['user_id'], $list);
      $specializationId = self::inArray($value['specialization_id'], $list);

      if (!$userId && !$specializationId) {;
        $list[$key]["user_id"]= $value['user_id'];
        $list[$key]["specialization_id"]= $value['specialization_id'];
        $list[$key]['offer'] = [];
      }
    }

    $list = array_values($list);

    foreach ($offers as $key => $value) {
      $list = self::setOffers($value, $value['user_id'], $value['specialization_id'], $list);
    }
    var_dump($list);

  }

  public static function setOffers($offer, $userId, $specializationId, $array) {

    foreach ($array as $key => $value) {
      if ($value['user_id'] == $userId) {
        array_push($array[$key]['offer'], $offer);
      }
    }
    return $array;

  }

  public static function inArray($val, $array) {
    foreach ($array as $key => $value) {
      foreach ($value as $key2 => $value2) {
        if ($value2 == $val) return true;
      };
    };
    return false;
  }



// -----------------------------------------------------



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

}
