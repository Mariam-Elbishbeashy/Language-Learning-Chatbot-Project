<?php include '../controllers/adminusercontroller.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../public/css/styleadmin.css">
    <link rel="stylesheet" href="../public/css/admintable.css">
    <style>
        .user-management {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 95%; /* Adjusted width */
            max-width: 1500px; /* Set a maximum width */
            margin-left: auto; /* Centering */
            margin-right: auto; /* Centering */
        }

        .user-management h2 {
            color: #6a1b9a;
        }

        .user-management table {
            width: 100%; /* Table takes full width of the container */
            border-collapse: collapse;
            margin: 20px auto; /* Centering the table */
        }

        .user-management table,
        .user-management th,
        .user-management td {
            border: 1px solid #ddd;
        }

        .user-management th {
            background-color: #6a1b9a;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .user-management td {
            padding: 10px;
            text-align: left;
            background-color: #f9f9f9;
        }

        .user-management tr:hover td {
            background-color: #e1bee7;
        }

        .user-management input,
        .user-management select {
            padding: 8px; /* Padding for input/select */
            border: 1px solid #ddd; /* Border for input/select */
            border-radius: 5px; /* Rounded corners */
            width: calc(15% - 10px); /* Adjusted width for smaller size */
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1); /* Shadow effect */
            margin: 10px; /* Consistent margin */
        }

        .user-management button {
            padding: 8px 12px; /* Button padding */
            background-color: #6a1b9a; /* Button color */
            color: white; /* Button text color */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .user-management button:hover {
            background-color: #4a0072; /* Button hover color */
        }

        /* Add styles for modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px; 

        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 500px; /* Max width for modal */
            border-radius: 8px;
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
    <!-- =============== Navigation ================ -->
    <?php include "../views/partials/adminnavbar.php"; ?>
    <!------------------------------ User Management Section ---------------------------->
    <section>
        <div class="user-management">
            <h2>User Management</h2>
            <form id="user-form" method="post">
                <input type="hidden" name="id" id="user-id">
                <input type="text" name="username" id="username" placeholder="Username" required>

                <select name="role" id="role" required>
                    <option value="" disabled>Select Role</option>
                    <option value="Student">Student</option>
                    <option value="Tutor">Tutor</option>
                    <option value="Admin">Admin</option>

                </select>
                <select name="language" id="language" required>
                    <option value="" disabled>Select Language</option>
                    <option value="English">English</option>
                    <option value="Spanish">Spanish</option>
                    <option value="French">French</option>
                    <option value="German">German</option>
                    <option value="Mandarin">Mandarin</option>
                </select>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit" name="addUser">Add User</button>
                <button type="submit" name="editUser">Update User</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Language</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="user-list">
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td><?php echo $user['language']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $user['Id']; ?>">
                                <button type="submit" name="removeUser" onclick="return confirm('Are you sure you want to remove this user?');">Remove</button>
                            </form>
                            <button onclick="editUser('<?php echo $user['Id']; ?>', '<?php echo $user['username']; ?>', '<?php echo $user['email']; ?>', '<?php echo $user['role']; ?>', '<?php echo $user['language']; ?>', '<?php echo $user['password']; ?>')">Edit</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        function editUser(id, username, email, role, language, password) {
            document.getElementById('user-id').value = id;
            document.getElementById('username').value = username;
            document.getElementById('email').value = email;
            document.getElementById('role').value = role;
            document.getElementById('language').value = language;
            document.getElementById('password').value = password; 
        }

        window.onload = function() {
            var message = <?php echo json_encode($message); ?>;
            if (message) {
                alert(message);
            }
        };
    </script>

    <!-- =========== Scripts =========  -->
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="../public/js/adminmainjs.js"></script>
</body>
</html>
