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
    <title>Language Analysis Dashboard</title>
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

     
        .chart-container {
            width: 100%;
            height: 300px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php include "../views/partials/adminnavbar.php"; ?>
            <!------------------------------ Language Analysis Section ---------------------------->
            <section>
                <div class="dashboard">
                    <h2>Language Analysis</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Language Name</th>
                                <th>Usage Percentage</th>
                                <th>Common Topics</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="languageTable">
                            <tr>
                                <td>Spanish</td>
                                <td>8.1%</td>
                                <td>Grammar, Vocabulary, Culture</td>
                                <td><button onclick="showAnalysis('Spanish')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>French</td>
                                <td>3.9%</td>
                                <td>Grammar, Literature, History</td>
                                <td><button onclick="showAnalysis('French')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>German</td>
                                <td>1.0%</td>
                                <td>Grammar, Philosophy, Music</td>
                                <td><button onclick="showAnalysis('German')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>Italian</td>
                                <td>0.5%</td>
                                <td>Grammar, Art, Food</td>
                                <td><button onclick="showAnalysis('Italian')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>Chinese</td>
                                <td>11.9%</td>
                                <td>Characters, Tones, Culture</td>
                                <td><button onclick="showAnalysis('Chinese')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>Japanese</td>
                                <td>2.9%</td>
                                <td>Grammar, Kanji, Culture</td>
                                <td><button onclick="showAnalysis('Japanese')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>Russian</td>
                                <td>3.0%</td>
                                <td>Grammar, Literature, History</td>
                                <td><button onclick="showAnalysis('Russian')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>Arabic</td>
                                <td>4.3%</td>
                                <td>Grammar, Dialects, Culture</td>
                                <td><button onclick="showAnalysis('Arabic')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>Portuguese</td>
                                <td>2.6%</td>
                                <td>Grammar, Culture, Literature</td>
                                <td><button onclick="showAnalysis('Portuguese')">View Analysis</button></td>
                            </tr>
                            <tr>
                                <td>English</td>
                                <td>13.4%</td>
                                <td>Grammar, Literature, Business</td>
                                <td><button onclick="showAnalysis('English')">View Analysis</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Modal for Language Analysis -->
            <div id="analysisModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2 id="analysisTitle">Analysis for</h2>
                    <div id="chartContainer">
                        <canvas id="analysisChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Scripts ====== -->
    <script src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../public/js/adminmainjs.js"></script>

    <script>
        const chartData = {
            Spanish: [30, 25, 45],
            French: [35, 15, 50],
            German: [20, 30, 50],
            Italian: [40, 30, 30],
            Chinese: [50, 25, 25],
            Japanese: [30, 50, 20],
            Russian: [20, 20, 60],
            Arabic: [25, 35, 40],
            Portuguese: [30, 40, 30],
            English: [40, 30, 30]
        };
    
let analysisChart;

function showAnalysis(language) {
    const data = chartData[language];
    const ctx = document.getElementById('analysisChart').getContext('2d');

    if (analysisChart) {
        analysisChart.destroy();
    }

    analysisChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Grammar', 'Culture', 'Literature'], 
            datasets: [{
                label: 'Usage Distribution',
                data: data, 
                backgroundColor: [
                    'rgba(105, 240, 174, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)'
                ],
                borderColor: [
                    'rgba(105, 240, 174, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Usage Percentage'
                    }
                }
            }
        }
    });

    document.getElementById('analysisTitle').innerText = `Analysis for ${language}`;

    document.getElementById('analysisModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('analysisModal').style.display = 'none';
}

        
    </script>
    <script src="assets/js/main.js"></script>
    
</body>

</html>
