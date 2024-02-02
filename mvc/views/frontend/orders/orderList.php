<?
    require_once "../TEST_3/mvc/views/frontend/orders/statusButton.php";
    $orders = $data["orders"];
    $state = $data['state'] == 0 ? 'danger' : 'success';
?>
<style>
    .title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .des {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<div style="min-height: 100vh;">
    <div class="container-lg py-4">
        <div class="row justify-content-center g-2">
            <h3 class="text-white text-center">
                Công việc cần làm hôm nay
            </h3>

            <?php
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                   $statusButton = StatusButton($order);
                    echo "
                        <div class='card col-lg-3 col-md-5 text-bg-secondary border-{$state} m-2 p-0'>
                            <iframe 
                                class='card-img-top'
                                name='mapframe'
                                src='http://maps.google.com/maps?q={$order['latitude']},{$order['longitude']}&z=15&output=embed'>
                            </iframe>
                            <div class='card-body align-self-stretch' style='height: 150px'>
                                <h5 class='card-title title'>{$order['address']}</h5>
                                <p class='card-text des'>{$order['description']}</p>
                            </div>
                            <div class='card-body'>
                                <a href='Order/orderDetail/{$order['id']}' class='btn btn-primary w-100 mb-1' tabindex='-1' role='button' aria-disabled='true'>Chi tiết</a>
                                {$statusButton}
                            </div>
                        </div>
                    ";
                }
            } else {
                echo "<p class='text-white text-center'>Bạn không có đơn hàng nào trong mục này.</p>";
            }
            ?>
        </div>
    </div>
</div>
<script src="../TEST_3/public/js/fetchUpdateStatusOrder.js">
</script>