<?php
include '../Language-Learning-Chatbot/controllers/restrict.php';
restrictPageAccess('admin', '../public/home.php'); // Redirect non-admin users to home page
?>
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

body {
            font-family: Arial, sans-serif; /* Ensures a consistent font */
            background-color: #f4f4f4; /* Light background for the body */
        }

        .dashboard {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 95%;
            max-width: 1500px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Space above the table */
        }

        th, td {
            padding: 12px; /* Increased padding for better touch targets */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #6a1b9a; /* Header color */
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternating row color */
        }

        tbody tr:hover {
            background-color:  #e1bee7; /* Hover effect */
        }

        button {
            padding: 8px 15px; /* Adjusted padding for the button */
            background-color: #6a1b9a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        button:hover {
            background-color: #8c45a0; /* Hover effect */
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
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4); 
      }
      
      .modal-content {
        background-color: #fefefe;
        margin: 15% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 80%; 
        border-radius: 10px;
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
      }</style>
</head>
<body>
    <!-- =============== Navigation ================ -->
    <?php include "../views/partials/adminnavbar.php"; ?>
       <!------------------------------ User Management Section ---------------------------->
            <section>
             <div class="dashboard">
                <table>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Language Learning</th>
                            <th>Common Queries</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        <tr>
                            <td>John Doe</td>
                            <td>Spanish</td>
                            <td>How to improve my vocabulary?</td>
                            <td><button onclick="showProgress('John Doe')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>French</td>
                            <td>What are the best resources for practice?</td>
                            <td><button onclick="showProgress('Jane Smith')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>Mike Johnson</td>
                            <td>German</td>
                            <td>Can you recommend any podcasts?</td>
                            <td><button onclick="showProgress('Mike Johnson')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>Emily Davis</td>
                            <td>Italian</td>
                            <td>How do I prepare for a language exam?</td>
                            <td><button onclick="showProgress('Emily Davis')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>Chris Lee</td>
                            <td>Japanese</td>
                            <td>What are effective study techniques?</td>
                            <td><button onclick="showProgress('Chris Lee')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>Sarah Wilson</td>
                            <td>Chinese</td>
                            <td>How to practice speaking fluently?</td>
                            <td><button onclick="showProgress('Sarah Wilson')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>David Brown</td>
                            <td>Russian</td>
                            <td>What are common phrases to learn first?</td>
                            <td><button onclick="showProgress('David Brown')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>Linda Garcia</td>
                            <td>Portuguese</td>
                            <td>How can I improve my pronunciation?</td>
                            <td><button onclick="showProgress('Linda Garcia')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>James Martinez</td>
                            <td>Arabic</td>
                            <td>What are the best apps for language learning?</td>
                            <td><button onclick="showProgress('James Martinez')">View Progress</button></td>
                        </tr>
                        <tr>
                            <td>Patricia Hernandez</td>
                            <td>English</td>
                            <td>How to expand my vocabulary?</td>
                            <td><button onclick="showProgress('Patricia Hernandez')">View Progress</button></td>
                        </tr>
                        <!-- Add more users as needed -->
                    </tbody>
                </table>
            </div>
    
            <!-- Progress Modal -->
            <div id="progressModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2 id="userName"></h2>
                    <p id="progressDetails"></p>
                    <canvas id="learningProgressChart"></canvas>
                </div>
            </div>

    <!-- =========== Scripts =========  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="../public/js/adminmainjs.js"></script>
    <script>
         const users = [
      { id: 'JohnDoe', name: 'John Doe', engagementData: [10, 20, 30], progressData: [80, 70, 90] },
      { id: 'JaneSmith', name: 'Jane Smith', engagementData: [15, 25, 35], progressData: [60, 75, 85] },
      { id: 'MikeJohnson', name: 'Mike Johnson', engagementData: [20, 15, 10], progressData: [50, 60, 70] },
      { id: 'EmilyDavis', name: 'Emily Davis', engagementData: [25, 20, 15], progressData: [90, 80, 70] },
      { id: 'ChrisLee', name: 'Chris Lee', engagementData: [30, 35, 40], progressData: [70, 85, 80] },
      { id: 'SarahWilson', name: 'Sarah Wilson', engagementData: [35, 30, 25], progressData: [95, 90, 80] },
      { id: 'DavidBrown', name: 'David Brown', engagementData: [40, 45, 50], progressData: [65, 70, 75] },
      { id: 'LindaGarcia', name: 'Linda Garcia', engagementData: [45, 40, 35], progressData: [55, 60, 65] },
      { id: 'JamesMartinez', name: 'James Martinez', engagementData: [50, 55, 60], progressData: [90, 85, 80] },
      { id: 'PatriciaHernandez', name: 'Patricia Hernandez', engagementData: [55, 50, 45], progressData: [75, 70, 65] },
    ];

    function showProgress(userName) {
        const user = users.find(u => u.name === userName);
        if (user) {
            document.getElementById('userName').innerText = user.name;
            document.getElementById('progressDetails').innerText = 'Engagement Data: ' + user.engagementData.join(', ') + ' | Progress Data: ' + user.progressData.join(', ');
            document.getElementById('progressModal').style.display = 'block';

            // Chart setup
            const ctx = document.getElementById('learningProgressChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Module 1', 'Module 2', 'Module 3'],
                    datasets: [{
                        label: 'Learning Progress',
                        data: user.progressData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }

    function closeModal() {
        document.getElementById('progressModal').style.display = 'none';
    }

    // Close the modal when the user clicks anywhere outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('progressModal');
        if (event.target == modal) {
            closeModal();
        }
    }

    </script>
        <script src="assets/js/main.js"></script>

</body>

</html>
