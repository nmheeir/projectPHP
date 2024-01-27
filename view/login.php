<?
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire'); // works
    include( "../classes/user.php");
    include( "../classes/database.php");
    include( "../inc/db.php");
    include("../inc/config_session.inc.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <style>
        /* Thêm CSS cho hiển thị thông báo lỗi */
        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="login-box">
  <h2>Đăng nhập</h2>
  <?php 
    if(isset($_POST['btnSubmit'])) 
    { 
        $username = $_POST['username'];
        $password = $_POST['password']; 
        // lưu dữ liệu khi error
        $sessionLogin = [
            "username" => $username,
            "password" => $password
        ];
        $_SESSION["session_login"] = $sessionLogin;
        // kiểm tra
        $data = User::authencicate(dbconn(), $username, $password);
        if($data->isSuccess)
        { 
            //set session
            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $userId;
            session_id($sessionId);

            $_SESSION["user_id"] = $data->data->id;
            $_SESSION["user_username"] = $data->data->username;
            $_SESSION["user_role"] = $data->data->role;
            $_SESSION['last_regeneration'] = time();

            // redirect
            header("Location: user.php"); 
            exit; 
        } 
         else {
            $_SESSION["error_login"] = $data->message;
        }
    }
 ?> 
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="user-box" >
                <input type="text" name="username" required <?if(isset($_SESSION["session_login"])) echo "value={$_SESSION['session_login']['username']}"?>>
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="text" name="password" required <?if(isset($_SESSION["session_login"])) echo "value={$_SESSION['session_login']['password']}"?>>
                <label>Mật khẩu</label>
            </div>
            
            <?
                if(isset($_SESSION["error_login"])) {
                    echo "<div class='error-message'>{$_SESSION["error_login"]}</div>";
                    unset($_SESSION["error_login"]);   
                }   
            ?>

            <div class="d-flex justify-content-around align-items-center">
                <button type="submit" name="btnSubmit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit
                </button>
                <a href="register.php" class="link-info">Đăng kí</a>
            </div>
        </form>
</div>

<script src="../bootstrap/js/bootstrap.js"></script>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>