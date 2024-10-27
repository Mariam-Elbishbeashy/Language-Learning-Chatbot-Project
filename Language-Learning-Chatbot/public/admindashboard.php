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
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php include "../views/partials/adminnavbar.php"; ?>
 <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers" style="font-weight: bold;">1,504</div>
                        <div class="cardName" style="font-weight: bold;">Daily Conversations</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline" style="color: #4caf50;"></ion-icon>
                    </div>
                </div>
            
                <div class="card">
                    <div>
                        <div class="numbers" style="font-weight: bold;">80</div>
                        <div class="cardName" style="font-weight: bold;">New Users</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="people-outline" style="color: #2196f3;"></ion-icon>
                    </div>
                </div>
            
                <div class="card">
                    <div>
                        <div class="numbers" style="font-weight: bold;">284</div>
                        <div class="cardName" style="font-weight: bold; color: purple;" >Lessons Completed</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="book-outline" style="color: #ff9800;"></ion-icon>
                    </div>
                </div>
            
                <div class="card">
                    <div>
                        <div class="numbers" style="font-weight: bold;">30,000</div>
                        <div class="cardName" style="font-weight: bold; " >Revenue</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cash-outline" style="color: rgb(47, 255, 144);"></ion-icon>
                    </div>
                </div>
            </div>
            

            <!-- ================ Recent Conversations ================= -->
           <!-- ================ Recent Conversations ================= -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader" style="margin-bottom: 0px; padding-bottom: 0px;">
            <h2>Recent Conversations</h2>
            <a href="#" class="btn">View All</a>
        </div>

        <table class="user-management" style="margin-top: 5px; padding-top: 0px;">
            <thead>
                <tr style="background-color: rgb(69, 34, 100);">
                    <th>User Name</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>Lesson 1: Basic Greetings</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>Jane Smith</td>
                    <td>Lesson 2: Vocabulary</td>
                    <td><span class="status inProgress">In Progress</span></td>
                </tr>
                <tr>
                    <td>Alex Johnson</td>
                    <td>Lesson 3: Grammar</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>
            </tbody>
        </table>
    </div>


                <!-- ================= Recent Users with Analytics ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Analytics Overview</h2>
                    </div>

                    <div class="chart-container">
                        <canvas id="conversationChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =========== Scripts =========  -->
    <script src="../public/js/adminmainjs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Conversation Chart
        const ctx1 = document.getElementById('conversationChart').getContext('2d');
        const conversationChart = new Chart(ctx1, {
            type: 'line', // or 'bar', 'pie', etc.
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Daily Conversations',
                    data: [1200, 1900, 1500, 2000, 1800, 2200],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    
        // Revenue Chart
        const ctx2 = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Revenue',
                    data: [7000, 8000, 7500, 8200, 8400, 9000],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        const toggleButton = document.getElementById("theme-toggle");

toggleButton.addEventListener("click", () => {
  const currentTheme = document.body.getAttribute("data-theme");
  const newTheme = currentTheme === "dark" ? "light" : "dark";
  document.body.setAttribute("data-theme", newTheme);
});

    </script>
    
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
