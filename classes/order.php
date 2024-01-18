<?
    class Order {
        public $order_id;
        public $company_id;
        public $shipper_id;
        public $description;
        public $latitude;
        public $longitude;
        public $address;
        public $is_completed;

        public function __construct($order_id, $company_id, $shipper_id, $description, $latitude, $longitude, $address, $is_complete = 0)
        {
            $this->order_id = $order_id;
            $this->company_id = $company_id;
            $this->shipper_id = $shipper_id;
            $this->description = $description;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->address = $address;
            $this->is_completed = $is_complete;
        }

        //add Order into Database
        public function addOrder()
        {
            $conn = dbconn();
            try {
                $sql = "INSERT INTO orders (company_id, shipper_id, description, latitude, longitude, address, is_completed)
                            VALUES (:company_id, :shipper_id, :description, :latitude, :longitude, :address, :is_completed)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':company_id', $this->company_id);
                $stmt->bindParam(':shipper_id', $this->shipper_id);
                $stmt->bindParam(':description', $this->description);
                $stmt->bindParam(':latitude', $this->latitude);
                $stmt->bindParam(':longitude', $this->longitude);
                $stmt->bindParam(':address', $this->address);
                $stmt->bindParam(':is_completed', $this->is_completed);

                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error {$e->getMessage()}";
            }
        }

        public static function getAllOrders()
        {

            $conn = dbconn();

            $sql = "SELECT * FROM orders";
            $stmt = $conn->query($sql);

            $orders = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $order = new Order($row['id'], $row['company_id'], $row['shipper_id'], $row['description'], $row['latitude'], $row['longitude'], $row['address']);
                $orders[] = $order;
            }

            return $orders;
        }

        public static function getOrderByID($orderID)
        {
            $conn = dbconn();

            try {
                $sql = "SELECT * FROM orders WHERE id = :orderID";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':orderID', $orderID);

                $stmt->execute();

                $orderData = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($orderData) {
                    $order = new Order(
                        $orderData['id'],
                        $orderData['company_id'],
                        $orderData['shipper_id'],
                        $orderData['description'],
                        $orderData['latitude'],
                        $orderData['longitude'],
                        $orderData['address'],
                        $orderData['is_completed']
                    );

                    return $order;
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                echo "Error " . $e->getMessage() . "<br>";
            }
        }

        public static function deleteOrder($orderID)
        {

            try {
                $conn = dbconn();
                $sql = "DELETE FROM orders WHERE id = :id;";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $orderID);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error " . $e->getMessage() . "<br>";
            }
        }
    }
?>