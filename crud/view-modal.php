<?php
// Include kelas Crud
require_once 'GenericCrud.php';

// Buat objek Crud
$crud = new Crud();

// Ambil semua pengguna
$users = $crud->readAllRecords("users", PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List with Modal</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>User List with Modal</h1>

    <a href="create.php">Create User</a>
<a href="#" onclick="openCreateModal()">Create User</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td>
                        <a href="#" onclick="showModal('<?php echo $user['id']; ?>')">
                            <?php echo $user['username']; ?>
                        </a>
                    </td>
                    <td>
                        <!-- <a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a> -->
                        <a href="#" id="deleteButton_<?php echo $user['id']; ?>" onclick="showModalDelete('<?php echo $user['id']; ?>')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <!-- Modal -->
    <div id="createUserModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCreateModal()">&times;</span>
        <div id="createModalContent">
            <!-- Formulir Create User -->
            <form id="createUserForm" onsubmit="submitCreateForm(); return false;">
                <label for="createUsername">Username:</label>
                <input type="text" id="createUsername" required>
                <br>

                <label for="createEmail">Email:</label>
                <input type="email" id="createEmail" required>
                <br>

                <label for="createImage">Profile Image:</label>
                <input type="file" id="createImage" accept="image/*" required>
                <br>

                <!-- Tambah tombol "Save" dan "Tambah Baru" -->
                <div>
                    <button type="submit">Save</button>
                    <button type="button" onclick="submitCreateForm(); clearCreateForm();">Tambah Baru</button>
                    <button type="button" onclick="closeCreateModal()">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Modal Konfirmasi Hapus -->
    <!-- Modal Konfirmasi Hapus -->
    <!-- Modal Konfirmasi Hapus -->
        <?php foreach ($users as $user) : ?>
            <div id="deleteConfirmModal_<?php echo $user['id']; ?>" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeDeleteConfirmModal('<?php echo $user['id']; ?>')">&times;</span>
                    <p>Are you sure you want to delete this user?</p>
                    <button onclick="confirmDelete('<?php echo $user['id']; ?>')">Yes</button>
                    <button onclick="closeDeleteConfirmModal('<?php echo $user['id']; ?>')">No</button>
                </div>
            </div>
        <?php endforeach; ?>




    <script>
        function showModalDelete(userId) {
                    // Menampilkan modal konfirmasi sebelum menghapus
                    document.getElementById('deleteConfirmModal_' + userId).style.display = 'block';
                }

                let confirmDeleteUserId;

                // Fungsi untuk mengonfirmasi penghapusan
                function confirmDelete(userId) {
                    // Menutup modal konfirmasi
                    closeDeleteConfirmModal(userId);

                    // Melakukan penghapusan setelah konfirmasi
                    fetch('delete.php?id=' + userId)
                        .then(response => response.text())
                        .then(data => {
                            // Perbarui tabel utama setelah penghapusan
                            fetch('fetchMainTable.php')
                                .then(response => response.text())
                                .then(newTableData => {
                                    document.querySelector('table tbody').innerHTML = newTableData;
                                })
                                .catch(error => {
                                    console.error('Error fetching main table:', error);
                                });
                        })
                        .catch(error => {
                            console.error('Error deleting user:', error);
                        });
                }

                // Fungsi untuk menutup modal konfirmasi
                function closeDeleteConfirmModal(userId) {
                    document.getElementById('deleteConfirmModal_' + userId).style.display = 'none';
                }



        function showModal(userId) {
            // Ambil data pengguna dari server
            fetch('getUserDetails.php?id=' + userId)
                .then(response => response.text())
                .then(data => {
                    // Tampilkan data dalam modal
                    document.getElementById('modalContent').innerHTML = data;
                    document.getElementById('userModal').style.display = 'block';
                });
        }
        function clearCreateForm() {
            document.getElementById('createUsername').value = '';
            document.getElementById('createEmail').value = '';
            document.getElementById('createImage').value = ''; // Reset input file
            // Clear other form fields as needed
        }

        function closeModal() {
            document.getElementById('userModal').style.display = 'none';
        }

        function openCreateModal() {
            document.getElementById('createUserModal').style.display = 'block';
        }

        function closeCreateModal() {
            document.getElementById('createUserModal').style.display = 'none';
        }


        // Tutup modal jika pengguna mengklik di luar area modal
        window.onclick = function (event) {
            if (event.target == document.getElementById('userModal')) {
                closeModal();
            }
        };

        function submitCreateForm() {
            const username = document.getElementById('createUsername').value;
            const email = document.getElementById('createEmail').value;
            const image = document.getElementById('createImage').files[0];

            // Buat objek FormData untuk mengirim data formulir
            const formData = new FormData();
            formData.append('username', username);
            formData.append('email', email);
            formData.append('image', image);

            // Kirim data formulir menggunakan fetch
            fetch('createUser.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Tampilkan pesan atau tanggapan di dalam modal
                document.getElementById('createModalContent').innerHTML = data;

                // Perbarui tabel utama dengan menambahkan baris baru
                const tbody = document.querySelector('table tbody');
                const newRow = tbody.insertRow();
                newRow.innerHTML = data;

                // Tutup modal
                closeCreateModal();

                // Muat ulang atau perbarui tabel utama melalui Ajax
                fetch('fetchMainTable.php')  // Ganti dengan URL atau metode yang sesuai
                    .then(response => response.text())
                    .then(newTableData => {
                        document.querySelector('table tbody').innerHTML = newTableData;
                    })
                    .catch(error => {
                        console.error('Error fetching main table:', error);
                    });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }



    </script>
</body>
</html>
