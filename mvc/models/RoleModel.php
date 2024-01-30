<?
require_once "../TEST_3/mvc/models/BaseModel.php";
class RoleModel extends BaseModel {
    private $role_id;
    const TABLE_NAME = "role";
    public function __construct() {

    }
    public function getRoleName($id) {
        try {
            $roleName = $this->get(self::TABLE_NAME, [
                'where' => "id = '{$id}'"
            ])[0]["name"];
            return new DataView(true, $roleName, "Ok");
        }
        catch(Exception  $e) {
            return new DataView(false, "", $e->getMessage());
        }
    }
}