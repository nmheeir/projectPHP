<?
    if(isset($data['orderId']) && isset($data['orderDetail'])) {
        $address = $data['orderDetail'][0]['address'];
        $des = $data['orderDetail'][0]['description'];
        $latitude = $data['orderDetail'][0]['latitude'];
        $longitude = $data['orderDetail'][0]['longitude'];
    }   
?>

<link rel='stylesheet' href="../TEST_3/public/css/addOrder.css"/>
<script src="../TEST_3/public/js/fetchUpdateOrder.js"></script>
<script src="../TEST_3/public/js/fetchAddOrder.js"></script>
<script src="../TEST_3/public/js/showToast.js"></script>
<div class="container p-2">
    <h3 class="text-white text-center">
        Thêm đơn hàng
    </h3>
        <div class="mb-3 searchAddressContainer">
            <label for="searchAddress">Nhập Địa Chỉ:</label>
            <input type="text" id="searchAddress" placeholder="Nhập địa chỉ" name="address" autocomplete="off" required value="<?= isset($address) ? htmlspecialchars($address) : '' ?>">
            <ul id="searchResults"></ul>
            <input type="hidden" id="latitude" name="latitude" value="<?= isset($latitude) ? htmlspecialchars($latitude) : '' ?>">
            <input type="hidden" id="longitude" name="longitude" value="<?= isset($longitude) ? htmlspecialchars($longitude) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="shipper_id">Người giao hàng:</label>
            <select aria-label="Chọn người giao hàng" id="shipper_id" name="shipper_id">
                <option selected>Open this select menu</option>
                <?php
                    foreach($data['shipperList'] as $shipper) {
                        echo "<option value='{$shipper['id']}'>{$shipper['fullname']}</option>";
                    }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?= isset($des) ? htmlspecialchars($des) : '' ?></textarea>
        </div>
        <input type="hidden" id="company_id" value="<?php echo isset($_SESSION['user']['company_id']) ? htmlspecialchars($_SESSION['user']['company_id']) : ''; ?>">
        <?php if(isset($data['orderId'])): ?>
            <input type="hidden" id="orderId" value="<?= $data["orderId"]?>">
        <?php endif; ?>

        <?
            if(!isset($data["orderId"])) {
                echo "<button class='btn btn-primary w-100' onclick='fetchAddOrder()'>Add Order</button>";
            }
            else {
                echo "<button class='btn btn-primary w-100' onclick='updateOrder()'>Update Order</button>";
            }
        ?>
</div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../TEST_3/public/js/fetchAddressAndCoordinate.js"></script>
