<?php
    require 'funcation.php';

    //cek login terdaftar apa tidak 
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        //cocokan database
        $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");
        //hitung jumlah data
        $hitung =mysqli_num_rows($cekdatabase);

        if($hitung>0){
            $_SESSION['log'] ='True';
            header('location:index.php');
        } else {
            header('location:login.php');
        };
    };

    if(!isset($_SESSION['log'])){

    }else {
        header('location:index.php');
    };
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet"/>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            *{
                text-decoration: none;
                font-family: "Raleway", sans-serif,;
                font-size: 11pt;
            }
            
            body.Card{
                background: -webkit-linear-gradient(bottom,#3498db,#9b59b6);
                background-repeat: no-repeat;
            }
            form{
                padding-top: 13px;

            }
            button{
                background:-webkit-linear-gradient(bottom,#3498db,#9b59b6) ;
                border-radius: 50px;
                border: none;
                box-shadow: 0px 1px 8px #ffffff;
                cursor: pointer;
                color: white;
                font-family: "Raleway SemiBold", sans-serif;
                height: 42.3px;
                margin: auto;
                margin-top: 40px;
                transition: 0.25s;
                width: 153px;
            }
            button .btn:hover{
                box-shadow: 0px 1px 18px #ffffff;
            }
            
        </style>
    </head>
    <body class="Card">
      <div id="layoutAuthentication">
          <div id="layoutAuthentication_content">
               <main>
                  <div class="container">
                     <div class="row justify-content-center">
                          <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
