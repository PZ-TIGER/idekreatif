<?php
//menyertakan header halaman
include '.includes/header.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <!--judul halaman-->
    <div class="row">
    <!--From untuk menambahkan psotingan baru-->
    <div class="col-md-10">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="proses_post.php"
                enctype="multipart/form-data">
            <!--input untuk judul postingan-->
            <div class="mb-3">
                <label for="post_title" class="form-label">Judul psotingan</label>
                <input type="text" class="form-control"name="post_title" required>
            </div>
            <!-- Input untuk mengungah gambar -->
             <div class="mb-3">
                <label for="formFile" class="form-label">Unggah Gambar</label>
                <input class="form-control" type="file" name="image" accept="image/*" />
             </div>
             <!-- Dropdown untuk memilih kategori -->
              <div class="mb-3">
                <label for="category_id" class="form-label">kategori</label>
                <select class="form-select" name="category_id" required>
                    <!-- mengambil data kategori dari databse untuk mengisi opsi dropdown -->
                     <option value="" select disabled>Pilih salah satu</option>
                     <?php
                     $query = "SELECT * FROM categories"; // Query untuk mengambil data kategori
                     $result = $conn->query($query); //menjalankan query
                     if ($result->num_rows > 0) { //jika terdapat data kategori
                        while ($row = $result->fetch_assoc()) { // Iterasi setiap kategori
                            echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
                            }
                        }
                        ?>
                </select>
              </div>
              <!-- Textarea untuk konten postingan -->
               <div class="mb-3">
                <label for="content" class="form-label">konten</label>
                <textarea class="form-control" id="content" name="content" required></textarea>
               </div>
               <!-- tombol submit -->
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>
<?php
//menyertakan footer halaman
include ' .include/footer.php' ;
?>