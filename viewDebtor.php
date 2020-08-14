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
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <?php
        require "./checkLogin.php";
        require "userModel.php";
        require "./entity/user.php";
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

                    <div class="container-fluid" id="container-wrapper">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Những người chưa trả nợ</h1>
                        </div>

                        <!-- Row -->
                        <div class="row">
                            <!-- Datatables -->
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    </div>
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush" id="dataTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Ngày mượn</th>
                                                    <th>Số tiền</th>
                                                    <th colspan="2"></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Ngày mượn</th>
                                                    <th>Số tiền</th>
                                                    <th colspan="2"></th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                    $result = findAllDebtor();
                                                    if ($result->num_rows>0){
                                                        while($row = $result->fetch_assoc()) {
                                                           echo"
                                                            <tr>
                                                                <td>".$row["fullname"]."</td>
                                                                <td>".findDate($row["date_borrow"])."</td>
                                                                <td>".currency_format($row["amount"])."</td>
                                                                <td>
                                                                    <a href='deleteDebt.php?id=".$row["id"]."&amount=".$row["amount"]."'>
                                                                        <button class='btn btn-success'>Đã nhận tiền</button>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <button onclick=\"addToModal('".$row["id"]."')\" data-toggle='modal' data-target='#exampleModal'
                                                                    id='#myBtn' class='btn btn-info'>Trả một phần</button>
                                                                </td>
                                                            </tr>
                                                           ";
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Row-->

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
                </div>
                <!---Container Fluid-->
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="payDebt.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Trả chỉ một phần</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input name="id" id="modalInput" type="hidden">
                            <label for="exampleInputEmail1">Số tiền trả</label>
                            <input name="amount" type="number" class="form-control"
                                aria-describedby="emailHelp" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Xong</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </form>
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
    <!-- Page level plugins -->
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
        });
        function addToModal(id){
            $("#modalInput").val(id);
        }
    </script>
</body>

</html>