<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/map.css"/>
</head>
<body>

<?php
    // Lấy giá trị latitude và longitude từ tham số URL
    $latitude = isset($_GET['latitude']) ? $_GET['latitude'] : '';
    $longitude = isset($_GET['longitude']) ? $_GET['longitude'] : '';
?>
<div class="background">
    <div class="layer"></div>
    <form method="get" action="https://www.google.com/maps" target="mapframe" id="mapForm">
            <input name="saddr" type="hidden" id="saddr" >
            <input name="output" type="hidden" value="embed">
            <input name="f" type="hidden" value="d">
            <input name="z" type="hidden" value="11">
            <input name="daddr" type="hidden" id="daddr" value='<?php echo "{$latitude},{$longitude}"; ?>'>
    </form>
    <iframe 
      name="mapframe" class="h-50"
      src="https://www.google.com/maps?z=11&amp;f=d&amp;output=embed&amp;ll=<?php echo "{$latitude},{$longitude}"; ?>">
    </iframe>
</div>
<script>

function getLocation() {
  return new Promise((resolve, reject) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const saddrInput = document.getElementById("saddr");
                saddrInput.value = position.coords.latitude + "," + position.coords.longitude;
                resolve();
            }, error => {
                reject(error);
            });
        } else {
            reject("Geolocation is not supported by this browser.");
        }
    });
}

function getPosition(position) {
  const daddrInput = document.getElementById("saddr");
  daddrInput.value = position.coords.latitude + "," + position.coords.longitude;
}

document.addEventListener("DOMContentLoaded", function() {
  getLocation().then(() => {
        // getLocation has completed, now submit the form
        document.getElementById("mapForm").submit();
    }).catch(error => {
        console.error(error);
    });
});


</script>
</body>
</html>
