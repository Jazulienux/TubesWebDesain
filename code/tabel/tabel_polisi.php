<?php
    include '../../method.php';
    include '../../function.php';
    
    session_start();

    $account = viewAccount("SELECT * FROM polisi");
    // var_dump($account);

     
    if(!isset($_SESSION["login"])){
        echo $_SESSION["login"];
        header('Location:../../index.php');
        exit;
    }
    
    if(isset($_POST["logout"])){
        header('Location:../../logout.php');
        exit;
    }

    if(isset($_POST["addAccount"])){
        header('Location:../formulir/formulir_polisi.php');
        exit;
    }

    // if(isset($_POST["search"])){
    //     $cariData = cariData($_POST["keyword"]);
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TiOn App</title>
    <link rel="shortcut icon" href="img/daftar.jpg">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <style>
        .transparent{
            background:rgba(25,25,112, 1);
            width: 95%;
            height:550px;
            padding:10px;
            margin:0px auto;
            color:white;
            font:normal 100% Verdana,Trebuchet,Arial,Sans-serif;
        }
        .transparent-header{
            background:rgba(255,250,250, 1);
            width: 95%;
            height:65px;
            padding:10px;
            color:white;
            margin:0px auto;
            font:normal 100% Verdana,Trebuchet,Arial,Sans-serif;
        }
        body{
            background-color: #696969;
            /* background-image:url("img/satib.png");
			background-size:cover;
			background-attachment: fixed; */
        }
        pre{
            line-height:2.0em;

        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="../../home.php">TiOn App</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="../../home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if($_SESSION['typeuser']=="Admin") { ?>    
                <li class="nav-item active">
                    <a class="nav-link" href="tabel_login.php">Manage All Account</a>
                </li>        
            <?php } ?>
            <li class="nav-item active">
                <a class="nav-link" href="#">Polisi</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Member</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Denda</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Pelanggaran</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" role="form">
            <font color="white" class="mr-2">
                Selamat Datang,
                <?php if($_SESSION['typeuser']=="Admin") { ?>
                    <?php echo $_SESSION['username']; ?>
                    <button class="btn btn-outline-light my-2 my-sm-0" name ="logout" type="submit"
                    onClick ="return confirm('Apakah anda yakin untuk logout, <?php echo $_SESSION['username']; ?>?')">Logout</button>
                <?php } 
                else if($_SESSION['typeuser']=="Polisi") { ?>
                    <?php echo $_SESSION['namapolisi']; ?>
                    <button class="btn btn-outline-light my-2 my-sm-0" name ="logout" type="submit"
                    onClick ="return confirm('Apakah anda yakin untuk logout, <?php echo $_SESSION['namapolisi']; ?>?')">Logout</button>
                <?php } 

                else if($_SESSION['typeuser']=="Member") { ?>
                    <?php echo $_SESSION['namapengendara']; ?>
                    <button class="btn btn-outline-light my-2 my-sm-0" name ="logout" type="submit"
                    onClick ="return confirm('Apakah anda yakin untuk logout, <?php echo $_SESSION['namapengendara']; ?>?')">Logout</button>
                <?php } ?>
                
            </font>
        </form>
        </div>
    </nav>
    </div>
    <br/>
    <div class="transparent">
        <center><h1><font color="white">Manajemen Akun TiOn App</font></h1></center>
        <hr color="white" size="3px" width="100%">
        
        <form action="" method="POST">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="col-sm-8">
                <form action="" method="POST" role="form">
                    <button type="submit" class="btn btn-primary" name="addAccount">Tambah addAccount
                </form>
            </div>
            <div class="col-sm-3">
               <input class="form-control mr-sm-2" placeholder="Search" name="keyword">
            </div>
                <button type="submit" class="btn btn-primary" name="search">Search</button>
        </nav>
        </form>
        <!-- <?php echo "<font size='3' face='Calibri'>Pencarian data login dengan kata '$cariData' </font>"; ?> -->

        </button>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table table-hover" border="3">
                <thead>
                    <tr>
                        <th  style="background-color: #8FBC8F;">No. </th>
                        <th  style="background-color: #8FBC8F;">Kode Polisi</th>
                        <th  style="background-color: #8FBC8F;">Nama Polisi</th>
                        <th  style="background-color: #8FBC8F;">Tempat Lahir Polisi</th>
                        <th  style="background-color: #8FBC8F;">Tanggal Lahir Polisi</th>
                        <th  style="background-color: #8FBC8F;">Jenis Kelamin Polisi</th>
                        <th  style="background-color: #8FBC8F;">Alamat Polisi</th>
                        <th  style="background-color: #8FBC8F;">Telepon Polisi</th>
                        <th  style="background-color: #8FBC8F;">Gambar Akun Polisi</th>
                        <th  style="background-color: #8FBC8F;">Tools</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                <?php foreach($account as $row):?>
                    <tr>
                        <td class="btn-light"><?=$i;?></td>
                        <td class="btn-light"><?=$row["KODEPOLISI"]; ?></td>
                        <td class="btn-light"><?=$row["NAMAPOLISI"]; ?></td>
                        <td class="btn-light"><?=$row["TEMPATLAHIRPOLISI"]; ?></td>
                        <td class="btn-light"><?=$row["TANGGALLAHIRPOLISI"]; ?></td>
                        <td class="btn-light"><?=$row["JKPOLISI"]; ?></td>
                        <td class="btn-light"><?=$row["ALAMATPOLISI"]; ?></td>
                        <td class="btn-light"><?=$row["TELPPOLISI"]; ?></td>
                        <td class="btn-light"><img src="logo/<?php echo $row["gambarAkunPolisi"]; ?>" alt="" width="100" height="100"></td>
                        <td class="btn-light">
                        <div class="form-group">
                            <div class="row col-sm-7">    
                                    <div class="col">
                                        <a href="../proses/update-delete/aksi_loginUpdatePolisi.php?id=<?php echo $row["id"];?>">
                                        <img src="../../logo/update.png" width="40px"><br>Update</a>
                                    </div>
                                    <div class="col">
                                    <a href="../proses/update-delete/aksi_loginHapusPolisi.php?id=<?php echo $row["id"];?>" onclick="return confirm('Apakah Data Account Ingin Dihapus')">
                                    <img src="../../logo/delete.png" width="40px"><br>Delete</a>
                                    </div>
                            </div>
                        </div>
                        </td>
                    </tr>
                <?php $i++ ?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>