<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD with AJAX Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <style>
        /* Add your CSS styling here */
    </style>
</head>

<body>
    <h2>User Management</h2>

    <button id="openModalBtn">Add User</button>

    <!-- Modal for adding/editing users -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalBtn">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <div id="userTableContainer">
        <!-- User table will be loaded here through AJAX -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Load initial user table
            loadUserTable();

            // Open the modal for adding/editing users
            $("#openModalBtn").click(function () {
                openUserModal();
            });

            // Close the modal
            $("#closeModalBtn").click(function () {
                closeUserModal();
            });

            // Load the user table
            function loadUserTable() {
                $.ajax({
                    url: "ajax_handler.php?action=getUsers",
                    type: "GET",
                    success: function (data) {
                        $("#userTableContainer").html(data);
                    }
                });
            }

            // Open the modal for adding/editing users
            function openUserModal(userId = null) {
                $.ajax({
                    url: "ajax_handler.php?action=openUserModal",
                    type: "POST",
                    data: { userId: userId },
                    success: function (data) {
                        $("#modalContent").html(data);
                        $("#userModal").css("display", "block");
                    }
                });
            }

            // Close the modal
            function closeUserModal() {
                $("#userModal").css("display", "none");
            }

            // Perform CRUD operations through AJAX
            $(document).on("submit", "#userForm", function (e) {
                e.preventDefault();

                $.ajax({
                    url: "ajax_handler.php?action=saveUser",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data === "success") {
                            loadUserTable();
                            closeUserModal();
                        } else {
                            $("#modalContent").html(data);
                        }
                    }
                });
            });

            $(document).on("click", ".editUser", function () {
                var userId = $(this).data("id");
                openUserModal(userId);
            });

            $(document).on("click", ".deleteUser", function () {
                var userId = $(this).data("id");
                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: "ajax_handler.php?action=deleteUser",
                        type: "POST",
                        data: { userId: userId },
                        success: function (data) {
                            loadUserTable();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
