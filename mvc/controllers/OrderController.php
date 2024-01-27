<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
class OrderController extends BaseController
{
    private $orderModel;
    public function __construct()
    {
        $this->loadModel('OrderModel');
        $this->orderModel = new OrderModel;
    }

    public function index()
    {
        return $this->loadView('', []);
    }

    public function show()
    {
        $order = $this->orderModel->getOrder(
            []
        );

        return $this->loadView('frontend.orders.show', [
            "orders" => $order
        ]);
    }

    public function save()
    {
        return $this->loadView('frontend.orders.save');
    }
}
