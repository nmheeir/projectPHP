<div class="background">
    <div class="layer"></div>
    <div class="container-lg text-center py-4">
      <div class="row justify-content-center g-2">
        <?
            foreach ($orders as $order) {
            echo "       
                <div class='card col-lg-3 col-md-4 col-sm-5 text-bg-dark m-1' style='--bs-bg-opacity: .8;'>
                    <iframe 
                        class='card-img-top'
                        name='mapframe'
                        src='http://maps.google.com/maps?q={$order['latitude']},{$order['longtitdue']}&z=15&output=embed'>
                    </iframe>
                    <div class='card-body'>
                        <h5 class='card-title'>{$order['address']}</h5>
                        <p class='card-text'>{$order['description']}</p>
                    </div>
                    <div class='card-body'>
                        <a href='map.php?latitude={$order['latitude']}&longitude={$order['longtitdue']}' class='btn btn-secondary' tabindex='-1' role='button' aria-disabled='true'>Chi tiết</a>
                    </div>
                </div>
                ";
            }
        ?>
      </div>
    </div>
</div>