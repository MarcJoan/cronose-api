<?php

require_once 'Model.php';
require_once '../dao/Language.dao.php';

class LanguageModel extends Model {

  public static function getOfferLangs() {
    return LanguageDAO::getOfferLangs();
  }

}
