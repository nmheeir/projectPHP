
<?
class App {
    const BASE_SOURCE = 'Project/TEST_3';
    private $controller = "Welcome";
    private $action = "index";
    private $params = [];
    public function __construct() {
        $arr = $this->processURL();
        // Controller
        if (file_exists("../TEST_3/mvc/controllers/" . $arr[0] . "Controller.php")) {
            $this->controller = $arr[0];
            unset($arr[0]);
        }
        else {
            include "../TEST_3/mvc/views/_404.php";
            return;
        }
        require_once "../TEST_3/mvc/controllers/" . $this->controller . "Controller.php";
        $controllerName = $this->controller . "Controller";
        $this->controller = new $controllerName;

        // Action
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            else {
                include "../TEST_3/mvc/views/_404.php";
                return;
            }
            unset($arr[1]);
        }

        // Params
        $this->params = $arr ? array_values($arr) : [];


        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    private function processURL() {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        else {
            return ["Welcome", "index"];
        }
    }
}