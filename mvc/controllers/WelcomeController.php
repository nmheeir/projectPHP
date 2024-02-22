<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
require_once "../TEST_3/mvc/inc/checkLogin.php";
class WelcomeController extends BaseController {
    public function index() {
        if(checkLogin()) {
            header("Location: Order/userOrderList");
        }
        else {
            header("Location: Authenciation/login");
        }
    }
}