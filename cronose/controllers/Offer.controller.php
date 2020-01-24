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

  public static function getAllOffersOrderedByLang($lang) {
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

    foreach ($list as $key => $value) {
      $list[$key] = self::orderByLang($lang, $value);
    }

    if ($list) return [
      "status" => "success",
      "offers" => $list
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
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

  public static function orderByLang($lang, $array) {
    for ($i = 0; $i < count($array['offer']); $i++) { 
      if ($array['offer'][$i]['language_id'] == $lang) {
        $aux = $array['offer'][$i];
        unset($array['offer'][$i]);
        array_unshift($array['offer'], $aux);
      }
    }
    return $array;
    // var_dump($array);
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
