<?php
   $latitude = $data['order']['latitude'];
   $longitude = $data['order']['longitdue'];
   $doneButton = "<button onclick='completedOrderUpdate({$data['order']['id']}, {$data['order']['is_completed']})' class='btn btn-info' tabindex='-1' role='button' aria-disabled='true'>Đã làm xong</button>";
   $undoneButton = "<button onclick='completedOrderUpdate({$data['order']['id']}, {$data['order']['is_completed']})' class='btn btn-danger' tabindex='-1' role='button' aria-disabled='true'>Chưa làm xong</button>";
   $statusButton = $data['order']['is_completed'] == 0 ? $doneButton : $undoneButton;
?>

<div class="d-flex flex-column flex-md-row">
    <div class="flex-grow-1">
        <iframe 
            name="mapframe" style="width: 100%; height: 100vh"
            src="https://www.google.com/maps?saddr=&output=embed&f=d&z=10&daddr=<?php echo "{$latitude},{$longitude}"; ?>">
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

    <div class="flex-grow-1 text-white p-4">
        <h2>Thông tin chi tiết</h2>
        <p><strong>Latitude:</strong> <?php echo $latitude; ?></p>
        <p><strong>Longitude:</strong> <?php echo $longitude; ?></p>
        <p><strong>Thông tin về đơn hàng:</strong> <?php echo $data['order']['description']; ?></p>
        <p><strong>Địa chỉ đơn hàng:</strong> <?php echo $data['order']['address']; ?></p>
        <? echo $statusButton ?>
    </div>
</div>

<script src="../TEST_3/public/js/fetchUpdateStatusOrder.js">
