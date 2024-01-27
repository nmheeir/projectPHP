<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add or Update Order</title>
</head>

<body>

    <?php
    // Include OrderModel class and database connection logic here
    require_once '../TEST_3/mvc/models/OrderModel.php';
    require_once '../TEST_3/mvc/models/BaseModel.php';

    // Xử lý khi form được gửi đi
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        // Lấy dữ liệu từ form
        $companyId = $_POST['company_id'];
        $shipperId = $_POST['shipper_id'];
        $description = $_POST['description'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $address = $_POST['address'];
        $isCompleted = isset($_POST['is_completed']) ? 1 : 0;

        $data = [
            'id' => $id,
            'company_id' => $companyId,
            'shipper_id' => $shipperId,
            'description' => $description,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $address,
            'is_completed' => $isCompleted
        ];

        $order = new OrderModel();
        try {
            $order->saveOrder([
                'id' => $id,
                'company_id'=> $companyId,
                'shipper_id'=> $shipperId,
                'description'=> $description,
                'latitude'=> $latitude,
                'longitude'=> $longitude,
                'address'=> $address,
                'is_completed'=> $isCompleted
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    ?>
    <h2>Add or Update Order</h2>

    <form method="post">
        <label for="id">ID:</label>
        <input type="text" name="id">
        <br>
        <label for="company_id">Company ID:</label>
        <input type="text" name="company_id" >
        <br>

        <label for="shipper_id">Shipper ID:</label>
        <input type="text" name="shipper_id" >
        <br>

        <label for="description">Description:</label>
        <input type="text" name="description" >
        <br>

        <label for="latitude">Latitude:</label>
        <input type="text" name="latitude" >
        <br>

        <label for="longitude">Longitude:</label>
        <input type="text" name="longitude" >
        <br>

        <label for="address">Address:</label>
        <input type="text" name="address" >
        <br>

        <label for="is_completed">Is Completed:</label>
        <input type="checkbox" name="is_completed">
        <br>

        <input type="submit" value="Submit">
    </form>

</body>

</html>