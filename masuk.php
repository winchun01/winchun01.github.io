<?php
    require 'funcation.php';
    require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AKJT NTT</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Barang masuk</a>
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
                        <h1 class="mt-4">Barang Masuk</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Tanggal </th>
                                            <th>Keterangan</th>
                                            <th>Harga</th>
                                            <th>Quantity</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $ambilsemuadatabarang = mysqli_query($conn, "select * from masuk m, barang b where b.idbarang= m.idbarang");
                                            $i = 1; 
                                            while($data=mysqli_fetch_array($ambilsemuadatabarang)){
                                               
                                                $idb = $data ['idbarang'];
                                                $idm = $data['idmasuk'];
                                                $namabarang = $data ['namabarang'];
                                                $tanggal = $data ['tanggal'];
                                                $keterangan = $data ['keterangan'];  
                                                $harga = $data ['harga'];
                                                $qty = $data['qty'];                                         
                                        ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$harga;?></td>
                                                <td><?=$qty;?></td>
                                                <!-- <td>
                                                    <a href="" class="btn btn-primary">Edit</a>
                                                    <a href="" class="btn btn-danger">Hapus</a>
                                                </td> -->
                                                <td>
                                                <button type="button" class="btn btn-info" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?=$idb;?>">Hapus</button>      
                                                </td>
                        
                                            </tr>
                                            <!-- hapus modal -->
                                            <div class="modal fade" id="hapus<?=$idb;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <button type="button" class="btn-close" disabled aria-label="Close"></button>
                                                            <h5 class="modal-title" id="hapus">Hapus Barang</h5>
                                                        </div>
                                                        <form method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus <?=$namabarang;?>?
                                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                                            <input type="hidden" name="qty" value="<?=$qty;?>">
                                                            <input type="hidden" name="idm" value="<?=$idm;?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info" name="hapusbarangmasuk">Hapus</button>      
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
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
                        <select name="idbarang" class="form form-control mb-3">
                            <option selected>pilih barang</option>
                            <?php
                                $ambilsemuadatanya = mysqli_query($conn, "SELECT * FROM barang");
                                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                    $namabarangnya = $fetcharray['namabarang'];
                                    $idbarangnya  = $fetcharray['idbarang'];
                                    $harga  = $fetcharray['harga'];
                            ?>
                            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>
                            <?php
                                };
                            ?>
                        </select>
                        <input type="text" name="keterangan" placeholder="Keterangan" class="form-control mb-3" require>
                        <input type="text" name="harga" placeholder="Harga" class="form-control mb-3" require>
                        <input type="text" name="qty" placeholder="Quantity" class="form-control mb-3" require>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" name="barangmasuk">Simpan</button>      
                    </div>
                </form>
            </div>
        </div>
    </div>

</html>
