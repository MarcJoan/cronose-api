<?php

require_once '../models/Offer.model.php';
require_once '../controllers/User.controller.php';

class OfferController {


// ----------------Get Offers--------------------

  public static function getAllOffers() {
    $offers = OfferModel::getAllOffers();
    foreach ($offers as $key => $value) {
      $offers[$key]['Offers'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }

    if ($offers) return [
      "status" => "success",
      "offers" => $offers
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

  public static function getOffers($limit) {
    $offers = OfferModel::getOffers($limit);
    foreach ($offers as $key => $value) {
      $offers[$key]['Offers'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }

    if ($offers) return [
      "status" => "success",
      "offers" => $offers
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

  public static function getOffersByLang($limit,$lang) {
    $offers = OfferModel::getOffersByLang($limit, $lang);

    foreach ($offers as $key => $value) {
      $offers[$key]['Offers'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }

    foreach ($offers as $key => $value) {
      $offers[$key]['Offers'] = self::orderByLang($lang, $value['Offers']);
    }

    if ($offers) return [
      "status" => "success",
      "offers" => $offers
    ];
    else return [
      "status" => "error",
      "msg" => "Something went wrong!"
    ];
  }

  public static function getOffersDefaultLang($limit,$lang) {
    $offers = OfferModel::getOffers($limit);

    foreach ($offers as $key => $value) {
      $offers[$key]['translation'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }

    foreach ($offers as $key => $value) {
      $offers[$key]['translation'] = self::orderByLang($lang, $value['translation']);
    }

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


  // --------------------------------

  public static function orderByLang($lang, $array) {
    foreach ($array as $key => $value) {
      if ($value['language_id'] == $lang) {
        $aux = $value;
        unset($array[$key]);
        array_unshift($array, $aux);
      }
    }
    return $array;
  }


  public static function getOfferLangs($user_id, $specialization_id) {
    return OfferModel::getOfferLangs($user_id, $specialization_id);
  }

// -----------------------------------------------------

  

  

}
