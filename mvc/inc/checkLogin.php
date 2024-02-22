<?
function checkLogin() {
    if(isset($_SESSION["user"])) {
        return true;
    }
    else {
            if(!isset($_COOKIE["user_id"])) {
                return false;
            }
            else {
                $userModel = (function() {
                    require('../TEST_3/mvc/models/UserModel.php');
                    return new UserModel();
                })();
                $data = $userModel->getUser([
                    'where' => "id = '{$_COOKIE["user_id"]}'"
                ]);
                if($data->isSuccess)
                { 
                    // thiết lập session
                    $sessionUserInfo = [
                        "id" => $data->data[0]["id"],
                        "username" =>  $data->data[0]["username"],
                        "role_id" => $data->data[0]["role_id"],
                        "company_id" => $data->data[0]["company_id"]
                    ];
                    $_SESSION["user"] = $sessionUserInfo;
                    return true;
                }
                else {
                    return false;
                }
            }
        }
    }
?>