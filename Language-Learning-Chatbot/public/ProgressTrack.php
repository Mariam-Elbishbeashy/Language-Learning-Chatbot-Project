<?php
// Example user data (This would typically be fetched from a database)
$userProgress = [
    "conversations" => [
        ["date" => "2024-10-01", "score" => 5],
        ["date" => "2024-10-05", "score" => 7],
        ["date" => "2024-10-10", "score" => 9],
        ["date" => "2024-10-15", "score" => 10],
    ],
    "vocabularyFocus" => [
        "grammar" => 30,
        "pronunciation" => 20,
        "vocabulary" => 50,
    ],
    "correctionsReceived" => [
        "Grammar" => 15,
        "Pronunciation" => 10,
        "Vocabulary" => 8
    ]
];

// Extracting data for the charts
$conversations = json_encode(array_column($userProgress["conversations"], "score"));
$dates = json_encode(array_column($userProgress["conversations"], "date"));
$vocabulary = json_encode(array_values($userProgress["vocabularyFocus"]));
$vocabularyLabels = json_encode(array_keys($userProgress["vocabularyFocus"]));

// Example student scores for the bar chart
$studentScores = [5, 7, 9, 10, 6]; // Replace with actual student scores if available
$daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
$usagePercentages = [15, 25, 20, 10, 5, 15, 10]; // Example percentages for chatbot usage
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Progress Tracking</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --clr-white: #ffffff;
            --clr-black: #1E1E2D;
            --clr-dark: #2B2B3D;
            --clr-light: #F1F1F1;
            --clr-primary: #3F51B5;
            --border-radius-1: 10px;
        }

        body {
            background-color: var(--clr-black);
            color: white;
            font-family: Arial, sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        .light-theme {
            background-color: var(--clr-white);
            color: black;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: var(--clr-dark);
            padding: 20px;
            border-radius: var(--border-radius-1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: background-color 0.3s;
        }

        .light-theme .card {
            background-color: var(--clr-light);
        }

        canvas {
            max-width: 100%;
        }

        h1, h2 {
            color: #A3A3B2;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 1.5em;
            margin-bottom: 15px;
        }

        .theme-toggler {
            position: absolute;
            top: 13px;
            right: 20px;
            background: var(--clr-white);
            display: flex;
            justify-content: space-between;
            height: 2rem;
            width: 4.2rem;
            cursor: pointer;
            border-radius: var(--border-radius-1);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .theme-toggler span {
            font-size: 1.2rem;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s, color 0.3s;
            color: black; /* Default icon color */
        }

        .theme-toggler span.active {
            background: var(--clr-primary);
            color: #fff;
        }

        .correction-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #444;
        }

        .correction-label {
            font-weight: bold;
            color: #A3A3B2;
        }

        .correction-value {
            color: #FFCE56; /* Distinct color for the values */
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="theme-toggler">
        <span class="material-symbols-sharp active"><i class="fa-solid fa-moon"></i></span>
        <span class="material-symbols-sharp"><i class="fa-solid fa-sun"></i></span>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 20px 24px; /* Increased padding to make navigation bar bigger */
  text-decoration: none;
  font-size: 20px; /* Increased font size */
}

.topnav a:hover {
  background-color: #04AA6D; /* Green background on hover */
  color: white; /* White text on hover */
}

/* Active link style */
.topnav a.active {
  background-color: #04AA6D; /* Active link color */
  color: white; /* Active text color */
}

/* Prevent hover effect on active link */
.topnav a.active:hover {
  background-color: #04AA6D; /* Keep green background on hover over active link */
  color: white; /* Keep text color white */
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
    padding: 28px 32px; /* Keep padding consistent for smaller screens */
    font-size: 34px; /* Keep font size consistent for smaller screens */
  }
}
</style>
</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="#home" class="active">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About Us</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<div style="padding-left:16px">
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
    <div class="dashboard">
        <div class="card">
            <h2>Overall Progress</h2>
            <canvas id="scatterChart"></canvas>
        </div>
        <div class="card">
            <h2>Conversation History</h2>
            <canvas id="lineChart"></canvas>
        </div>
        <div class="card">
            <h2>Vocabulary Focus</h2>
            <canvas id="pieChart"></canvas>
        </div>
        <div class="card">
            <h2>Student Scores</h2>
            <canvas id="myChartBar"></canvas>
        </div>
        <div class="card">
            <h2>Chatbot Usage by Day</h2>
            <canvas id="myChartPie"></canvas>
        </div>
        <div class="card">
            <h2>Corrections Received</h2>
            <div class="corrections">
                <div class="correction-item">
                    <span class="correction-label">Grammar Corrections:</span>
                    <span class="correction-value"><?php echo $userProgress['correctionsReceived']['Grammar']; ?></span>
                </div>
                <div class="correction-item">
                    <span class="correction-label">Pronunciation Corrections:</span>
                    <span class="correction-value"><?php echo $userProgress['correctionsReceived']['Pronunciation']; ?></span>
                </div>
                <div class="correction-item">
                    <span class="correction-label">Vocabulary Corrections:</span>
                    <span class="correction-value"><?php echo $userProgress['correctionsReceived']['Vocabulary']; ?></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Scatter chart data for progress over time
        const scatterData = [
            {x:50, y:7},
            {x:60, y:8},
            {x:70, y:8},
            {x:80, y:9},
            {x:90, y:9},
            {x:100, y:9},
            {x:110, y:10},
            {x:120, y:11},
            {x:130, y:14},
            {x:140, y:14},
            {x:150, y:15}
        ];

        new Chart("scatterChart", {
            type: "scatter",
            data: {
                datasets: [{
                    label: 'User Progress',
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(0, 204, 255, 1)",
                    data: scatterData
                }]
            },
            options: {
                scales: {
                    x: {title: {display: true, text: 'Attempts', color: '#A3A3B2'}},
                    y: {title: {display: true, text: 'Score', color: '#A3A3B2'}}
                },
                plugins: {
                    legend: {display: false}
                }
            }
        });

        // Line chart for conversation history
        const conversationDates = <?php echo $dates; ?>;
        const conversationScores = <?php echo $conversations; ?>;

        new Chart("lineChart", {
            type: "line",
            data: {
                labels: conversationDates,
                datasets: [{
                    label: 'Conversation Scores',
                    fill: false,
                    pointRadius: 4,
                    borderColor: "rgba(0,255,127,0.7)",
                    data: conversationScores
                }]
            },
            options: {
                scales: {
                    x: {title: {display: true, text: 'Date', color: '#A3A3B2'}},
                    y: {title: {display: true, text: 'Score', color: '#A3A3B2'}}
                },
                plugins: {legend: {display: false}}
            }
        });

        // Pie chart for vocabulary focus
        const vocabData = <?php echo $vocabulary; ?>;
        const vocabLabels = <?php echo $vocabularyLabels; ?>;
        const pieColors = ["#FF6384", "#36A2EB", "#FFCE56"];

        new Chart("pieChart", {
            type: "pie",
            data: {
                labels: vocabLabels,
                datasets: [{
                    backgroundColor: pieColors,
                    data: vocabData
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: "Vocabulary Focus",
                        color: '#A3A3B2'
                    },
                    legend: {
                        labels: {
                            color: '#A3A3B2'
                        }
                    }
                }
            }
        });

        // Bar chart for student scores
        const studentScores = <?php echo json_encode($studentScores); ?>; // Example scores for students
        const studentLabels = ["Attempt 1", "Attempt 2", "Attempt 3", "Attempt 4", "Attempt 5"]; // Label attempts

        new Chart("myChartBar", {
            type: "bar",
            data: {
                labels: studentLabels,
                datasets: [{
                    label: 'Student Scores',
                    backgroundColor: "rgba(75, 192, 192, 0.7)",
                    data: studentScores
                }]
            },
            options: {
                scales: {
                    x: {title: {display: true, text: 'Attempts', color: '#A3A3B2'}},
                    y: {title: {display: true, text: 'Scores', color: '#A3A3B2'}}
                },
                plugins: {
                    legend: {display: false}
                }
            }
        });

        // Pie chart for chatbot usage by day
        const usageLabels = <?php echo json_encode($daysOfWeek); ?>;
        const usageData = <?php echo json_encode($usagePercentages); ?>;
        const usageColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF5733']; // 7 colors for 7 days

        new Chart("myChartPie", {
            type: "pie",
            data: {
                labels: usageLabels,
                datasets: [{
                    backgroundColor: usageColors,
                    data: usageData
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: "Chatbot Usage by Day",
                        color: '#A3A3B2'
                    },
                    legend: {
                        labels: {
                            color: '#A3A3B2'
                        }
                    }
                }
            }
        });

        // Theme toggler functionality
        const themeToggler = document.querySelector('.theme-toggler');

        themeToggler.addEventListener('click', () => {
            document.body.classList.toggle('light-theme'); // Toggle light theme
            themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
            themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
        });
    </script>
</body>
</html>
