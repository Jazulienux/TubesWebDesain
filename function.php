<?php

    include 'method.php';

    function viewAccount($query_kedua){
        global $connect;
    
        $result = mysqli_query($connect,$query_kedua);
    
        $rows= [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function cariData($keyword){
        $sql = "SELECT * FROM login
        WHERE 
        username LIKE '%$keyword%' OR
        password LIKE '%$keyword%' OR
        typeuser LIKE '%$keyword%' OR
        nopol LIKE '%$keyword%' OR
        kodepolisi LIKE '%$keyword%'";
        return query($sql);
    }

    function hapusAccount($id){
        global $connect;
        mysqli_query($connect,"DELETE FROM login WHERE id=$id");
        return mysqli_affected_rows($connect);
    }

    function hapusAccountPolisi($kopol){
        global $connect;
        mysqli_query($connect,"DELETE FROM polisi WHERE id='$kopol'");
        return mysqli_affected_rows($connect);
    }

    function editAccount($data){
        global $connect;
        
        $id = $data["id"];
        
        $username = strtolower(stripcslashes($data['username']));

        $password = mysqli_real_escape_string($connect,$data['password']);
        $password_konf = mysqli_real_escape_string($connect,$data['password_konf']);
    
        $kopol = htmlspecialchars($data["kodepolisi"]);
        $nopol = htmlspecialchars($data["nopol"]);
        $typeuser = htmlspecialchars($data["typeuser"]);
    
        //cek konf password
        if($password !== $password_konf){
            echo "
                <script>
                    alert('Password anda tidak sama');
                </script>
            ";
            return false;
        } else {
            $query = "UPDATE login SET
            username = '$username',
            password = '$password',
            kodepolisi = '$kopol',
            nopol = '$nopol',
            typeuser = '$typeuser'
            WHERE id = $id";
            mysqli_query($connect,$query);
        }
        return mysqli_affected_rows($connect);
    }
    

    function addAccount($data){
        global $connect;
        
        $username = strtolower(stripcslashes($data['username']));

        $password = mysqli_real_escape_string($connect,$data['password']);
        $password_konf = mysqli_real_escape_string($connect,$data['password_konf']);
    
        $kopol = htmlspecialchars($data["kodepolisi"]);
        $nopol = htmlspecialchars($data["nopol"]);
        $typeuser = htmlspecialchars($data["typeuser"]);

        $result = mysqli_query($connect,"SELECT username FROM login WHERE  username='$username'");

        if(mysqli_fetch_assoc($result)){
            echo "
                <script>
                    alert('Username Sudah Ada');
                </script>
            ";
            return false;
        }
    
        //cek konf password
        if($password !== $password_konf){
            echo "
                <script>
                    alert('Password anda tidak sama');
                </script>
            ";
            return false;
        } else {
            $query = "INSERT login VALUES
            ('','$username','$password','$typeuser','$kopol','$nopol')";
            mysqli_query($connect,$query);
        }
        return mysqli_affected_rows($connect);
    }

    function addAccountPolisi($data){
        global $connect;
        
        $kodepolisi = strtolower(stripcslashes($data['kodepolisi']));
    
        $namapolisi = htmlspecialchars($data["namapolisi"]);
        $tempatlahirpolisi = htmlspecialchars($data["tempatlahirpolisi"]);
        $tanggallahirpolisi = htmlspecialchars($data["tanggallahirpolisi"]);
        $jkpolisi = htmlspecialchars($data["jkpolisi"]);
        $alamatpolisi = htmlspecialchars($data["alamatpolisi"]);
        $telppolisi = htmlspecialchars($data["telppolisi"]);
        $gambarAkunPolisi = upload();

        if(!$gambarAkunPolisi){
            return false;
        }

        $result = mysqli_query($connect,"SELECT KODEPOLISI FROM polisi WHERE  KODEPOLISI='$kodepolisi'");

        if(mysqli_fetch_assoc($result)){
            echo "
                <script>
                    alert('Kode Polisi Sudah Ada');
                </script>
            ";
            return false;
        }

        $query = "INSERT polisi VALUES
        ('$kodepolisi', '$namapolisi', '$tempatlahirpolisi', '$tanggallahirpolisi', '$jkpolisi', 
        '$alamatpolisi', '$telppolisi', '$gambarAkunPolisi','')";
        mysqli_query($connect,$query);
       
        return mysqli_affected_rows($connect);
    }

    function upload()
    {
        $nama_file      =$_FILES["gambarAkunPolisi"]["name"];
        $ukuran_file    =$_FILES["gambarAkunPolisi"]["size"];
        $error          =$_FILES["gambarAkunPolisi"]["error"];
        $tmpfile        =$_FILES["gambarAkunPolisi"]["tmp_name"];
        if($error===4)
        {
            echo"
            <script>
                alert('Tidak ada gambar yang diupload!!');
            </script>
            ";
            return false;
        }
        $jenis_gambar=['jpg','jpeg','gif','png'];
        $pecah_gambar=explode('.',$nama_file);
        $pecah_gambar=strtolower(end($pecah_gambar));
        if(!in_array($pecah_gambar,$jenis_gambar))
        {
            echo "
            <script>
                alert('Yang anda upload bukan file gambar');
            </script>
            ";
            return false;
        }
        if($ukuran_file > 10000000)
        {
            echo"
            <script>
                alert('Ukuran file gambar terlalu besar');
            </script>
            ";
            return false;
        }
        $namafilebaru=uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $pecah_gambar;
        // var_dump($namafilebaru);die();
        move_uploaded_file($tmpfile,'img/'.$namafilebaru);
        return $namafilebaru;
    }
?>