<?php 
session_start();
//membuat koneksi ke database
$conn = mysqli_connect("localhost","root", "" , "kios");
 
//Menambah Barang Baru 
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $harga - $_POST['harga'];
    $stok = $_POST['stok'];
    $image = $_POST['image'];

    
    //untuk upload gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; //mengambil nama gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //mengambil ekstensinya
    $ukuran = $_FILES['file']['size'];//mengambil size filenya
    $file_tmp = $_FILES['file']['tmp_name'];//mengambil lokasi filenya

    //penamaan file -> enkripsi
    $image = md5(uniqid($nama, true). time()). '.'.$ekstensi; // mengubah nama file yang dienskripsi

    //validasi barang sudah ada atau belum 
    $cek = mysqli_query($conn, "select * from barang where namabarang='$namabarang'");
    $hitung = mysqli_num_rows($cek);

    if($hitung<1){
        //jika data belum ada atau terdaftar

 
        //untuk upload gambar
        $allowed_extension = array('png', 'jpg');
        $nama = $_FILES['file']['name'];    // mengambil nama gambar
        $dot = explode('.', $nama);
        $ekstensi = strtolower(end($dot));  // mengambil extensinya
        $ukuran = $_FILES['file']['size']; // mengambil size filenya
        $file_tmp = $_FILES['file']['tmp_name']; // mengambil lokasi filenya

        // penamaan file - > enkripsi
        $image = md5(uniqid($nama, true) . time()). '.'.$ekstensi; // mengubah nama file yang dienskripsi

        // validasi barang sudah ada atau belum
        $cek = mysqli_query($conn, "select * from barang where namabarang='$namabarang'");
        $hitung = mysqli_num_rows($cek);

        if($hitung<1){
//jika data beluam ada atau terdaftar

//proses upload ggambar
if(in_array($ekstensi, $allowed_extension) === true){
//validasi ukuran file
if($ukuran < 15000000){
    move_uploaded_file($file_tmp, 'images/'.$image);

    $addtotable = mysqli_query($conn, "INSERT iNTO 'barang' ('namabarang', 'deskripsi', 'harga', 'stok', 'gambar')
    VALUES ('$namabarang','$deskripsi','$harga','$stok','$image')");
    if($addtotable){
        echo '<script type="text/javascript">alert("Berhasil")</script>';
    } else {
        echo '<script type="text/javascript">alert("Gagal")</script>';
            }

                } else {
                            //kalau file lebih dari 15 m
                            echo '<script>
                            alert("Ukuran file tidak boleh lebih dari 15MB");
                            window.location.href="index.php"
                            </script>';

                        }
    } else {
                // kalau file bukan png / jpg
                echo '<script>
                    alert("File harus png / jpg");
                    window.location.href="index.php"
                    </script>';
            }
} else {
            // Jika data sudah ada atau telah terdaftar sebelunya
            echo '<script>
            alert("Nama barang sudah terdaftar");
            window.location.href="index.php"
            </script>';
        }
        $addtotable = mysqli_query($conn, "insert into barang (namabarang, deskripsi, harga, stok, gambar) values('$namabarang','$deskripsi','$harga','$stok','$image')");

        if($addtotable){
            header('location:index.php'); 
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
}
}
//barang masuk
if(isset($_POST['barangmasuk'])){
    $idbarang= $_POST['idbarang'];
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from barang where idbarang='$idbarang'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahstoksekarangdenganquantity = $stoksekarang+$qty;
    
    $addtomasuk= mysqli_query($conn,"insert into masuk (idbarang, keterangan, harga, qty) values ('$idbarang','$keterangan','$harga','$qty')");
    $updatestok = mysqli_query($conn, "update barang set stok='$tambahstoksekarangdenganquantity' where idbarang='$idbarang'");

    if($addtomasuk&&$updatestok) {
        echo '<script type="text/javascript">alert("berhasil");</script>';
    } else {
        echo '<script type="text/javascript">alert("Gagal");</script>';
    }   
}

//barang keluar
if(isset($_POST['barangkeluar'])){
    $idbarang= $_POST['idbarang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from barang where idbarang='$idbarang'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);


    $stoksekarang = $ambildatanya['stok'];
    if($stoksekarang >= $qty){
        //jika barangnya cukup
        $kurangstoksekarangdenganquantity = $stoksekarang-$qty;
    
    $addtokeluar= mysqli_query($conn,"INSERT INTO keluar(idbarang, penerima, qty) 
    values ('$idbarang','$penerima','$qty')");
    $updatestok = mysqli_query($conn, "update barang set stok='$kurangstoksekarangdenganquantity' where idbarang='$idbarang'");

    if($addtokeluar&&$updatestok) {
        echo '<script type="text/javascript">alert("berhasil");</script>';
    } else {
        echo '<script type="text/javascript">alert("Gagal");</script>';
    }  
} else {
    //jika stok barang tidak mencukupi
    echo '
    <script>
    alert ("Stok saat ini tidak mencukupi");
    window.location.href="keluar.php";
    </script>';
}
}

//update barang
if(isset($_POST['updatebarang']))
{
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    $update = mysqli_query($conn, "update barang set namabarang='$namabarang', deskripsi='$deskripsi', harga='$harga' where idbarang='$idb'");
    if($update)
    {
        header('location:index.php');
    }
    else
    {
        echo'Gagal';
        header('location:index.php');
    }
}

//hapus barang 
if(isset($_POST["hapusbarang"]))
{
    $idb = $_POST['idb'];
    $qty = $_POST['qyt'];
    $idm = $_POST['idm'];

    $gambar = mysqli_query($conn, "select * from barang where idbarang='$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/'.$get['image'];
    unlink($img);

    // $getdatabarang = mysqli_query($conn, "select * from barang where idbarang='$idb'");
    // $data = mysqli_fetch_array($getdatabarang);
    // $barang = $data['barang'];

    // $update = mysqli_query($conn, "update stock set namabarang='$selisih', where idbarang='$idb'");
    // $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    // 
    $hapus=mysqli_query($conn,"delete from barang where  idbarang='$idb'");
    if($hapus)
    {
        header('location:index.php');
    }
    else
    {
        echo'Gagal';
        header('location:index.php');
    }
}

//hapus barang masuk
if(isset($_POST["hapusbarangmasuk"]))
{
    $idb = $_POST['idb'];
    $qty = $_POST['qty'];
    $idm = $_POST['idm'];

    $getdatabarang = mysqli_query($conn, "select * from barang where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatabarang);
    $barang = $data['barang'];

    $selisih = $barang-$qty;

    $update = mysqli_query($conn, "update barang set namabarang='$selisih', where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata)
    {
        header('location:masuk.php');
    }
    else
    {
        echo'Gagal';
        header('location:masuk.php');
    }
}

//hapus barang keluar
if(isset($_POST["hapusbarangkeluar"]))
{
    $idb = $_POST['idb'];
    $qty = $_POST['qty'];
    $idk = $_POST['idk'];

    $getdatabarang = mysqli_query($conn, "select * from barang where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatabarang);
    $barang = $data['barang'];

    $update = mysqli_query($conn, "update barang set namabarang='$selisih', where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata)
    {
        header('location:keluar.php');
    }
    else
    {
        echo'Gagal';
        header('location:keluar.php');
    }
}
?>