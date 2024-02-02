<link rel="stylesheet" href="../TEST_3/public/css/addOrder.css"/>
<div class="container p-5">
    <h3 class="text-white text-center">
        Thêm đơn hàng
    </h3>

    <form action="http://localhost/Project/TEST_3/Order/addOrder" method="post">
        <div class="mb-3 searchAddressContainer">
            <label for="searchAddress">Nhập Địa Chỉ:</label>
            <input type="text" id="searchAddress" placeholder="Nhập địa chỉ" name="address" autocomplete="off">
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
        
        <button type="submit" class="btn btn-primary w-100" name="btnSubmit">Add Order</button>
    </form>
</div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../TEST_3/public/js/fetchAddOrder.js">
</script>

