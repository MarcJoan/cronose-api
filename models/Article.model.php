<?php

require_once 'Model.php';

class ArticleModel extends Model {

  public function __construct($title, $content, $author, $published = 0) {
    $this->schema = array(
      'title' => $title,
      'content' => $content,
      'author' => $author,
      'published' => $published
    );
    parent::__construct();
  }

  public function modelValidation($body) {
    $body = json_decode($body);
    if (!$body['title'] || !$body['content'] || !$body['author']) return false;
    return true;
  }

}
