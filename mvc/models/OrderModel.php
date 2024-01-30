<?
require_once "../TEST_3/mvc/models/BaseModel.php";
class OrderModel extends BaseModel {
    private $id;
    private $companyId;
    private $shipperId;
    private $description;
    private $latitude;
    private $longitude;
    private $address;
    private $isCompleted;
    private $createdAt;
    private $completedAt;

    const TABLE_NAME = "orders";

    public function __construct() {
        parent::__construct();
    }

    public static function createOrder($companyId, $shipperId, $description, $latitude, $longitude, $address, $isCompleted = 0, $createdAt = null, $completedAt = null)
    {
        $order = new OrderModel;
        $order->companyId = $companyId;
        $order->shipperId = $shipperId;
        $order->description = $description;
        $order->latitude = $latitude;
        $order->longitude = $longitude;
        $order->address = $address;
        $order->isCompleted = $isCompleted;
        $order->createdAt = $createdAt;
        $order->completedAt = $completedAt;
        
        return $order;
    }

    public function getOrder($option = [
        'select' => '*',
        'order_by' => 'id asc'
    ]) {
        $data = $this->get(self::TABLE_NAME, $option);
        if(count($data) > 0) {
            return new DataView(true, $data, "Ok");
        }
        else {
            return new DataView(false, null, "NO DATA");
        }
    }

    public function saveOrder(array $data) {
        return $this->save(self::TABLE_NAME, $data);
    }

}