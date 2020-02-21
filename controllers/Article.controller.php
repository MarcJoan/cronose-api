<?php

require_once '../models/Article.model.php';

class ArticleController {

  public static function getAllArticles() {
    return ArticleModel::getAll();
  }

  public static function create($body) {
    if (!ArticleModel::modelValidation($body)) return null;
    $body = json_decode($body);
    $model = new ArticleModel($body['title'], $body['content'], $body['author'], $body['published']);
    return $model->save();
  }

  public static function updateArticleById($id) {
    if (!ArticleModel::modelValidation($body)) return null;
    return ArticleModel::updateById($id, $body);
  }

  public static function getArticleById($id) {
    return ArticleModel::getById($id);
  }

  public static function deleteArticleById($id) {
    return ArticleModel::deleteById($id);
  }

}

?>
