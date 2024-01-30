<?php
    // Lấy giá trị latitude và longitude từ tham số URL
    $latitude = $data['order']['latitude'];
    $longitude = $data['order']['longitdue'];
?>
<div class="d-flex flex-column flex-md-row">
    <div class="flex-grow-1">
        <form method="get" action="https://www.google.com/maps" target="mapframe" id="mapForm">
            <input name="saddr" type="hidden" id="saddr">
            <input name="output" type="hidden" value="embed">
            <input name="f" type="hidden" value="d">
            <input name="z" type="hidden" value="10">
            <input name="daddr" type="hidden" id="daddr" value='<?php echo "{$latitude},{$longitude}"; ?>'>
        </form>
        <iframe 
            name="mapframe" style="width: 100%; height: 100vh"
            src="http://maps.google.com/maps?output=embed&q=<?php echo "{$latitude},{$longitude}"; ?>">
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

                        // Đưa giá trị vào ô input có id="saddr"
                        document.getElementById("saddr").value = currentLatitude + "," + currentLongitude;

                        // Submit form
                        document.getElementById("mapForm").submit();
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
    </div>
</div>
