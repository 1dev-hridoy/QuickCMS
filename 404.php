<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/main.styl.css">
<style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
        }
        .funny-message {
            font-size: 1.2rem;
            color: #6c757d;
        }
        .animate {
            animation: upDown 2s infinite alternate ease-in-out;
        }
        @keyframes upDown {
            0% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(10px);
            }
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="https://i.ibb.co.com/N6hBKjJy/7887410-3793094.png" alt="Funny 404 Image" class="img-fluid animate">
            </div>
            <div class="col-md-6">
                <h1 class="display-1 fw-bold">404</h1>
                <p class="lead">Oops! It looks like you took a wrong turn.</p>
                <p class="funny-message">Even our GPS is confused! Try heading back to safety.</p>
                <a href="/" class="btn btn-primary">Go Home</a>
            </div>
        </div>
    </div>
</body>
</html>
