

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/login.css">
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
        <form method="post" action="http://localhost/Project/TEST_3/Authenciation/login">
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
                <a href="register" class="link-info">Đăng kí</a>
            </div>
        </form>
</div>

<script src="../bootstrap/js/bootstrap.js"></script>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script> 
</body>
</html>