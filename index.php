<?php
    include 'method.php';

    session_start();
    if(isset($_COOKIE["id"]) && isset($_COOKIE["username"])){
        $id = $_COOKIE["id"];
        $key = $_COOKIE["key"];
        
        //ambil username berdasar id
        $result=mysqli_query($connect,"SELECT username FROM login WHERE id=$id");
        $row = mysqli_fetch_assoc($result);

        //cek cookie dan username
        if($key === hash('sha256',$row["username"])){
            $_SESSION["login"]=true;
        }
    }

    //cek cookie
    if(isset($_COOKIE["login"])){
        if($_COOKIE["login"] == 'true'){
            $_SESSION["login"] = true;
        }
    }

    if(isset($_SESSION["login"])){
        header('Location:home.php');
        exit;
    }

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $result = mysqli_query($connect,
        "SELECT l.username,l.kodepolisi,l.nopol,l.typeuser,l.password,p.namapolisi,m.namapengendara 
        FROM login l
        LEFT JOIN polisi p
        ON p.kodepolisi = l.kodepolisi
        LEFT JOIN member m
        ON m.nopol = l.nopol
        where username='$username' AND password='$password'");

        $loginSave =
        "SELECT l.username,l.kodepolisi,l.nopol,l.typeuser,l.password,p.namapolisi,m.namapengendara 
        FROM login l
        LEFT JOIN polisi p
        ON p.kodepolisi = l.kodepolisi
        LEFT JOIN member m
        ON m.nopol = l.nopol
        where username='$username' AND password='$password'";

        $hash = password_hash($username, PASSWORD_DEFAULT);

        $login_query=mysqli_query($connect,$loginSave);
        $data=mysqli_fetch_array($login_query);

        if($data){
            
            $_SESSION['username'] = $data['username'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['typeuser'] = $data['typeuser'];
            $_SESSION['kodepolisi'] = $data['kodepolisi'];
            $_SESSION['nopol'] = $data['nopol'];
            $_SESSION['namapolisi'] = $data['namapolisi'];
            $_SESSION['namapengendara'] = $data['namapengendara'];
         
            if(mysqli_num_rows($result)===1){
                $row = mysqli_fetch_assoc($result);

                if(password_verify($password,$hash)){

                    $_SESSION["login"] = true;

                    if(isset($_POST['remember'])){
                        setcookie('id',$row["id"],time()+60);
                        setcookie('key',hash(sha256,$row["username"]),time()+60);
                    }
                    header('Location:home.php');
                    exit;
                }       
            }
        }
        else{
            echo "
            <script type='text/javascript'>
                alert('Username atau Password anda salah!')
                window.location='index.php';
            </script>";
        }
        $error = true;
    }    
?>
<!doctype html>
<html>
<head>
	<title>Login E-Tilang</title>
    <link href='logo/shortcut.jpeg' rel='SHORTCUT ICON'/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>   

<index> 
<link rel="stylesheet" type="text/css" href="css/styleCSS2.css"/>
<body background="wallpaper/wallpaper.png">
    <center>
    <font size="19px" face="Bebas Neue" color="white">Login To E-Tilang<br></font>
    <br>
    <form action="" method="post" class="expose">
        <fieldset>
            <br>
            <img src="logo/tatib.jpeg" width="250" height="170">
            <br><br>
            <input type="text" size="25px" name="username"  placeholder="Inputkan Username" required><br/><br>
            <input type="password" size="25px" name="password" id="password" placeholder="Inputkan Password" required><br/><br/>
            <input type="submit" class="tombol" name="login" value="" style="background-image:url(logo/tick.png); background-position:center; background-size:8%; background-repeat:no-repeat;">
            <br><br>
        </fieldset>
    </form>
    <br/>
    </center>
</body>
</index>
</html>