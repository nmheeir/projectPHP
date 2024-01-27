<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
class WelcomeController extends BaseController {
    public function login() {
        $this->loadView('frontend.authenciation.login');
    }

    public function register() {
        $this->loadView('frontend.authenciation.register');
    }
}