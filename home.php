<?
    include 'method.php';

    session_start();
    
    if(!isset($_SESSION["login"])){
        echo $_SESSION["login"];
        header('Location:index.php');
        exit;
    }
    
    if(isset($_POST["logout"])){
        header('Location:logout.php');
        exit;
    }
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
            background:rgba(255,250,250, 1);
            width: 95%;
            height:455px;
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
        <a class="navbar-brand" href="home.php">TiOn App</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if($_SESSION['typeuser']=="Admin") { ?>    
                <li class="nav-item active">
                    <a class="nav-link" href="code/tabel/tabel_login.php">Manage All Account</a>
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
    <div class="transparent-header">
         <pre><center><h1>Tilang Online App</h1></center></pre>
    </div>
    <br/>
    <div class="transparent">
    <pre>Sistem TiON App adalah suatu sistem yang dibuat untuk memdahkan Member dan Aparat Kepolisian dalam menangani kasus pelanggaran lalu lintas,</pre>
    <pre>Tata cara dari TiOn App sendiri antara lain :
    1. Kini ketika petugas menjumpai pelanggar, petugas hanya mencatat indentitas, jenis pelanggaran dan besaran denda.
    2. Kemudian Diinputkan ke Sisi Website TiOn App
    3. Jika si pelanggar tidak memiliki HP, maka akan diberikan lembar tilang warna biru
       dengan maksud pelanggar mengetahui dan menerima denda pelanggaran yang sudah dilanggar sesuai putusan sidang yang langsung 
       ditindaklanjuti oleh kejaksaan.
    4. Member yang mempunyai HP bisa mendownload bukti pelanggaran dengan login menggunakan No Polisi 
       yang sudah terdaftar
    5. Dengan Aplikasi Tilang Online, data pelanggar terkoneksi dengan Kejaksaan dan Pengadilan untuk menyidangkan / menjatuhkan 
       putusan denda (amar putusan)
    6. Keuntungan dalam penggunaan aplikasi Tilang Online, bisa diketahui secara transfaran, akurat dan cepat oleh pihak-pihak terkait seperti Polri, 
       Kejaksaan, Mahkamah Agung/Pengadilan di setiap tingkatan mulai dari Kabupaten/Kota, Provinsi hingga pusat seperti rekapitulasi data penindakan 
       tilang dapat diakses melalui Aplikasi Tilang Online, serta detail data penindakan tilang dapat di akses 
       melalui website yang terhubung dengan jaringan internet.
    </div>
</body>
</html>