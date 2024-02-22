<?php
   $latitude = $data['order']['latitude'];
   $longitude = $data['order']['longitude'];

   require_once "../TEST_3/mvc/views/frontend/orders/statusButton.php";
   $statusButton = StatusButton($data['order']);
?>

<div class="d-flex flex-column flex-md-row">
    <!-- Phần trái (bản đồ) -->
    <div class="col-md-6 col-12 d-md-flex vh-100 -50">
    <iframe 
        name="mapframe" style="width: 100%; height: 100%"
        src="https://www.google.com/maps?z=15&saddr=&output=embed&f=d&z=15&daddr=<?php echo "{$latitude},{$longitude}"; ?>">
    </iframe>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Kiểm tra xem trình duyệt có hỗ trợ geolocation không
                if (navigator.geolocation) {
                    // Gọi hàm getCurrentPosition để lấy thông tin vị trí hiện tại
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // Lấy tọa độ latitude và longitude
                        const currentLatitude = position.coords.latitude;
                        const currentLongitude = position.coords.longitude;

                        // Đưa giá trị vào tham số saddr trong src iframe
                        const mapFrame = document.getElementsByName("mapframe")[0];
                        mapFrame.src = `https://www.google.com/maps?saddr=${currentLatitude},${currentLongitude}&output=embed&f=d&z=10&daddr=<?php echo "{$latitude},{$longitude}"; ?>`;
                    }, function(error) {
                        console.error("Error getting geolocation:", error);
                    });
                } else {
                    console.error("Geolocation is not supported by this browser.");
                }
            });
        </script>
    </div>

    <!-- Phần phải (Thông tin chi tiết) -->
    <div class="col-md-6 col-12 h-50 text-white p-4">
        <h2>Thông tin chi tiết</h2>
        <p><strong>Latitude:</strong> <?php echo $latitude; ?></p>
        <p><strong>Longitude:</strong> <?php echo $longitude; ?></p>
        <p><strong>Thông tin về đơn hàng:</strong> <?php echo $data['order']['description']; ?></p>
        <p><strong>Địa chỉ đơn hàng:</strong> <?php echo $data['order']['address']; ?></p>
        <p><strong>Nhân viên giao hàng:</strong> <?php echo $data['order']['shipper_name']; ?></p>
        <?php echo $statusButton; ?>
    </div>
</div>



<script src="../TEST_3/public/js/fetchUpdateOrder.js">
