<?
require_once "../TEST_3/mvc/models/BaseModel.php";
class CompanyModel extends BaseModel {
    private $company_id;
    const TABLE_NAME = "company";
    public function __construct() {

    }
    public function getCompanyName($id) {
        try {
            $companyName = $this->get(self::TABLE_NAME, [
                'where' => "id = '{$id}'"
            ])[0]["company_name"];
            return new DataView(true, $companyName, "Ok");
        }
        catch(Exception  $e) {
            return new DataView(false, "", $e->getMessage());
        }
    }
}