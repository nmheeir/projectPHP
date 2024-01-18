<?
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire'); // works
    include( "../classes/user.php");
    include( "../classes/database.php");
    include( "../inc/db.php");
    include("../inc/config_session.inc.php")
?>

<?php 
    if(isset($_POST['btnSubmit'])) 
    { 
        $username = $_POST['username'];
        $password = $_POST['password']; 
        $fullname = $_POST['fullname'];  
        $company_id = $_POST['company_id']; 
        // lưu dữ liệu khi error
        $sessionRegister = [
            "username" => $username,
            "password" => $password,
            "fullname" => $fullname,
            "company_id" => $company_id
        ];
        $_SESSION["session_register"] = $sessionRegister;
        // Kiểm tra rỗng
        if(empty($username) || empty($password) || empty($fullname) || empty($company_id)) {
            $_SESSION["error_register"] = "Hãy điền đầy đủ thông tin";
        }
        else {
            // Sử dụng hàm registerUser từ class User để đăng ký người dùng mới
            $checkRegister = User::registerUser(dbconn(), $username, $password, $fullname, $company_id);
            
            // Kiểm tra kết quả đăng ký
            if ($checkRegister->isSuccess) {
                header("Location: login.php");
                unset($_SESSION["error_register"]);
                exit;
            } else {
                $_SESSION["error_register"] = $checkRegister->message;
            }
        }
    }
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
        <h2>Đăng kí</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="user-box">
                <input type="text" name="username" required oninput="validateUsername()" <?if(isset($_SESSION["session_register"])) echo "value={$_SESSION['session_register']['username']}"?>>
                <label>Username</label>
                <div id="usernameError" class="error-message"></div>
            </div>
            <div class="user-box">
                <input type="text" name="fullname" required <?if(isset($_SESSION["session_register"])) echo "value={$_SESSION['session_register']['fullname']}"?>>
                <label>Tên đầy đủ của bạn</label>
            </div>
            <div class="user-box">
                <input type="text" name="company_id" required <?if(isset($_SESSION["session_register"])) echo "value={$_SESSION['session_register']['company_id']}"?>>
                <label>Nhập mã công ty của bạn</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required oninput="validatePassword()" <?if(isset($_SESSION["session_register"])) echo "value={$_SESSION['session_register']['password']}"?>>
                <label>Mật khẩu</label>
                <div id="passwordError" class="error-message"></div>
            </div>
            <div class="user-box">
                <input type="password" name="confirm_password" required oninput="validateConfirmPassword()">
                <label>Nhập lại mật khẩu</label>
                <div id="confirmPasswordError" class="error-message"></div>
            </div>
            <?
                if(isset($_SESSION["error_register"])) {
                    echo "<div class='error-message'>{$_SESSION["error_register"]}</div>";
                    unset($_SESSION["error_register"]);   
                }   
            ?>
            <div class="d-flex justify-content-around align-items-center">
                <button type="submit" name="btnSubmit" onclick="return validateForm()">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit
                </button>
                <a href="login.php" class="link-info">Đăng nhập</a>
            </div>
        </form>
    </div>
    <script src="../js/registerValidate.js"></script>
</body>
</html>