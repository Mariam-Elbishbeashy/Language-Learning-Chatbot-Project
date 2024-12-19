<?php
session_start();
if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    header("Location: ../public/login.php");
    exit();
}

include '../Language-Learning-Chatbot/controllers/adminusercontroller.php';

$userManager = new UserManager($conn);
$users = $userManager->fetchUsers();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Admin Dashboard</title>
    <link rel="stylesheet" href="../public/css/styleadmin.css">
    <link rel="stylesheet" href="../public/css/admintable.css">
    <style>
       /* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

/* Form Styles */
#user-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

#user-form input,
#user-form select,
#user-form button {
    padding: 12px;
    font-size: 16px;
    border-radius: 6px;
    border: 1px solid #ccc;
    width: 100%;
    box-sizing: border-box;
}

#user-form input:focus,
#user-form select:focus {
    border-color: #6a1b9a;
    outline: none;
}

#user-form input[type="password"] {
    font-family: Arial, sans-serif;
}

#user-form button {
    background-color: #6a1b9a;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

#user-form button:hover {
    background-color: #4a0072;
}

/* Style for placeholders */
#user-form input::placeholder,
#user-form select::placeholder {
    color: #bbb;
    font-style: italic;
}

/* Optional: Add a background color for the inputs */
#user-form input,
#user-form select {
    background-color: #fafafa;
}

#user-form input[type="password"] {
    font-family: "Courier New", monospace;
}

h2 {
    color: #6a1b9a;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Button for opening the modal */
#add-user-btn {
    padding: 10px 20px;
    background-color: #6a1b9a;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#add-user-btn:hover {
    background-color: #4a0072;
}





        
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include "../Language-Learning-Chatbot/views/partials/adminnavbar.php"; ?>

    <!-- User Management -->
    <section>
        <div class="user-management">
            <h2>User Management</h2>
            <button id="add-user-btn" onclick="openForm()">Add User</button>

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
                    <?php if (isset($users) && !empty($users)): ?>
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
                                    <button onclick="editUser('<?php echo $user['Id']; ?>', '<?php echo $user['username']; ?>', '<?php echo $user['email']; ?>', '<?php echo $user['role']; ?>', '<?php echo $user['language']; ?>')">Edit</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal for User Form -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeForm()">&times;</span>
            <form id="user-form" method="post" action="../public/adminusers.php">
                <input type="hidden" name="id" id="user-id"> <!-- For editing existing users -->
                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <select name="role" id="role" required>
                    <option value="" disabled>Select Role</option>
                    <option value="student">Student</option>
                    <option value="tutor">Tutor</option>
                    <option value="admin">Admin</option>
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
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <select name="gender" id="gender" required>
                    <option value="" disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <input type="hidden" name="action" value="addUser"> <!-- Action to add a user -->
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../public/js/adminmainjs.js"></script>
    <script>
        function openForm() {
            document.getElementById('userModal').style.display = 'block';
        }

        function closeForm() {
            document.getElementById('userModal').style.display = 'none';
        }

        function editUser(id, username, email, role, language) {
            document.getElementById('user-id').value = id;
            document.getElementById('username').value = username;
            document.getElementById('email').value = email;
            document.getElementById('role').value = role;
            document.getElementById('language').value = language;
            openForm();
        }
    </script>
</body>
</html>