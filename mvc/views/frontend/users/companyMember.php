<?

?>
<div class="container p-2">
    <div class="row">
        <div class="col-lg-12">    
        <h2 class="h3 text-center text-white">Các thành viên trong công ty của bạn</h2>
        <?
            foreach($data as $user) {
                $style = '';
                switch ($user['role_id']) {
                    case 1:
                        $style = 'background-color: rgba(145, 10, 103, 0.4); color: #fff; border-radius: 10px;'; // Đỏ
                        break;
                    case 2:
                        $style = 'background-color: rgba(255, 208, 236, 0.4); color: #fff; border-radius: 10px;'; // Xanh lá cây
                        break;
                    case 3:
                        $style = 'background-color: rgba(71, 79, 122, 0.4); color: #fff; border-radius: 10px;'; // Xanh dương
                        break;
                    default:
                        break;
                }

        // Hiển thị thông tin user với style tương ứng
        echo "
            <div style='{$style}' class='d-flex align-items-center m-2 p-2'>
                <div class='image m-2'><img src='../TEST_3/public/upload/Kiki.webp' alt='...' class='rounded-circle' style='height: 60px; width: 60px'></div>
                <div class='text'>
                    <a href='User/detail/{$user['id']}' class='text-decoration-none link'>
                        <h3 class='h5'>{$user['fullname']}</h3>
                    </a>
                    <small>{$user['username']}</small>
                </div>
            </div>
        ";
    }
?>

        </div>    
    </div>
</div>