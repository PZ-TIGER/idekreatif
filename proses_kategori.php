<?php


include("config.php");


session_start();


if (isset($_POST['simpan'])) {

    $category_name = $_POST['category_name'];


    $query = "INSERT INTO categories (category_name) VALUES('$category_name')";
    $exec = mysqli_query($conn, $query);


    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'kategori berhasil di tambahkan!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal menambahkan kategori; ' .myqsli_error($conn)
        ];
    }

    //redirect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();
}

//proses penghapusan kategori
if (isset($_POST['delete'])) {

    $catID = $_POST['catID'];


    $exec = mysqli_query($conn, "DELETE FROM categories WHERE category_id='$catID'");
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'kategori berhasil dihapus!'
        ];
 }$exec{
        $_SESSION['notification'] = [
        'type' => 'danger',
       'message' => 'Gagal menghapus kategori: ' .mysqli_error($conn)
     ];
}

//Redirect kembali ke halaman kategori
header('Location: kategori.php');
exit();
}