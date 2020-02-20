<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

session_start();

// Controllers
require_once '../controllers/Language.controller.php';
require_once '../controllers/Offer.controller.php';
require_once '../controllers/User.controller.php';
require_once '../controllers/Chat.controller.php';
require_once '../controllers/Achievement.controller.php';
require_once '../controllers/Category.controller.php';
require_once '../controllers/Specialization.controller.php';
require_once '../controllers/Province.controller.php';
require_once '../controllers/City.controller.php';
require_once '../controllers/Veterany.controller.php';

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

//URI
$uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"));
$auxUri = $uri;
array_splice($auxUri, 0, 1);
$auxUriString = implode("/", $auxUri);

/*-------Language-------*/
// $langController = LanguageController::getLang();
// $displayLang = $langController['language'];

//Method
$method = strtolower($_SERVER['REQUEST_METHOD']);

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
          /***REVISAR***/
$router->get('/users/{search}', function($search) {
  echo json_encode(UserController::getUsersBySearch($search));
});
          /*************/
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

//     case 'register':
//       if ($method == 'post') {
//         echo json_encode(UserController::register($_POST['user']));
//       }
//       break;

//     case 'login':
//       $_POST = json_decode($_POST);
//       var_dump($_POST);
//       if ($method == 'post') {
//         echo json_encode(UserController::userLogin($_POST['email'], $_POST['password']));
//       }
//       break;

// Offers
$router->get('/works', function() {
  echo json_encode(OfferController::getAllOffers());
});
$router->get('/works/filter/{filter}', function($filter) {
  echo json_encode(OfferController::getFilteredOffers($_REQUEST['filter']));
});
$router->get('/works/{offset}/{limit}/default/{lang}', function($offset, $limit, $lang) {
  echo json_encode(OfferController::getOffersDefaultLang($limit, $offset, $lang));
});
$router->get('/works/{lang}/{offset}/{limit}', function($lang, $offset, $limit) {
  echo json_encode(OfferController::getOffersByLang($limit, $offset, $lang));
});
$router->get('/works/{offset}/{limit}', function($offset, $limit) {
  echo json_encode(OfferController::getOffers($limit, $offset));
});
$router->get('/work/{initials}/{tag}/{specialization}', function($initials, $tag, $specialization) {
  echo json_encode(OfferController::getOffer($initials, $tag, $specialization));
});

// Chat
$router->get('/chats/{user_id}', function($user_id) {
  echo json_encode(ChatController::showChats($user_id));
});
$router->get('/chat/{sender_id}/{receiver_id}', function($sender_id, $receiver_id) {
  echo json_encode(ChatController::showChat($sender_id, $receiver_id));
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

// if ($uri[0] == 'api') {
//   switch ($uri[1]) {

// //     case 'categories':
// //       if (count($uri) == 2) echo json_encode(CategoryController::getAllByLang($displayLang));
// //       if (count($uri) == 3) echo json_encode(CategoryController::getAllByLang($uri[2]));
// //       break;

// //     case 'specialization':
// //       if (count($uri) == 2) echo json_encode(SpecializationController::getAll());
// //       if (count($uri) == 3) echo json_encode(SpecializationController::getAllByLang($uri[2]));
// //       if (count($uri) == 4) echo json_encode(SpecializationController::getAllByIDAndLang($uri[2], $uri[3]));
// //       break;

// //     case 'provinces':
// //       echo json_encode(ProvinceController::getAll());
// //       break;

// //     case 'cities':
// //       if ($method == 'get') {
// //         if (isset($uri[2]) && preg_match("/^province/", $uri[2], $match)) {
// //           echo json_encode(CityController::getByProvinceId($_GET['province_id']));
// //         } else {
// //           echo json_encode(CityController::getAll());
// //         }
// //       }
// //       break;

//     case 'register':
//       if ($method == 'post') {
//         echo json_encode(UserController::register($_POST['user']));
//       }
//       break;

//     case 'login':
//       $_POST = json_decode($_POST);
//       var_dump($_POST);
//       if ($method == 'post') {
//         echo json_encode(UserController::userLogin($_POST['email'], $_POST['password']));
//       }
//       break;

// //     case 'user':
// //       if ($method == 'get') {
// //         if (count($uri) == 2) echo json_encode(UserController::getUserByInitialsAndTag($user->initials, $user->tag));
// //         if (count($uri) == 3) echo json_encode(UserController::getUsersBySearch($uri[2]));
// //         if (count($uri) == 4) echo json_encode(UserController::getUserByInitialsAndTag($uri[2], $uri[3]));
// //         if (count($uri) == 6) echo json_encode(UserController::getId($uri[4], $uri[5]));;
// //       }
// //       break;

// //     case 'profile':
// //       if ($method == 'get') {
// //         if (count($uri) == 2) echo json_encode(UserController::getUserByInitialsAndTag($user->initials, $user->tag));
// //         if (count($uri) == 3) echo json_encode(UserController::getProfileInfo($uri[2]));
// //       }
// //       break;

// //     case 'works':
// //       if ($method == 'get') {
// //         if (count($uri) == 2) echo json_encode(OfferController::getAllOffers());
// //         if (count($uri) == 4 && $uri[2] > 0 && $uri[3] >= 0) echo json_encode(OfferController::getOffers($uri[2], $uri[3]));
// //         if (count($uri) == 5 && $uri[2] > 0 && $uri[3] >= 0 && $uri[3] != 'filter' ) echo json_encode(OfferController::getOffersByLang($uri[2], $uri[3], $uri[4]));
// //         if (count($uri) == 6 && $uri[4] == 'default') echo json_encode(OfferController::getOffersDefaultLang($uri[2], $uri[3], $uri[4]));
// //         if (count($uri) == 5 && $uri[3] == 'filter') echo json_encode(OfferController::getFilteredOffers($_REQUEST['filter']));
// //         //if (count($uri) == 4 && $uri[2] == 'lang') echo json_encode(OfferController::getAllOffersOrderedByLang($uri[3]));
// //       }
// //       break;

// //     case 'work':
// //        if ($method == 'get') {
// //          if (count($uri) == 2) echo json_encode(OfferController::getOffer($uri[2],$uri[3],$uri[4]));
// //          if (count($uri) == 5) echo json_encode(OfferController::getOffer($uri[2],$uri[3],$uri[4]));
// //       }
// //     break;

// //     case 'myWorks':
// //       if ($method == 'get') {
// //         if (count($uri) == 2) echo json_encode(OfferController::getOffersByIdAndLang($user->id, $displayLang));
// //       }
// //       break;

// //     case 'category':
// //        if ($method == 'get') {
// //          if (count($uri) == 2) echo json_encode(CategoryController::getCountSpecialization($_SESSION['displayLang']));
// //       }
// //     break;

//     case 'directions':
//       if ($method == 'get') {
//         if (count($uri) == 2) echo json_encode(UserController::getAllDirections());
//       }

// //     case 'chat':
// //     // var_dump($uri);
// //       if ($method == 'get') {
// //         if (count($uri) == 2){
// //           echo json_encode(ChatController::showChats($user->id));
// //         }
// //         if (count($uri) == 4){
// //           echo json_encode(ChatController::showChat($uri[2], $uri[3]));
// //         };
// //       }

// //       if (count($uri) == 5 && $uri[2] == 'send' && $method == 'post') {
// //         echo ChatController::sendMSG($uri[3], $uri[4], $_POST['msg']);
// //       }
// //       break;

// //     case 'achievements':

// //       if ($method == 'get') {

// //         switch(count($uri)){
// //           case 2:
// //             echo json_encode(AchievementController::getAll($displayLang));
// //             break;

// //           case 3:
// //             echo json_encode(AchievementController::getById($uri[2], $displayLang));
// //             break;

// //           case 5:
// //             $user_id = UserController::getId($uri[3], $uri[4]);
// //             echo json_encode(AchievementController::haveAchi($user_id['user']['id'], $uri[2]));
// //             break;

// //         }
// //       }

// //       if ($method == 'post') {
// //         $user_id = UserController::getId($uri[2], $uri[3]);
// //         echo json_encode(AchievementController::setAchievement($user_id['id'], $uri[4]));
// //       }
// //       break;

// //     case 'veterany':
// //       echo json_encode(VeteranyController::getVet($user->id));
// //       break;

// //     case 'veteranyRange':
// //       echo json_encode(VeteranyController::getRange($user->id));
// //       break;

//     case 'lang':
//       if ($method == 'get' && count($uri) == 3 && $uri[2] == 'offers') echo json_encode(LanguageController::getOfferLangs());
//       break;

//     default:
//       echo "Nothing";
//       break;

//   }

// } else if ($uri[0] != 'assets') {

//   if (!LanguageController::langExist($uri[0])) {
//     array_unshift($uri, $displayLang);
//     $uriString = implode("/", $uri);
//     header('Location: ' . $uriString);
//   } else if($displayLang != $uri[0]) {
//     $displayLang = $uri[0];
//     $_SESSION['displayLang'] = $displayLang;
//   }
//   /*----------------------*/

//   switch ($uri[1]){
//     case '':
//       header('Location: ' . $displayLang . '/home');
//       break;

//     case 'statistics':
//       if (isset($_SESSION['user']) && $user->name =="Admin"){
//         include '../views/statistics.php';
//       }else{
//         include '../views/loginStatistics.php';
//       }
//       break;

//     case 'loginStatistics':
//       include '../views/loginStatistics.php';
//       break;


//     case 'login':
//       $title = $lang[$displayLang]['logIn'];
//       include '../views/login.php';
//       break;

//     case 'register':
//       $title = $lang[$displayLang]['register'];
//       include '../views/register.php';
//       break;

//     case 'logout':
//       UserController::userLogout();
//       header('Location: ' . $displayLang . '/home');
//       break;

//     case 'home':
//       include '../views/home.php';
//       break;

//     case 'market':
//       $title = $lang[$displayLang]['market'];
//       // $offers = OfferController::getOffersByLang($displayLang);
//       include '../views/market.php';
//       break;

//     case 'about-us':
//       $title = $lang[$displayLang]['aboutUs'];
//       include '../views/about-us.php';
//       break;

//     case 'my-works':
//       $title = $lang[$displayLang]['myOffers'];
//       // $dataController = WorkController::getMyOffers();
//       include '../views/myWorks.php';
//       break;

//     case 'chat':
//       $title = $lang[$displayLang]['chat'];
//       include '../views/chat.php';
//       break;

//     case 'wallet':
//       $title = $lang[$displayLang]['wallet'];
//       include '../views/wallet.php';
//       break;

//     case 'profile':
//       $title = $lang[$displayLang]['profile'];
//       include '../views/profile.php';
//       break;

//     case 'user':
//       $title = $lang[$displayLang]['profile'];
//       include '../views/profile.php';
//       break;

//     case 'card':
//       include '../views/card.php';
//       break;

//     case 'edit-profile':
//       include '../views/editProfile.php';
//       break;

//     case 'new-work':
//       include '../views/newWork.php';
//       break;

//     case 'work':
//       $title = $lang[$displayLang]['work'];
//       include '../views/work.php';
//       break;

//     case 'preview-work':
//       include '../views/previewWork.php';
//       break;

//     case 'published':
//       include '../views/published.php';
//       break;

//     /*---------RAMIREZ----------*/
//     case 'datatable':
//       if ($uri[2] == 'province') {
//         include '../views/datatables/province.php';
//       };
//       if ($uri[2] == 'category') {
//         include '../views/datatables/category.php';
//       };
//       if ($uri[2] == 'company') {
//         include '../views/datatables/company.php';
//       };
//       break;
//     /*--------------------------*/

//     default:
//       header('Location: ' . $displayLang . '/home');
//       break;
//   }
// }
$router->run();

?>
