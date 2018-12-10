<?php
    include '../../../method.php';
    include '../../../function.php';
   
    $kopol = $_GET["id"];

    if(hapusAccountPolisi($kopol) > 0){
        echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href='../../tabel/tabel_polisi.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('data gagal dihapus');
            document.location.href='../../tabel/tabel_polisi.php';
        </script>
        ";
        echo "<br>";
        echo mysqli_error($connect);
    }
?>