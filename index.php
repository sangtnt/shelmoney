<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>RuangAdmin - Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.css" rel="stylesheet">
</head>

<body id="page-top">
    <?php
        require "./checkLogin.php";
        require "userModel.php";
        $users = findAll();
        require "./entity/user.php";
        if ($users->num_rows > 0) {
            while($row = $users->fetch_assoc()) {
              // echo md5(time().mt_rand(1,1000000));
            }
          } else {
            echo "0 results";
        }
    ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="img/logo/logo.png">
                </div>
                <div class="sidebar-brand-text mx-3">SHELMONEY</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang chủ</span></a>
            </li>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <span
                                    class="ml-2 d-none d-lg-inline text-white small"><?php echo $_SESSION["fullname"]?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Trang chủ</h1>
                    </div>

                    <div class="row mb-3">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <?php
                              $date = date('m');
                              $year = date("Y");
                            ?>
                            <a class="link-custom"
                                href="viewSpending.php?date=<?php echo $date ?>&year=<?php echo $year?>">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1">Chi tiêu
                                                    tháng này
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                              echo moneyTotalUsedThisMonth();
                                            ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <?php
                            $year = date("Y");
                            $date = date('m', strtotime("previous month"));
                          ?>
                            <a class="link-custom"
                                href="viewSpending.php?date=<?php echo $date ?>&year=<?php echo $year?>">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1">Chi tiêu
                                                    tháng
                                                    trước</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php
                                                echo moneyTotalUsedLastMonth();
                                              ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-calendar-minus fa-2x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Chi tiêu
                                                năm
                                                trước</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                echo moneyTotalUsedLastYear();
                                              ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New User Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a class="link-custom" href="viewDebtor.php">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1">Người vay
                                                    tiền
                                                    chưa trả</div>
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php 
                                                $results = numberOfDebtor();
                                                echo $results->num_rows;
                                              ?> người
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a class="link-custom" href="viewBalance.php">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1">Số dư
                                                    hiện tại
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php
                                                echo balance();
                                              ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-coins fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Modal Logout -->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelLogout">Đăng xuất</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có chắc muốn đăng xuất tài khoản?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="logout.php" class="btn btn-primary">Đăng xuất</a>
                                        <button type="button" class="btn btn-outline-primary"
                                            data-dismiss="modal">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Container Fluid-->
                    <button data-toggle="modal" data-target="#addSpending" id="#myBtn"
                        class="btn btn-warning btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-coins"></i>
                        </span>
                        <span class="text">Thêm chi tiêu</span>
                    </button>
                    <div class="my-2"></div>
                    <button data-toggle="modal" data-target="#addDebtor" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-users"></i>
                        </span>
                        <span class="text">Thêm đối tượng vay tiền</span>
                    </button>
                    <div class="my-2"></div>
                    <button data-toggle="modal" data-target="#addBalance" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="text">Thêm tiền vào số dư</span>
                    </button>
                </div>
                <div class="modal fade" id="addSpending" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm chi tiêu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="addSpending.php">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền</label>
                                        <input name="amount" type="number" class="form-control"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chi cho việc: </label>
                                        <textarea name="note" class="form-control"
                                            aria-describedby="emailHelp"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Xong</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        data-dismiss="modal">Hủy</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="addBalance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm số dư</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="addBalance.php">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền</label>
                                        <input name="amount" type="number" class="form-control"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ghi chú</label>
                                        <textarea name="note" class="form-control"
                                            aria-describedby="emailHelp"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Xong</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        data-dismiss="modal">Hủy</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="addDebtor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm người vay</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="addDebtor.php">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên</label>
                                        <input name="name" type="text" class="form-control" aria-describedby="emailHelp"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền</label>
                                        <input name="amount" type="number" class="form-control"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Xong</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        data-dismiss="modal">Hủy</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>copyright &copy; <script>
                                document.write(new Date().getFullYear());
                                </script> - developed by
                                <b><a href="https://www.facebook.com/tansang.trannguyen.1" target="_blank">Trần Nguyễn
                                        Tấn Sang</a></b>
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- Footer -->
            </div>
        </div>

        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/ruang-admin.min.js"></script>
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="js/demo/chart-area-demo.js"></script>
</body>

</html>