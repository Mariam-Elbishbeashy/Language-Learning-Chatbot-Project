<?php include '../Language-Learning-Chatbot/controllers/adminusercontroller.php'; ?>

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
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
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

        /* Styling for the user management area */
        .user-management { 
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 95%; 
            max-width: 1500px; 
            margin-left: auto; 
            margin-right: auto; 
        }
        
        .user-management h2 {
            color: #6a1b9a;
        }

        .user-management table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
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
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: calc(15% - 10px);
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        .user-management button {
            padding: 8px 12px;
            background-color: #6a1b9a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-management button:hover {
            background-color: #4a0072;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php include "../Language-Learning-Chatbot/views/partials/adminnavbar.php"; ?>

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

    <!-- Modal for notifications -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
        function editUser(id, username, email, role, language, password) {
            document.getElementById('user-id').value = id;
            document.getElementById('username').value = username;
            document.getElementById('email').value = email;
            document.getElementById('role').value = role;
            document.getElementById('language').value = language;
            document.getElementById('password').value = password; 
        }

        function showModal(message) {
            document.getElementById('modalMessage').innerText = message;
            document.getElementById('successModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
        }

        window.onload = function() {
            var message = <?php echo json_encode($message); ?>;
            if (message) {
                showModal(message);
            }
        };
    </script>

    <!-- =========== Scripts =========  -->
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="../public/js/adminmainjs.js"></script>
</body>
</html>
