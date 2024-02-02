


<!DOCTYPE html>
<html lang="en">
<head>
    <base href="http://localhost/Project/TEST_3/" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../TEST_3/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../TEST_3/public/css/user.css"/>
    <link rel="stylesheet" href="../TEST_3/public/css/base.css"/>
    <link rel="stylesheet" href="../TEST_3/node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .my-gradient {
            background: #0d1a25;
        }
        .nav-link {
            color: #6f7d88
        }
        .my-sidebar-bg {
            background-color: #162c3b;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row flex-nowrap fixed">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 my-sidebar-bg">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="User/home" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="bi bi-car-front"></i> <span class="ms-1 d-none d-sm-inline">Đơn hàng của bạn</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="Order/userOrderList/0" class="nav-link px-0"> <span class="d-none d-sm-inline">Chưa hoàn thành</span><i class="bi bi-bag-x-fill"></i></a>
                            </li>
                            <li>
                                <a href="Order/userOrderList/1" class="nav-link px-0"> <span class="d-none d-sm-inline">Đã hoàn thành</span><i class="bi bi-bag-check-fill"></i></a>
                            </li>
                            <li>
                                <a href="Order/userOrderList/2" class="nav-link px-0"> <span class="d-none d-sm-inline">Quá hạn</span><i class="bi bi-calendar2-x"></i></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../TEST_3/public/upload/Kiki.webp" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1"><? echo $_SESSION["user"]["username"] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="Authenciation/logout">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col p-0 scroll my-gradient">
            <?
                 $this->loadView("frontend.{$page}.{$action}", [
                    'data' => $data,
                 ]);
            ?>
        </div>
    </div>
</div>
<script src="../TEST_3/bootstrap/js/bootstrap.js"></script>
<script src="../TEST_3/bootstrap/js/bootstrap.bundle.min.js"></script> 
</body>
</html>