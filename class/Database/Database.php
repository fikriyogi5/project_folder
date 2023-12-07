<?php
// include 'error_handling.php';
// include "functions.php";

// Membuat objek database
$config = array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'desaku',
);

class Database
{
    private $host;
        private $username;
        private $password;
        private $database;
        private $conn;

        public function __construct($config)
        {
            $this->host = $config['host'];
            $this->username = $config['username'];
            $this->password = $config['password'];
            $this->database = $config['database'];

            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

    public function create($table, $data)
       {
           // Menghasilkan kunci dan tanda tanya untuk prepared statement
           $keys = implode(', ', array_keys($data));
           $values = implode(', ', array_fill(0, count($data), '?'));

           // Query untuk melakukan INSERT
           $query = "INSERT INTO $table ($keys) VALUES ($values)";

           try {
               $stmt = $this->conn->prepare($query);

               // Binding parameter ke prepared statement
               $i = 1;
               foreach ($data as $value) {
                   $stmt->bindParam($i, $value, PDO::PARAM_STR);
                   $i++;
               }

               $stmt->execute();
               return true;
           } catch (PDOException $e) {
               // Alihkan penanganan kesalahan dengan melempar pengecualian
               throw new Exception("Error: " . $e->getMessage());
           }
           
        // Data yang akan dimasukkan
        // $data = array(
        //     'nama' => 'John Doe',
        //     'umur' => 30,
        //     'alamat' => 'Jalan Contoh No. 123',
        //     'email' => 'johndoe@example.com'
        // );

        // // Nama tabel database
        // $tableName = 'nama_tabel';

        // // Memanggil fungsi create
        // if ($databaseManager->create($tableName, $data)) {
        //     echo "Data berhasil dimasukkan ke dalam tabel.";
        // } else {
        //     echo "Terjadi kesalahan saat memasukkan data.";
        // }
    }
    public function insertUniqueData($table, $data, $uniqueColumns)
        {
            // Buat klausa WHERE berdasarkan kolom yang unik
            $whereClause = '';
            foreach ($uniqueColumns as $column) {
                $whereClause .= "$column = :$column AND ";
            }
            $whereClause = rtrim($whereClause, 'AND ');

            // Cek apakah data sudah ada dalam database
            $query = "SELECT * FROM $table WHERE $whereClause";
            $stmt = $this->conn->prepare($query);

            foreach ($uniqueColumns as $column) {
                $stmt->bindParam(":$column", $data[$column], PDO::PARAM_STR);
            }

            $stmt->execute();
            $existingData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Jika data sudah ada, kembalikan false
            if ($existingData) {
                return false;
            }

            // Jika data belum ada, simpan data ke dalam database
            $keys = implode(', ', array_keys($data));
            $values = implode(', ', array_fill(0, count($data), '?'));

            $insertQuery = "INSERT INTO $table ($keys) VALUES ($values)";
            $insertStmt = $this->conn->prepare($insertQuery);

            // Binding parameter ke prepared statement
            $i = 1;
            foreach ($data as $value) {
                $insertStmt->bindParam($i, $value, PDO::PARAM_STR);
                $i++;
            }

            $insertStmt->execute();
            return true;

            // // Membuat objek database dengan konfigurasi
            // $dbConfig = array(
            //     'host' => 'localhost',
            //     'username' => 'root',
            //     'password' => '',
            //     'database' => 'nama_database',
            // );

            // $database = new Database($dbConfig);

            // // Data yang ingin dimasukkan ke dalam tabel
            // $newData = array(
            //     'kolom1' => 'nilai1',
            //     'kolom2' => 'nilai2',
            //     // ...
            // );

            // // Kolom-kolom yang dianggap unik
            // $uniqueColumns = array('kolom1', 'kolom2');

            // // Memanggil fungsi untuk menyimpan data tanpa duplikasi
            // $result = $database->insertUniqueData('nama_tabel', $newData, $uniqueColumns);

            // if ($result) {
            //     echo "Data berhasil disimpan.";
            // } else {
            //     echo "Data sudah ada dalam database, tidak disimpan.";
            // }




        }

    public function update($table, $data, $condition)
    {
        $setClause = implode('=?, ', array_keys($data)) . '=?';

        $query = "UPDATE $table SET $setClause WHERE $condition";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute(array_values($data));
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        // Membuat objek yang memiliki metode update
        // $databaseManager = new DatabaseManager();

        // // Data yang akan diperbarui
        // $dataToUpdate = array(
        //     'nama' => 'John Doe',
        //     'umur' => 35,
        //     'alamat' => 'Jalan Contoh No. 456',
        //     'email' => 'johndoe@example.com'
        // );

        // // Nama tabel database
        // $tableName = 'nama_tabel';

        // // Kondisi untuk pembaruan (misalnya, berdasarkan ID)
        // $condition = 'id = 1';

        // // Memanggil fungsi update
        // if ($databaseManager->update($tableName, $dataToUpdate, $condition)) {
        //     echo "Data berhasil diperbarui dalam tabel.";
        // } else {
        //     echo "Terjadi kesalahan saat memperbarui data.";
        // }
    }
    public function query($query) {
        return $this->conn->query($query);
    }
    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function uploadFile($fileInputName, $targetDirectory, $allowedExtensions, $maxFileSize, $table, $data, $db)
    {
        if (isset($_FILES[$fileInputName]) && !empty($_FILES[$fileInputName]['name'])) {
            // Check if there was a file uploaded
            $targetFile = $targetDirectory . basename($_FILES[$fileInputName]['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $uploadOk = true;

            // Check if the file extension is allowed
            if (!in_array($imageFileType, $allowedExtensions)) {
                return 'Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.';
            }

            // Check if the file size is within the limit
            if ($_FILES[$fileInputName]['size'] > $maxFileSize) {
                return 'Ukuran gambar terlalu besar. Maksimal 500 KB.';
            }

            // Attempt to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFile)) {
                // Data berkas yang diunggah
                $uploadedFileName = basename($_FILES[$fileInputName]['name']);
                $uploadedFilePath = $targetDirectory . $uploadedFileName;

                // Construct the SQL query
                $columns = implode(", ", array_keys($data));
                $values = ":" . implode(", :", array_keys($data));
                $query = "INSERT INTO $table ($columns) VALUES ($values)";

                $stmt = $db->prepare($query);

                // Bind the parameters
                foreach ($data as $key => $value) {
                    $stmt->bindParam(':' . $key, $value, PDO::PARAM_STR);
                }

                $stmt->bindParam(':file_name', $uploadedFileName, PDO::PARAM_STR);
                $stmt->bindParam(':file_path', $uploadedFilePath, PDO::PARAM_STR);

                // Execute the query
                if ($stmt->execute()) {
                    return $uploadedFileName;
                } else {
                    return 'Gagal memasukkan data ke dalam database.';
                }
            } else {
                return 'Terjadi kesalahan saat mengunggah berkas.';
            }
        } 

        // Return null if no file was uploaded
        return null;

        // Mengatur parameter yang dibutuhkan untuk pengunggahan file
        // $fileInputName = "fileToUpload";
        // $targetDirectory = "uploads/";
        // $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        // $maxFileSize = 500000;
        // $data = array(
        //     'user_id' => 123,
        //     'keterangan' => 'Deskripsi berkas'
        // );

        // $result = $userManager->uploadFile($fileInputName, $targetDirectory, array("jpg", "jpeg", "png", "gif"), 500000, "nama_tabel", $data, $db);

        // if (is_string($result)) {
        //     echo "Berkas berhasil diunggah: " . $result;
        // } else {
        //     echo "Terjadi kesalahan: " . $result;
        // }

    }

    public function createAndUploadFile($fileInputName, $targetDirectory, $allowedExtensions, $maxFileSize, $table, $data, $db) {
        // Menggunakan fungsi uploadFile untuk mengunggah berkas
        $uploadedFileName = $this->uploadFile($fileInputName, $targetDirectory, $allowedExtensions, $maxFileSize, $table, $data, $db);

        if ($uploadedFileName) {
            // Berhasil mengunggah berkas, tambahkan nama berkas ke dalam data yang akan dimasukkan
            $data['file_name'] = $uploadedFileName;

            // Menggunakan fungsi create untuk memasukkan data ke dalam database
            if ($this->create($table, $data, $db)) {
                return true;
            } else {
                return 'Gagal memasukkan data ke dalam database.';
            }
        } else {
            return 'Terjadi kesalahan saat mengunggah berkas.';
        }

        // Membuat objek yang memiliki metode createAndUploadFile
        // $databaseManager = new DatabaseManager();

        // // Data yang akan dimasukkan ke dalam database
        // $data = array(
        //     'nama' => 'John Doe',
        //     'umur' => 30,
        //     'alamat' => 'Jalan Contoh No. 123',
        //     'email' => 'johndoe@example.com'
        // );

        // // Nama tabel database
        // $tableName = 'nama_tabel';

        // // Parameter untuk mengunggah berkas
        // $fileInputName = 'fileToUpload';
        // $targetDirectory = 'uploads/';
        // $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        // $maxFileSize = 500000;

        // // Koneksi database (PDO)
        // $db = new PDO("mysql:host=localhost;dbname=mydb", "username", "password");

        // // Memanggil fungsi createAndUploadFile
        // $result = $databaseManager->createAndUploadFile($fileInputName, $targetDirectory, $allowedExtensions, $maxFileSize, $tableName, $data, $db);

        // if ($result === true) {
        //     echo "Data berhasil dimasukkan ke dalam database dan berkas berhasil diunggah.";
        // } else {
        //     echo "Terjadi kesalahan: " . $result;
        // }

    }



        


    public function login($table, $condition, $password)
    {
        // Mengecek apakah data yang sesuai dengan kondisi ditemukan di database
        $query = "SELECT * FROM $table WHERE $condition";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Data yang sesuai dengan kondisi tidak ditemukan
            return false;
        }

        // Memeriksa apakah password cocok
        if (password_verify($password, $user['password'])) {
            // Password cocok, login berhasil
            return $user;
        } else {
            // Password tidak cocok
            return false;
        }

        // Memanggil fungsi login dengan parameter yang sesuai
        // $table = "nama_tabel"; // Nama tabel dalam database
        // $condition = "nik='123456'"; // Kondisi SQL (dalam hal ini, nik='123456')
        // $password = "password_pengguna"; // Password yang akan diverifikasi

        // // Memanggil fungsi login
        // $result = $userManager->login($table, $condition, $password);

        // // Mengelola hasil login
        // if ($result) {
        //     // Login berhasil, $result berisi data pengguna yang sesuai
        //     echo "Selamat datang, " . $result['username'];
        // } else {
        //     // Login gagal
        //     echo "Login gagal. Periksa kembali nik dan password Anda.";
        // }
    }

    public function read($table, $condition = '', $limit = null, $useFetchAll = true)
    {
        $query = "SELECT * FROM $table";
        if ($condition != '') {
            $query .= " WHERE $condition";
        }
        if ($limit !== null) {
            $query .= " LIMIT $limit";
        }

        try {
            $stmt = $this->conn->query($query);
            if ($useFetchAll) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        // Menggunakan fetchAll()
        // $dataArray = $database->read('pemilihan', "nik=" . $_SESSION['user_id'], null, true);

        // // Menggunakan fetch()
        // $dataRow = $database->read('pemilihan', "nik=" . $_SESSION['user_id'], null, false);

    }

    public function readDataFromFiveTables($wargaTable, $pekerjaanTable, $pemiluTable, $donasiTable, $bantuanTable, $condition = '', $limit = null)
    {
        $query = "SELECT w.nama, w.usia, p.pekerjaan, pem.tanggal_pemilu, d.jumlah_donasi, bp.jenis_bantuan
                FROM $wargaTable AS w
                LEFT JOIN $pekerjaanTable AS p ON w.id_pekerjaan = p.id
                LEFT JOIN $pemiluTable AS pem ON w.id_warga = pem.id_warga
                LEFT JOIN $donasiTable AS d ON w.id_warga = d.id_warga
                LEFT JOIN $bantuanTable AS bp ON w.id_warga = bp.id_warga";
        
        if ($condition != '') {
            $query .= " WHERE $condition";
        }
        
        if ($limit !== null) {
            $query .= " LIMIT $limit";
        }

        try {
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        // $db = new YourDatabaseClass();
        // $data = $db->readDataFromFiveTables('warga', 'pekerjaan', 'pemilihan_pemilu', 'donasi', 'bantuan_pemerintah');

        // $db = new YourDatabaseClass();
        // $condition = 'w.usia > 30';
        // $limit = 10;
        // $data = $db->readDataWithConditionAndLimit('warga', 'pekerjaan', 'pemilihan_pemilu', 'donasi', 'bantuan_pemerintah', $condition, $limit);

    }


    public function countData($table, $condition = '', $groupBy = '')
    {
        $query = "SELECT COUNT(*) as total FROM $table";

        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }

        if (!empty($groupBy)) {
            $query .= " GROUP BY $groupBy";
        }

        try {
            $stmt = $this->conn->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        // Memanggil metode countData dengan parameter yang sesuai
        // $table = "nama_tabel"; // Nama tabel yang akan Anda hitung
        // $condition = "usia > 30"; // Kondisi untuk menghitung jumlah data (opsional)
        // $groupBy = "jenis_kelamin"; // Kolom untuk pengelompokan (opsional)

        // // Memanggil fungsi countData
        // if (!empty($condition) || !empty($groupBy)) {
        //     $count = $dataManager->countData($table, $condition, $groupBy);
        // } else {
        //     $count = $dataManager->countData($table);
        // }

        // // Contoh cara menampilkan hasil perhitungan
        // if (!empty($condition)) {
        //     echo "Jumlah data dengan kondisi $condition: $count";
        // } else {
        //     echo "Jumlah total data: $count";
        // }
    }
    
    public function delete($table, $condition)
    {
        $query = "DELETE FROM $table WHERE $condition";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function loginMulti($table, $conditions)
    {
        // Konstruksi klausul WHERE berdasarkan kondisi yang diberikan
        $whereClause = implode(' AND ', $conditions);

        $query = "SELECT * FROM $table WHERE $whereClause";

        try {
            $stmt = $this->conn->prepare($query);

            foreach ($conditions as $key => $value) {
                $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
            }

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                // Token tidak valid atau tidak ditemukan
                return false;
            }

            return $user;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }

        // Memanggil fungsi loginMulti dengan kondisi yang sesuai
        // $conditions = array(
        //     'nik' => '123456',
        //     'user_type' => 'admin'
        // );

        // $user = $dataManager->loginMulti('nama_tabel', $conditions);

        // if ($user) {
        //     // Memeriksa peran pengguna
        //     if ($user['user_type'] === 'admin') {
        //         // Arahkan ke halaman admin
        //         header('Location: admin_page.php');
        //         exit;
        //     } else {
        //         // Arahkan ke halaman pengguna
        //         header('Location: user_page.php');
        //         exit;
        //     }
        // } else {
        //     // Arahkan ke halaman login kembali jika login gagal
        //     header('Location: login.php');
        //     exit;
        // }

    }

    // Fungsi autentikasi pengguna
    public function authenticateUser($username, $password)
    {
        // Di sini Anda dapat menambahkan logika autentikasi berdasarkan jenis kredensial
        // Misalnya, validasi untuk admin, sekdes, kades, warga, dll.

        // Contoh autentikasi sederhana (username dan password disimpan dalam array)
        $users = [
            ['username' => 'admin', 'password' => 'admin_password', 'type' => 'admin'],
            ['username' => 'sekdes', 'password' => 'sekdes_password', 'type' => 'sekdes'],
            ['username' => 'kades', 'password' => 'kades_password', 'type' => 'kades'],
            ['username' => 'warga', 'password' => 'warga_password', 'type' => 'warga'],
            // Tambahkan pengguna lain jika diperlukan
        ];

        // Cari pengguna berdasarkan username
        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                return $user['type']; // Kembalikan jenis kredensial pengguna
            }
        }

        return false; // Autentikasi gagal
    }
    public function getUserBy($tabel, $nik)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE nik = :nik");
        $stmt->execute([':nik' => $nik]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function generatePasswordResetToken($table, $email)
    {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Store the token in the database along with the user's email
        $query = "UPDATE $table SET password_reset_token = :token WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $token;
    }
    public function resetPassword($table, $conditions, $newPassword)
    {
        // Konstruksi klausul WHERE berdasarkan kondisi yang diberikan
        $whereClause = implode(' AND ', $conditions);

        // Verifikasi bahwa token dan kondisi lainnya valid
        $query = "SELECT * FROM $table WHERE $whereClause";
        $stmt = $this->conn->prepare($query);

        foreach ($conditions as $key => $value) {
            $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
        }

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Token atau kondisi tidak valid atau tidak ditemukan
            return false;
        }

        // Reset password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE $table SET password = :password, password_reset_token = NULL WHERE $whereClause";
        $stmt = $this->conn->prepare($query);

        foreach ($conditions as $key => $value) {
            $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
        }

        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();

        return true;

        // // Membuat objek yang memiliki metode resetPassword
        // $databaseManager = new DatabaseManager();

        // // Nama tabel database
        // $tableName = 'nama_tabel';

        // // Kondisi yang ingin Anda gunakan
        // $conditions = array(
        //     'email' => 'johndoe@example.com',
        //     'password_reset_token' => 'token-123'
        // );

        // // Password baru
        // $newPassword = 'password-baru';

        // // Memanggil fungsi resetPassword dengan kondisi yang diberikan
        // if ($databaseManager->resetPassword($tableName, $conditions, $newPassword)) {
        //     echo "Password berhasil direset.";
        // } else {
        //     echo "Gagal mereset password.";
        // }

    }

    public function generateUniqueAduanNumber($length = 8)
    {
        // Karakter yang akan digunakan untuk nomor aduan
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Inisialisasi nomor aduan acak
        $aduanNumber = '';

        // Loop untuk menghasilkan nomor aduan acak dengan panjang tertentu
        for ($i = 0; $i < $length; $i++) {
            $aduanNumber .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $aduanNumber;
    }
    public function readLastAduanNumber()
    {
        try {
            $query = "SELECT last_aduan_number FROM aduan";
            $stmt = $this->conn->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['last_aduan_number'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function checkDuplicateAduan($table, $conditions)
    {
        // Konstruksi klausul WHERE berdasarkan kondisi yang diberikan
        $whereClause = implode(' AND ', $conditions);

        $query = "SELECT COUNT(*) FROM $table WHERE $whereClause";

        try {
            $stmt = $this->conn->prepare($query);

            foreach ($conditions as $key => $value) {
                $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
            }

            $stmt->execute();

            // Mengambil jumlah baris yang sesuai dengan kriteria
            $count = $stmt->fetchColumn();

            return $count > 0; // Mengembalikan true jika ada duplikat, false jika tidak
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        // Membuat objek yang memiliki metode checkDuplicateAduan
        // $databaseManager = new DatabaseManager();

        // // Nama tabel yang ingin Anda gunakan
        // $tableName = 'nama_tabel';

        // // Kondisi yang ingin Anda gunakan
        // $conditions = array(
        //     'nama' => 'Nama Aduan',
        //     'jenis' => 'Jenis Aduan'
        // );

        // // Memanggil fungsi checkDuplicateAduan dengan nama tabel dan kondisi yang diberikan
        // if ($databaseManager->checkDuplicateAduan($tableName, $conditions)) {
        //     echo "Duplikat ditemukan.";
        // } else {
        //     echo "Tidak ada duplikat.";
        // }

    }

    public function updateLastAduanNumber($newAduanNumber)
    {
        try {
            $query = "UPDATE aduan SET last_aduan_number = :newNumber";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':newNumber', $newAduanNumber, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function ReadMultiTable($tables, $columns, $joins, $where = null)
    {
        $tablesClause = implode(', ', $tables);
        $columnsClause = implode(', ', $columns);
        $joinsClause = implode(' ', $joins);

        $query = "SELECT $columnsClause FROM $tablesClause $joinsClause";

        if ($where) {
            $query .= " WHERE $where";
        }

        try {
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        // Membuat objek yang memiliki metode ReadMultiTable
        // $databaseManager = new DatabaseManager();

        // // Daftar tabel yang akan digunakan
        // $tables = array(
        //     'tabel1',
        //     'tabel2',
        //     'tabel3'
        // );

        // // Daftar kolom yang ingin diambil
        // $columns = array(
        //     'tabel1.kolom1',
        //     'tabel2.kolom2',
        //     'tabel3.kolom3'
        // );

        // // Klausul JOIN untuk menggabungkan tabel
        // $joins = array(
        //     'INNER JOIN tabel2 ON tabel1.id = tabel2.tabel1_id',
        //     'LEFT JOIN tabel3 ON tabel1.id = tabel3.tabel1_id'
        // );

        // // Opsional: Klausul WHERE untuk mengkondisikan hasil
        // $whereClause = 'tabel1.kondisi = "nilai tertentu"';

        // // Memanggil fungsi ReadMultiTable
        // $result = $databaseManager->ReadMultiTable($tables, $columns, $joins, $whereClause);

        // if ($result) {
        //     foreach ($result as $row) {
        //         // Melakukan sesuatu dengan setiap baris hasil
        //         echo $row['kolom1'] . ', ' . $row['kolom2'] . ', ' . $row['kolom3'] . '<br>';
        //     }
        // } else {
        //     echo "Terjadi kesalahan saat membaca data.";
        // }

    }

    public function filterData($table, $filterField, $filterValue)
    {
        // Melakukan query untuk mengambil data berdasarkan filter
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $filterField LIKE :filterValue");
        $filterValue = "%$filterValue%"; // Menambahkan wildcard (%) agar mencari nilai yang cocok
        $stmt->bindParam(':filterValue', $filterValue, PDO::PARAM_STR);
        $stmt->execute();

        // Mengambil hasil query sebagai array asosiatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

        // Memanggil metode filterData dengan parameter yang sesuai
        // $table = "nama_tabel"; // Nama tabel yang akan Anda query
        // $filterField = "nama_kolom"; // Nama kolom yang akan digunakan sebagai filter
        // $filterValue = "nilai_filter"; // Nilai yang akan digunakan sebagai kriteria pencarian

        // $result = $dataManager->filterData($table, $filterField, $filterValue);
        // echo "<table>";
        // echo "<tr><th>Nama</th><th>Usia</th></tr>";
        // foreach ($result as $row) {
        //     echo "<tr><td>" . $row['nama'] . "</td><td>" . $row['usia'] . "</td></tr>";
        // }
        // echo "</table>";
    }

}
