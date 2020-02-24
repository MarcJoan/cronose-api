<?php

//  Headers -> Implementar els headers al apache

session_start();

// Controllers
require_once '../controllers/Language.controller.php';
require_once '../controllers/Work.controller.php';
require_once '../controllers/User.controller.php';
require_once '../controllers/Chat.controller.php';
require_once '../controllers/Achievement.controller.php';
require_once '../controllers/Category.controller.php';
require_once '../controllers/Specialization.controller.php';
require_once '../controllers/Province.controller.php';
require_once '../controllers/City.controller.php';
require_once '../controllers/Veterany.controller.php';
require_once '../controllers/WorkDemand.controller.php';

// DAO
require_once '../dao/DAO.php';
new DAO();

// Logger
require_once '../utilities/Logger.php';

//Lang
require '../views/components/language.php';

//Router
require_once '../utilities/Router.php';
$router = new Router();

/*-----User logged------*/
if (isset($_SESSION['user'])) $user = json_decode($_SESSION['user']);

// Categories
$router->get('/categories', function() {
  echo json_encode(CategoryController::getAll());
});
$router->get('/categories/{lang}', function($lang) {
  echo json_encode(CategoryController::getAllByLang($lang));
});

// Specialization
$router->get('/specialization', function() {
  echo json_encode(SpecializationController::getAll());
});
$router->get('/specialization/{lang}', function($lang) {
  echo json_encode(SpecializationController::getAllByLang($lang));
});

// Provinces
$router->get('/provinces', function() {
  echo json_encode(ProvinceController::getAll());
});
$router->get('/province/{id}', function($id) {
  echo json_encode(ProvinceController::getById($id));
});

// Cities
$router->get('/cities', function() {
  echo json_encode(CityController::getAll());
});
$router->get('/city/{cp}', function($cp) {
  echo json_encode(CityController::getByCp($cp));
});

// User
$router->get('/users', function() {
  echo json_encode(UserController::getAll());
});
$router->get('/users/{search}', function($search) {
  echo json_encode(UserController::getUsersBySearch($search));
});
$router->get('/user/{initials}/{tag}/id', function($initial, $tag) {
  echo json_encode(UserController::getId($initial, $tag));
});
$router->get('/user/{initials}/{tag}', function($initial, $tag) {
  echo json_encode(UserController::getUserByInitialsAndTag($initial, $tag));
});
// Register
$router->post('/register', function() {
  echo json_encode(UserController::register($_POST['user']));
});
// Login
$router->post('/login', function() {
  echo json_encode(UserController::userLogin($_POST['email'], $_POST['password']));
});

// Works
$router->get('/works', function() {
  echo json_encode(WorkController::getAllWorks());
});
$router->get('/works/filter/{filter}', function($filter) {
  echo json_encode(WorkController::getFilteredWorks($_REQUEST['filter']));
});
$router->get('/works/{offset}/{limit}/default/{lang}', function($offset, $limit, $lang) {
  echo json_encode(WorkController::getWorksDefaultLang($limit, $offset, $lang));
});
$router->get('/works/{lang}/{offset}/{limit}', function($lang, $offset, $limit) {
  echo json_encode(WorkController::getWorksByLang($limit, $offset, $lang));
});
$router->get('/works/{offset}/{limit}', function($offset, $limit) {
  echo json_encode(WorkController::getWorks($limit, $offset));
});
$router->get('/work/{initials}/{tag}/{specialization}', function($initials, $tag, $specialization) {
  echo json_encode(WorkController::getWork($initials, $tag, $specialization));
});

// Cards
$router->get('/card/{client_id}/{worker_id}/{specialization_id}/{card_id}', function($client_id, $worker_id, $specialization_id, $card_id) {
  echo json_encode(WorkDemandController::getCard($client_id, $worker_id, $specialization_id, $card_id));
});
$router->get('/card/{status}/{user_id}', function($status, $user_id){
  echo json_encode(WorkDemandController::getAllByStatus($user_id, $status));
});
$router->get('/card/{user_id}', function($user_id){
  echo json_encode(WorkDemandController::getAll($user_id));
});

// Chat
$router->get('/chats/{user_id}', function($user_id) {
  echo json_encode(ChatController::showChats($user_id));
});
$router->get('/chat/{sender_id}/{receiver_id}/{offset}/{limit}', function($sender_id, $receiver_id, $offset, $limit) {
  echo json_encode(ChatController::showChat($sender_id, $receiver_id, $offset, $limit));
});
$router->get('/chat/{sender_id}/{receiver_id}', function($sender_id, $receiver_id) {
  echo json_encode(ChatController::showAllChat($sender_id, $receiver_id));
});
$router->post('/chat/{sender_id}/{receiver_id}', function($sender_id, $receiver_id) {
  ChatController::sendMSG($sender_id, $receiver_id, $_POST['msg']);
});

// Achievements
$router->get('/achievement/{user_id}/{achievement}', function($user_id, $achievement) {
  echo json_encode(AchievementController::haveAchi($user_id, $achievement));
});
$router->post('/achievement/{user_id}/{achievement}', function($user_id, $achievement) {
  echo json_encode(AchievementController::setAchievement($user_id, $achievement));
});
$router->get('/achievements/{lang}', function($lang) {
  echo json_encode(AchievementController::getAllByLang($lang));
});
$router->get('/achievements', function() {
  echo json_encode(AchievementController::getAll());
});

// Veterany
$router->get('/veterany/range/{user_id}', function($user_id) {
  echo json_encode(VeteranyController::getRange($user_id));
});
$router->get('/veterany/{user_id}', function($user_id) {
  echo json_encode(VeteranyController::getVet($user_id));
});

// Error 404
$router->set404(function() {
  header('HTTP/1.1 404 Not Found');
  echo "Error 404, Not Found";
});

$router->run();

?>
