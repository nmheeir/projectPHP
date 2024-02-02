<?
    function StatusButton($order) {
        $doneButton = "<button onclick='completedOrderUpdate({$order['id']}, {$order['is_completed']})' class='btn btn-info w-100' tabindex='-1' role='button' aria-disabled='true'>
                            <i class='bi bi-check-lg'></i>
                            Xong
                        </button>";
        $undoneButton = "<button onclick='completedOrderUpdate({$order['id']}, {$order['is_completed']})' class='btn btn-danger w-100' tabindex='-1' role='button' aria-disabled='true'>
                            <i class='bi bi-x-lg'></i>
                            Hủy
                        </button>";
        $statusButton = $order['is_completed'] == 0 ? $doneButton : $undoneButton;

        return $statusButton;
    }
?>
