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
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php include "../views/partials/adminnavbar.php"; ?>
            <!------------------------------ User Management Section ---------------------------->
            <section>
                <div class="user-management">
                    <h2>User Management</h2>
                    <form id="user-form">
                        <input type="text" id="username" placeholder="Username" required>
                        <select id="role" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="Student">Student</option>
                            <option value="Tutor">Tutor</option>
                        </select>
                        <select id="language" required>
                            <option value="" disabled selected>Select Language</option>
                            <option value="English">English</option>
                            <option value="Spanish">Spanish</option>
                            <option value="French">French</option>
                            <option value="German">German</option>
                            <option value="Mandarin">Mandarin</option>
                        </select>
                        <input type="email" id="email" placeholder="Email" required>
                        <button type="submit">Add User</button>
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
                            <!-- Pre-existing users will be populated here -->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="../public/js/adminmainjs.js"></script>
    <script>
        document.getElementById("user-form").addEventListener("submit", function(event) {
            event.preventDefault();
            const username = document.getElementById("username").value;
            const role = document.getElementById("role").value;
            const language = document.getElementById("language").value;
            const email = document.getElementById("email").value;

            addUser(username, role, language, email);
            document.getElementById("user-form").reset(); // Reset the form
        });

        let users = [
            { username: "John Doe", role: "Student", language: "English", email: "john@example.com" },
            { username: "Jane Smith", role: "Tutor", language: "Spanish", email: "jane@example.com" },
            { username: "Mike Brown", role: "Student", language: "French", email: "mike@example.com" },
            { username: "Alice Johnson", role: "Tutor", language: "English", email: "alice@example.com" },
            { username: "Bob Williams", role: "Student", language: "Spanish", email: "bob@example.com" },
            { username: "Charlie Davis", role: "Student", language: "German", email: "charlie@example.com" }
        ];

        function renderUserList() {
            const userList = document.getElementById("user-list");
            userList.innerHTML = "";
            users.forEach((user, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${user.username}</td>
                    <td>${user.role}</td>
                    <td>${user.language}</td>
                    <td>${user.email}</td>
                    <td>
                        <button onclick="editUser(${index})">Edit</button>
                        <button onclick="removeUser(${index})">Remove</button>
                    </td>
                `;
                userList.appendChild(row);
            });
        }

        function addUser(username, role, language, email) {
            users.push({ username, role, language, email });
            renderUserList();
        }

        function editUser(index) {
            const user = users[index];
            document.getElementById("username").value = user.username;
            document.getElementById("role").value = user.role;
            document.getElementById("language").value = user.language;
            document.getElementById("email").value = user.email;

            // Remove user after editing to prevent duplication
            removeUser(index);
        }

        function removeUser(index) {
            users.splice(index, 1);
            renderUserList();
        }

        // Initial rendering of the user list
        renderUserList();
    </script>
</body>

</html>
