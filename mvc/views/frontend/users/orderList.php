<?
    $orders = $data["orders"];
    $state = $data['state'] == 0 ? 'danger' : 'success';
?>

<div style="min-height: 100vh;">
    <div class="container-lg py-4">
        <div class="row justify-content-center g-2">
            <h3 class="text-white text-center">
                Công việc cần làm hôm nay
            </h3>

            <?php
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    echo "
                        <div class='card col-lg-3 col-md-4 col-sm-5 text-bg-secondary border-{$state} m-2 p-0'>
                            <iframe 
                                class='card-img-top'
                                name='mapframe'
                                src='http://maps.google.com/maps?q={$order['latitude']},{$order['longitdue']}&z=15&output=embed'>
                            </iframe>
                            <div class='card-body align-self-stretch'>
                                <h5 class='card-title'>{$order['address']}</h5>
                                <p class='card-text'>{$order['description']}</p>
                            </div>
                            <div class='card-body'>
                                <a href='Order/orderDetail/{$order['id']}' class='btn btn-primary' tabindex='-1' role='button' aria-disabled='true'>Chi tiết</a>
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
<script>
    function completedOrderUpdate(orderId) {
        // Dữ liệu bạn muốn gửi lên server
        const dataToSend = {
            id: orderId,
            is_completed: 0,
        };
        console.log(JSON.stringify(dataToSend))
        // Sử dụng Fetch API để thực hiện PUT request
        fetch(`http://localhost/Project/TEST_3/Order/updateOrder`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(dataToSend),
        })
        .then()
        .catch(error => {
            console.error('Error:', error);
            // Xử lý lỗi (nếu cần)
        });
    }
</script>