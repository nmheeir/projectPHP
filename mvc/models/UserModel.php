<?

require_once "../TEST_3/mvc/models/BaseModel.php";
class UserModel extends BaseModel
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $roleId;
    private $fullname;
    private $companyId;
    private $createdAt;
    private $hashPassword;
    private $active;

    const TABLE_NAME = "users";

    public function __construct()
    {
    }

    //get data
    //trả về mảng 2 chiều chứa thông tin user, không phải object
    public function getUser($option = [])
    {
        $user = $this->get(self::TABLE_NAME, $option);
        if ($user) {
            return new DataView(true, $user, "Ok");
        } else {
            return new DataView(false, $user, "CANNOT FOUND USER");
        }
    }

    //get array role
    public function getRole($role_id)
    {
        if ($this->roleId < $role_id) {
            return $this->get(self::TABLE_NAME, [
                'where' => 'role_id'
            ]);
        }
    }

    /**
     * thay đổi hoặc thêm thông tin của user trong database
     */
    public function saveUser(array $data = [])
    {
        return $this->save(self::TABLE_NAME, $data);
    }

    public function login($username, $password)
    {
        $user = $this->getUser([
            'where' => "username = '{$username}'"
        ]);
        if ($user->isSuccess) {
            $userData = $user->data[0];
            if (password_verify($password, $userData["hash_password"])) {
                if ($userData["active"] == 0) {
                    return new DataView(false, null, "Tài khoản đã bị vô hiệu hóa");
                }
                return new DataView(true, $userData, "Đăng nhập thành công");
            } else {
                return new DataView(false, null, "Mật khẩu không đúng");
            }
        } else {
            return new DataView(false, null, $user->message);
        }
    }

    //kiểm tra thông tin trước khi đăng kí
    public function checkUser($username, $email)
    {
        $checkIsExitsUsername = $this->getUser(["where" => "username = '{$username}'"]);
        $checkIsExitsEmail = $this->getUser(["where" => "email = '{$email}'"]);
        if ($checkIsExitsUsername->isSuccess) {
            return new DataView(false, null, "USERNAME đã tồn tại");
        }
        if ($checkIsExitsEmail->isSuccess) {
            return new DataView(false, null, "EMAIL đã tồn tại");
        }
        return new DataView(true, null, "Ok");
    }

    //sau khi verify email thành công -> đăng kí user (đưa dữ liệu vào db )
    public function registerUser($username, $password, $fullname, $company_id, $email)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $newUser = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'fullname' => $fullname,
            'company_id' => $company_id,
            'hash_password' => $hashedPassword
        ];
        $this->save(self::TABLE_NAME, $newUser);
        return new DataView(true, null, "Ok");
    }

    function getUserWithRoleAndCompany()
    {
        return $this->custom("
        SELECT
            u.id AS user_id,
            u.username,
            u.email,
            u.fullname AS user_fullname,
            c.company_name,
            r.name AS role_name
        FROM
            users u
        JOIN
            company c ON u.company_id = c.id
        JOIN
            role r ON u.role_id = r.id
        WHERE
            u.id = 1;
        ");
    }
}
