<?php
require_once '../models/Language.model.php';

class LanguageController {

  public static function getAll($lang) {
    return LanguageModel::getAll($lang);
  }

  public static function getOfferLangs() {
    $lang = LanguageModel::getOfferLangs();
    return [
      'lang' => $lang
    ];
  }

  private static $langAvailable = ['en','es','ca'];
  private static $defaultLang = 'es';

  public function getLangs() {
    return self::$langAvailable;
  }

  // public function getLangs() {
  //   $clientLang = $_SESSION['displayLang'] ?? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
  //   $lang = in_array($clientLang, self::$langAvailable) ? $clientLang : self::$defaultLang;
  //   self::setLang($lang);
  //   return array(
  //     'language' => $lang
  //   );
  // }

  public function setLang($language) {
    $lang = in_array($language, self::$langAvailable) ? $language : self::$defaultLang;
    $_SESSION['displayLang'] = $lang;
  }

  public static function langExist($language) {
    if( in_array($language, self::$langAvailable) ) return true;
    return false;
  }

}
