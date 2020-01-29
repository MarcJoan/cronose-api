<?php

require_once '../models/Language.model.php';

class LanguageController {

  public static function getAll($lang) {
    return LanguageModel::getAll($lang);
  }

  static $langAvailable = ['en','es','ca'];
  static $defaultLang = 'es';

  public function getDefaultLangs(){
    return self::$langAvailable;
  }

  public function getLang() {
    $clientLang = $_SESSION['displayLang'] ?? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $lang = in_array($clientLang, self::$langAvailable) ? $clientLang : self::$defaultLang;
    self::setLang($lang);
    return array(
      'language' => $lang
    );
  }

  public function setLang($language) {
    $lang = in_array($language, self::$langAvailable) ? $language : self::$defaultLang;
    $_SESSION['displayLang'] = $lang;
  }

  public static function langExist($language) {
    if( in_array($language, self::$langAvailable) ) return true;
    return false;
  }

}
