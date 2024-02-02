<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
require_once "../TEST_3/mvc/controllers/AuthenciationController.php";
class WelcomeController extends BaseController {
    public function index() {
        $authController = new AuthenciationController();
        if($authController->checkLogin()) {
            header("Location: Order/userOrderList");
        }
        else {
            header("Location: Authenciation/login");
        }
    }
}