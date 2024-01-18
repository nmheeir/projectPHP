<?
    require_once "../classes/user.php";
    require_once "../classes/database.php";
    require_once "../inc/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="login-box">
  <h2>Login</h2>
  <?php 
    if(isset($_POST['btnSubmit'])) 
    { 
        $username = $_POST['username'];
        $password = $_POST['password'];
        $form = $_SERVER['PHP_SELF']; 
        if(User::authencicate(dbconn(), $username, $password))
        { 
                header("Location: tesst.php"); 
                exit; 
            } 
        } else 
        { ?> 
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="user-box" >
                    <input type="text" name="username">
                    <label>Username</label>
                </div>
                <div class="user-box">
                    <input type="text" name="password">
                    <label>Password</label>
                </div>
                <button type="submit" name="btnSubmit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit
                </button>
            </form>
  <?php } ?>
</div>

</body>
</html>