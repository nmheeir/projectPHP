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

    public function orderDetail($id) {
        $orderDetail = $this->orderModel->getOrder([
            'where' => "id = {$id}"
        ]);

        $data = [
            'order' => $orderDetail->data[0]
        ];

        $this->loadView("frontend.layout.masterlayout", [
            'data' => $data,
            'page' => 'orders',
            'action' => "orderDetail",
        ]);
    }

    public function updateOrder() {
        $orderUpdateData = json_decode(file_get_contents("php://input"), true);
        if ($orderUpdateData !== null) {
            // Dữ liệu đã được nhận thành công
            $this->orderModel->saveOrder($orderUpdateData);
        } else {
            // Đối với một số lý do nào đó, không thể giải mã JSON
            echo "Failed to decode JSON data";
        }
    }
}
