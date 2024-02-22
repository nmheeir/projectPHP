<?
require_once "../TEST_3/mvc/models/BaseModel.php";
class CompanyModel extends BaseModel {
    private $company_id;
    const TABLE_NAME = "company";
    public function __construct() {

    }
    public function getCompanyInfo($id) {
        $companyInfo = $this->get(self::TABLE_NAME, [
            'where' => "id = '{$id}'"
        ]);
        if($companyInfo) {
            return new DataView(true, $companyInfo[0], "Ok");
        }
        else {
            return new DataView(false, null, "Mã công ty sai hoặc không tồn tại");
        }
    }

    public function registerCompany($companyName) {
        // Kiểm tra tên công ty có tồn tại hay chưa
        $companyInfo = $this->get(self::TABLE_NAME, [
            'where' => "company_name = '{$companyName}'"
        ]);
        if($companyInfo) {
            return new DataView(false, null, "Tên công ty đã tồn tại");
        }
        else {
            $dataCompany = [
                'company_name' => $companyName,
            ];
            $companyId = $this->save('company', $dataCompany);
            if ($companyId) {
                return new DataView(true, $companyId, "");
            }
        }

    }
}