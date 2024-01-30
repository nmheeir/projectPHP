<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
class UserController extends BaseController
{
    private $userModel;
    private $orderModel;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->loadModel('OrderModel');
        $this->userModel = new UserModel;
        $this->orderModel = new OrderModel;
    }

    public function show($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
        }
        if ($id == null) {
            $user = $this->userModel->getUser();
            return $this->loadView('frontend.users.show', [
                "users" => $user
            ]);
        } else {
            $user = $this->userModel->getUser(
                [
                    'where' => "username = '{$id}'"
                ]
            );
            return $this->loadView('frontend.users.show', [
                "users" => $user
            ]);
        }
    }

    public function test() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //get id
            $userId = $_POST['userId'];
            $userToLayOff = $_POST['userToLayOff'];

            $user = $this->userModel->getUser([
                'where' => 'id = ' . $userId
            ]);


            $userLayOff = $this->userModel->getUser([
                'where' => 'id = ' . $userToLayOff
            ]);

            // $success = "Not ok";
            // if ($user['0']['role_id'] < $userLayOff['0']['role_id']) {
            //     $this->userModel->saveUser([
            //         'id' => $userLayOff['0']['id'],
            //         'active' => 0             
            //     ]);
            // }

        
            return $this->loadView('frontend.users.test', [
                'user' => $user,
                'userLayOff' => $userLayOff
            ]);
        }
    }

    public function order($isCompleted = 0) {
        // print_r($_SESSION);
        $shipperId = $_SESSION["user"]["id"];
        $orders = $this->orderModel->getOrder([
            'select' => '*',
            'order_by' => 'id asc',
            'where' => "shipper_id = {$shipperId} AND is_completed = {$isCompleted}"
        ]);

        $data = [
            'orders' => $orders->data,
            'state' => $isCompleted
        ];
        $this->loadView("frontend.layout.masterlayout", [
            'data' => $data,
            'page' => 'users',
            'action' => "orderList",
        ]);
    }
}
