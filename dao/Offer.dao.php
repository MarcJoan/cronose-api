<?php

require_once 'DAO.php';

class OfferDAO extends DAO {

  public static function getAllOffersByLang($lang) {
    $sql = "SELECT Offer.specialization_id,CONCAT(User.initials,User.tag)AS tag_user ,User.tag,User.initials,Offer.user_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
      FROM Offer,Offer_Language,User 
      WHERE Offer.user_id = Offer_Language.user_id
      AND Offer.specialization_id = Offer_Language.specialization_id 
      AND User.id = Offer.user_id
      AND Offer_Language.language_id='$lang'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getOffersByIdANDLang($id, $lang) {
    $sql = "SELECT Offer.specialization_id,CONCAT(User.initials,User.tag)AS tag_user,User.tag,User.initials,Offer.user_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
      FROM Offer,Offer_Language,User 
      WHERE Offer.user_id = Offer_Language.user_id
      AND Offer.specialization_id = Offer_Language.specialization_id 
      AND User.id= Offer.user_id
      AND Offer_Language.language_id='$lang' 
      AND User.id = '$id'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getOffer($userInitials,$userTag,$offerEsp) {
    $sql = "SELECT Offer.specialization_id,User.tag,User.initials,Offer.user_id,Offer_Language.language_id,User.name,Offer_Language.title,Offer_Language.description,Offer.personal_valoration,Offer.valoration_avg,Offer.coin_price
      FROM Offer,Offer_Language,User 
      WHERE Offer.user_id = Offer_Language.user_id
      AND Offer.specialization_id = Offer_Language.specialization_id 
      AND User.id = Offer.user_id
      AND Offer.specialization_id = $offerEsp
      AND User.tag= $userTag
      AND User.initials = '$userInitials'";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  // ---------------------------------

  public static function getAllOffers() {
    $sql = "SELECT Offer.user_id, Offer.specialization_id, User.initials, User.tag, User.name, User.surname, Offer.offered_at, Offer.coin_price, Offer.personal_valoration,Offer.valoration_avg, Offer.visibility 
      FROM User,Offer 
      WHERE User.id = Offer.user_id";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getOffers($limit, $offset) {
    $sql = "SELECT Offer.user_id, Offer.specialization_id, User.initials, User.tag, User.name, User.surname, Offer.offered_at, Offer.coin_price, Offer.personal_valoration,Offer.valoration_avg 
      FROM User,Offer 
      WHERE User.id = Offer.user_id 
      AND Offer.visibility = true 
      LIMIT :limit OFFSET :offset";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getOffersByLang($limit, $offset, $lang) {
    $sql = "SELECT Offer.user_id, Offer.specialization_id, User.initials, User.tag, User.name, User.surname, Offer.offered_at, Offer.coin_price, Offer.personal_valoration,Offer.valoration_avg 
      FROM Offer,Offer_Language,User 
      WHERE Offer.visibility = true 
      AND User.id = Offer.user_id 
      AND Offer.user_id = Offer_Language.user_id 
      AND Offer.specialization_id = Offer_Language.specialization_id 
      AND Offer_Language.language_id = :lang 
      LIMIT :limit OFFSET :offset";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':lang', $lang, PDO::PARAM_STR);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getOfferLangs($user_id, $specialization_id) {
    $sql = "SELECT Offer_Language.language_id,Offer_Language.title,Offer_Language.description
      FROM Offer,Offer_Language 
      WHERE Offer.user_id = Offer_Language.user_id
      AND Offer.specialization_id = Offer_Language.specialization_id 
      AND Offer.user_id = :user_id 
      AND Offer.specialization_id = :specialization_id;";
    $statement = self::$DB->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':specialization_id', $specialization_id, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getFilteredOffers($filter) {
    
    $sql = "SELECT Offer.user_id, Offer.specialization_id, User.initials, User.tag, User.name, User.surname, Offer.offered_at, Offer.coin_price, Offer.personal_valoration,Offer.valoration_avg
    FROM Offer, Offer_Language, User, Specialization 
    WHERE Offer.visibility = true 
    AND User.id = Offer.user_id 
    AND Offer.user_id = Offer_Language.user_id 
    AND Offer.specialization_id = Offer_Language.specialization_id 
    AND Offer.specialization_id = Specialization.id  ";

    if (isset($filter['langs'])) {
      $langs = "AND (";
      foreach ($filter['langs'] as $key => $value) {
        if ($key != 0) $langs .= "OR ";
        $langs .= "Offer_Language.language_id = '${value}' ";
      }
      $sql .= $langs . ") ";
    }
    if ($filter['category']) $sql .=  "AND Specialization.category_id = ${filter['category']} ";
    if ($filter['specialization']) $sql .=  "AND Specialization.id = ${filter['specialization']} ";
    if ($filter['string']) $sql .=  "AND Offer_Language.title LIKE '%${filter['string']}%' ";
    $sql .= "GROUP BY Offer.user_id,Offer.specialization_id
      LIMIT 10 OFFSET 0 ";
    $statement = self::$DB->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
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
