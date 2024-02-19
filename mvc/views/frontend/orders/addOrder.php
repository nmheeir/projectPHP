<link rel='stylesheet' href="../TEST_3/public/css/addOrder.css"/>
<script src="../TEST_3/public/js/fetchAddOrder.js"></script>
<div class="container p-5">
    <h3 class="text-white text-center">
        Thêm đơn hàng
    </h3>


        <div class="mb-3 searchAddressContainer">
            <label for="searchAddress">Nhập Địa Chỉ:</label>
            <input type="text" id="searchAddress" placeholder="Nhập địa chỉ" name="address" autocomplete="off" required>
            <ul id="searchResults"></ul>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
        </div>
        <div class="mb-3">
            <label for="shipper_id">Người giao hàng:</label>
            <select aria-label="Chọn người giao hàng" id="shipper_id" name="shipper_id">
                <option selected>Open this select menu</option>
                <?
                    foreach($data['shipperList'] as $shipper) {
                        echo "<option value={$shipper['id']}>{$shipper['fullname']}</option>";
                    }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <input type="hidden" id="company_id" value="<?php echo $_SESSION['user']['company_id']; ?>">
        <button class="btn btn-primary w-100" onclick="fetchAddOrder()">Add Order</button>

</div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../TEST_3/public/js/fetchAddressAndCoordinate.js"></script>
<!-- <?
    if($data['message'] != null) {
        echo "
        <div class='toast-container position-fixed top-0 end-0 p-3'>
            <div id='demoToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true'>
                <div class='toast-header'>
                <strong class='me-auto'>Thông báo</strong>
                <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
                <div class='toast-body'>
                    {$data['message']}
                </div>
            </div>
        </div>
        <script>
        function showBootstrapToast() {
            var toastElement = document.getElementById('demoToast');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
        document.addEventListener('DOMContentLoaded', function () {
            showBootstrapToast();
        });
        </script> 
    ";}
?> -->
