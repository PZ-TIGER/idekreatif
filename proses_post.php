<?php
//menghubungkan file konfigurasi database
include 'config.php';

//memulai sesi PHP
session_start();

//mendapatkan id pengguna dari sesi
$userId = $_SESSION["user_id"];

//menangani form untuk menambahkan postingan baru
if (isset($_POST['simpan'])) {
    //mendapatkan data dari form
    $posTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $categoryId = $_POST["category_id"];

//megatur direktori penyimpanan file gambar
$imageDir = "assets/img/uploads/";
$imgaeName = $_FILES["image"]["name"];
$imagePath = $imageDir . basename($imageName);

//memindahkan file gambar di unggah ke direktori tujuan
if (move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath)) {
    //jika unggahan berhasil, masukan
    // data postingan ke dalam database
    $query = "INSERT INTO posts (post_title, content,
    created_at, category_id, user_id, image_path) VALUES
    ('$posTitle', '$content', NOW(), '$categoryId', '$userId', '$$imagePath')";

if ($conn->query($query) === TRUE) {
    //notifikasi berhasil jika postingan berhasil di datmbahkan
    $_SESSION['notification'] = [
        'type' => 'primary',
        'massage' => 'Post succcessfully added.'
    ];
}else{
    //notifikasi error jika gagal menambhakan psotingan
    $_SESSION['notification'] = [
        'type' => 'danger',
        'massage' => 'Error adding post: ' .$conn->error
    ];
}
}else{
    //notifikasi erorr jika unggahan gambar gagal
    $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => 'Failed to upload image.'
    ];
}

//arahkan ke halaman dashboard setelah selesai
header('Location: dashboard.php');
exit();
}