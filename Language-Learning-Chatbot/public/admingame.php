<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamification Elements Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../public/css/styleadmin.css">
    
    <link rel="stylesheet" href="../public/css/admintable.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #6a1b9a;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #e1bee7;
        }

        button {
            padding: 8px 15px;
            background-color: #6a1b9a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #8c45a0;
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
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
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
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php include "../views/partials/adminnavbar.php"; ?>
    <!------------------------------ Gamification Section ---------------------------->
    <section>
        <div class="dashboard">
            <h2>Gamification Elements</h2>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User ID</th>
                        <th>Chosen Gamification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="gamification-list">
                    <tr>
                        <td>John Doe</td>
                        <td>1</td>
                        <td>Quizzes, Badges</td>
                        <td><button onclick="showScore(1)">Show Score</button></td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>2</td>
                        <td>Challenges, Rewards</td>
                        <td><button onclick="showScore(2)">Show Score</button></td>
                    </tr>
                    <tr>
                        <td>Michael Johnson</td>
                        <td>3</td>
                        <td>Quizzes, Challenges</td>
                        <td><button onclick="showScore(3)">Show Score</button></td>
                    </tr>
                    <tr>
                        <td>Emily Davis</td>
                        <td>4</td>
                        <td>Rewards</td>
                        <td><button onclick="showScore(4)">Show Score</button></td>
                    </tr>
                    <tr>
                        <td>James Brown</td>
                        <td>5</td>
                        <td>Badges, Challenges</td>
                        <td><button onclick="showScore(5)">Show Score</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal for Scores -->
        <div id="scoreModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeScoreModal">&times;</span>
                <h2>User Score</h2>
                <div id="score-display"></div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
    <script>
        const scores = {
            1: 85,
            2: 92,
            3: 78,
            4: 88,
            5: 94,
        };

        function showScore(userId) {
            const scoreDisplay = document.getElementById('score-display');
            scoreDisplay.innerHTML = `Score for User ID ${userId}: ${scores[userId]}`;
            document.getElementById('scoreModal').style.display = 'block';
        }

        document.getElementById('closeScoreModal').onclick = function() {
            document.getElementById('scoreModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('scoreModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>
