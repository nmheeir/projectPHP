<?
    include("../inc/config_session.inc.php");
    include("../inc/db.php");
    include("../classes/user.php");
    if(!isset($_SESSION["user_id"])) {
        header("Location: login.php"); 
    }
?>

<?
    $orders = User::getOrderById(dbconn());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/shipper.css"/>
</head>
<body>
<?
    if($_SESSION["user_role"] == 3) {
        include("./shipper.php");
    }
?>
<script src="../bootstrap/js/bootstrap.js"></script>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>