<?php
    include '../../method.php';
    include '../../function.php';

    session_start();

    $tampilkanIsi = ("SELECT m.namapengendara, m.nopol
    FROM member AS m LEFT OUTER JOIN
    login l ON m.nopol = l.nopol
    WHERE l.nopol IS NULL");

    $tampilkanIsi_Sql = mysqli_query($connect,$tampilkanIsi);

    $tampilkanIsiPolisi = ("SELECT p.namapolisi, p.kodepolisi
    FROM polisi AS p LEFT OUTER JOIN
    login l ON p.kodepolisi = l.kodepolisi
    WHERE l.kodepolisi IS NULL");

    $tampilkanIsiPolisi_Sql = mysqli_query($connect,$tampilkanIsiPolisi);

    if(isset($_POST["add"])){
        if(addAccount($_POST) > 0){
            echo "
            <script>
                alert('data berhasil disimpan');
                document.location.href='../tabel/tabel_login.php';
            </script>
            ";
        }
        else{
            echo "
            <script>
                alert('data gagal disimpan');
                document.location.href='formulir_login.php';
                </script>
            ";
            echo "<br>";
            echo mysqli_error($connect);
            
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data</title>
    <link rel="shortcut icon" href="img/daftar.jpg">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <style>
        body{
            background-color:gray;
        }
        table{
            color:gold;
        }
        legend{
            color:black;
        }
        label{
            color:black;
        }
        .transparent{
            background:rgba(255,0,255, 1);
            width: 40%;
            height:820px;
            padding:10px;
            margin:0px auto;
            color:white;
            font:normal 100% Verdana,Trebuchet,Arial,Sans-serif;
        }
        .link-button{
            text-decoration: none;
            background-color: red;
            color: white;
            padding: 9px 9px 9px 9px;
            border: 1.5px solid red;
            border-radius:5px;
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
                    <a class="nav-link" href="../tabel/tabel_login.php">Manage All Account</a>
                </li>        
            <?php } ?>
            <li class="nav-item active">
                <a class="nav-link" href="#">List Of Pelanggaran</a>
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

     <form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-sm-5">
                </div>
            </div>
            <div class="transparent">
                <div class="form-group">
                    <center><img src="img/satib.png" height="150x150"></center>       
                </div>
                <center><b><label for="">Tambah Akun TiOn</b></label></center>
                <br/>
                    
                <div class="form-group">
                    <label for="pilAs" class="col-sm-12 control-label">Member</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="nopol" id="pilAs">
                            <option value="" disabled selected>Pilih Member</option>
                                <?php while($isi = mysqli_fetch_array($tampilkanIsi_Sql)) { ?>
                                    <?php $nopol = $isi['nopol']; ?>
                                    <?php $namapengendara = $isi['namapengendara']; ?>
                                <?php } ?>
                            <option value="<?php echo $nopol ?>"><?php echo $nopol ?> | <?php echo $namapengendara ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pilAs" class="col-sm-12 control-label">Polisi</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kodepolisi" id="pilAs">
                            <option value="" disabled selected>Pilih Polisi</option>
                                <?php while($isi = mysqli_fetch_array($tampilkanIsiPolisi_Sql)) { ?>
                                    <?php $kodepolisi = $isi['kodepolisi']; ?>
                                    <?php $namapolisi = $isi['namapolisi']; ?>
                                <?php } ?>
                            <option value="<?php echo $kodepolisi ?>"><?php echo $kodepolisi ?> | <?php echo $namapolisi ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <b><i><h5><font color="blue">NB : **Pilhlah salah satu**</font></h5></i></b>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row col-sm-12">    
                        <label for="" class="col-sm-12 control-label">Username</label>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Username" name="username" required>
                            </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-sm-12">    
                        <label for="" class="col-sm-12 control-label">Password</label>
                            <div class="col">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row col-sm-12">    
                        <label for="" class="col-sm-12 control-label">Password Konfirmasi</label>
                            <div class="col">
                                <input type="password" class="form-control" placeholder="Password" name="password_konf" required>
                            </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-sm-12">    
                        <label for="" class="col-sm-12 control-label">Nomor Polisi</label>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nomor Polisi" name="nopol">
                            </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-sm-12">    
                        <label for="" class="col-sm-12 control-label">Kode Polisi</label>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Kode Polisi" name="kodepolisi" >
                            </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="pilAs" class="col-sm-4 control-label">Type User</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="typeuser" id="pilAs">
                            <option value="Member">Member</option>
                            <option value="Polisi">Polisi</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>
                              
            <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                    <a href="../tabel/tabel_login.php" class="link-button">Close</a>
                </div>
            </div>
    </form>
    <br/>
    <br/>  
</body>
</html>