<?php

require_once '../models/Offer.model.php';
require_once '../controllers/User.controller.php';

class OfferController {


// ----------------Get Offers--------------------

  public static function getAllOffers() {
    $offers = OfferModel::getAllOffers();
    foreach ($offers as $key => $value) {
      $offers[$key]['translations'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }
    return $offers;
  }

  public static function getOffers($limit, $offset) {
    $offers = OfferModel::getOffers($limit, $offset);
    foreach ($offers as $key => $value) {
      $offers[$key]['translations'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }
    return $offers;
  }

  public static function getOffersByLang($limit, $offset, $lang) {
    $offers = OfferModel::getOffersByLang($limit, $offset, $lang);

    foreach ($offers as $key => $value) {
      $offers[$key]['translations'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }

    foreach ($offers as $key => $value) {
      $offers[$key]['translations'] = self::orderByLang($lang, $value['translations']);
    }
    
    return $offers;
  }

  public static function getOffersDefaultLang($limit, $offset, $lang) {
    $offers = OfferModel::getOffers($limit, $offset);

    foreach ($offers as $key => $value) {
      $offers[$key]['translations'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }

    foreach ($offers as $key => $value) {
      $offers[$key]['translations'] = self::orderByLang($lang, $value['translations']);
    }

    return $offers;
  }

  public static function getFilteredOffers($filter) {
    $offers = OfferModel::getFilteredOffers($filter);

    foreach ($offers as $key => $value) {
      $offers[$key]['translations'] = self::getOfferLangs($value['user_id'], $value['specialization_id']);
    }

    foreach ($offers as $key => $value) {
      $offers[$key]['translations'] = self::orderByLang($filter['defaultLang'], $value['translations']);
    }

    return $offers;
  }

  public static function getOffersByIdAndLang($id, $lang) {
    return OfferModel::getOffersByIdAndLang($id, $lang);
  }

  public static function getOffer($userInitials,$userTag,$offerEsp) {
    return OfferModel::getOffer($userInitials,$userTag,$offerEsp);
  }

  public static function setNewOffer($offer, $user){
    return OfferModel::setNewOffer($offer, $user);
  }

  public static function getNewOffer(){
    return $offer;
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
