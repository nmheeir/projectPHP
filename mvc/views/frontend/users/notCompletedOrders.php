<div class="bg-dark">
    <div class="container-lg py-4">
        <div class="row justify-content-center g-2">
            <h3 class="text-white text-center">
              Công việc cần làm hôm nay
            </h3>
            <?
            foreach ($orders as $order) {
            echo "       
                <div class='card col-lg-3 col-md-4 col-sm-5 text-bg-secondary border-success m-2 p-0'>
                    <iframe 
                        class='card-img-top'
                        name='mapframe'
                        src='http://maps.google.com/maps?q={$order['latitude']},{$order['longtitdue']}&z=15&output=embed'>
                    </iframe>
                    <div class='card-body align-self-stretch'>
                        <h5 class='card-title'>{$order['address']}</h5>
                        <p class='card-text'>{$order['description']}</p>
                    </div>
                    <div class='card-body'>
                        <a href='map.php?latitude={$order['latitude']}&longitude={$order['longtitdue']}' class='btn btn-primary' tabindex='-1' role='button' aria-disabled='true'>Chi tiết</a>
                    </div>
                </div>
                ";
            }
        ?>
      </div>
</div>
    
