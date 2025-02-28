<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restaurant Menu</title>

    <!-- Bootstrap CSS for quick styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;

        }

        .menu-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        .menu-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .menu-section h3 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .menu-item .price {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

    <div class="menu-container">
        <div class="menu-header">
            <h1>Restaurant Name</h1>
            <p>Welcome to our restaurant! Enjoy your meal.</p>
        </div>

        <!-- Menu Section 1 -->
        <div class="menu-section">
            <h3>Starters</h3>
            <div class="menu-item">
                <span>Bruschetta</span>
                <span class="price">€5.00</span>
            </div>
            <div class="menu-item">
                <span>Garlic Bread</span>
                <span class="price">€3.50</span>
            </div>
            <div class="menu-item">
                <span>Caprese Salad</span>
                <span class="price">€6.50</span>
            </div>
        </div>

        <!-- Menu Section 2 -->
        <div class="menu-section">
            <h3>Main Courses</h3>
            <div class="menu-item">
                <span>Margherita Pizza</span>
                <span class="price">€8.00</span>
            </div>
            <div class="menu-item">
                <span>Spaghetti Carbonara</span>
                <span class="price">€12.00</span>
            </div>
            <div class="menu-item">
                <span>Lasagna</span>
                <span class="price">€11.50</span>
            </div>
        </div>

        <!-- Menu Section 3 -->
        <div class="menu-section">
            <h3>Desserts</h3>
            <div class="menu-item">
                <span>Tiramisu</span>
                <span class="price">€4.50</span>
            </div>
            <div class="menu-item">
                <span>Chocolate Cake</span>
                <span class="price">€5.00</span>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2024 Restaurant Name - All rights reserved</p>
        </div>
    </div>

    <!-- Bootstrap JS for any dynamic functionality (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
