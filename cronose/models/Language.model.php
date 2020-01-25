<?php

require_once 'Model.php';
require_once '../dao/Language.dao.php';

class LanguageModel {

  public static function getAll($lang) {
    return LanguageDAO::getAll($lang);
  }

}
