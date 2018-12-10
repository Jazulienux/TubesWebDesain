<?php
    include '../../../method.php';
    include '../../../function.php';
    
    $id=$_GET["id"];
    
    if(hapusAccount($id) > 0){
        echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href='../../tabel/tabel_login.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('data gagal dihapus');
            document.location.href='../../tabel/tabel_login.php';
        </script>
        ";
        echo "<br>";
        echo mysqli_error($connect);
    }
?>