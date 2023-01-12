<?php
    require 'funcation.php';
    require 'cek.php';  

    //mendapatkan ID barang
    $idbarang =$_GET['id'];
    
    $get = mysqli_query($conn, "select *from barang where idbarang='$idbarang'");
    $fetch  = mysqli_fetch_assoc($get);
    $namabarang = $fetch['namabarang'];
    $deskripsi =$fetch ['deskripsi'];
    $harga =$fetch ['harga'];
    $stok =$fetch ['stok'];
    //$image = $fetch ['gambar'];


    //cek gambar ada atau tidak
    $gambar = $fetch['gambar']; //ambil gambar
    if($gambar==null){
        //jika tidak ada gambar
        $img = 'No Photo';
    } else {
        //jika ada gambar
        $img ='<img src="images/'.$gambar.'" class="zoomable">';
    }      

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px;
            }
            .zoomable:hover{
                transform: scale(2.5);
                transition: 0.35 ease;
            }
            a{
                text-decoration: none;
                color: black;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stok Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Stock Barang</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h2><?=$namabarang;?></h2>
                                <?=$img;?>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">Deskripsi</div>
                                    <div class="col-md-9">: <?=$deskripsi;?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Harga</div>
                                    <div class="col-md-9">: <?=$harga;?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Stok</div>
                                    <div class="col-md-9">: <?=$stok;?></div>
                                </div>
                                <br><br><br><br>
                                <h3>Barang Masuk</h3>
                                <!-- table -->
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                           
                                            <th>Id Barang</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Harga</th>
                                            <th>Stock</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        
                                            $ambildatamasuk = mysqli_query($conn, "SELECT * FROM masuk where idbarang='$idbarang'");
                                            while($fetch=mysqli_fetch_array($ambildatamasuk))
                                            {
                                               
                                                $tanggal = $fetch ['tanggal'];
                                                $keterangan = $fetch  ['keterangan'];
                                                $harga = $fetch  ['harga'];
                                                $quantity =  $fetch ['qty'];                            
                                        ?>
                                            <tr>
                                                <td><?=$idbarang;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$harga;?></td>
                                                <td><?=$quantity;?></td>
                                            </tr>
                                        <?php 
                                            };
                                        ?>
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control mb-3" require>
                    <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control mb-3" require>
                    <input type="number" name="stok" placeholder="Stok" class="form-control mb-3" require>
                    <input type="file" name="file"  class="form-control mb-1" require>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" name="addnewbarang">Simpan</button>      
                </div>
            </form>
            </div>
        </div>
    </div>
</html>
