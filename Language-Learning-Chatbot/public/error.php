<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .error-container {
            text-align: center;
            padding: 2rem;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .error-title {
            font-size: 2rem;
            color: #dc3545;
        }
        .error-message {
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .btn-primary {
            background-color: #4D1193;
            border-color: #4D1193;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-title">Oops! Something went wrong.</h1>
        <p class="error-message">We couldn't retrieve your profile information. Please try again or contact support if the issue persists.</p>
        <div>
            <a href="index.php" class="btn btn-secondary">Go to Home</a>
            <a href="login.php" class="btn btn-primary">Login Again</a>
        </div>
    </div>
</body>
</html>
