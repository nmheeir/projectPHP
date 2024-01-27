<?
    class DataView {
        public $isSuccess;
        public $data;
        public $message;

        public function __construct($_isSuccess, $_data, $_message) {
            $this->isSuccess = $_isSuccess;
            $this->data = $_data;
            $this->message = $_message;
        }
    }
?>