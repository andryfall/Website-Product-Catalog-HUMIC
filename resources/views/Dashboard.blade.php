<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: white;
            color: black;
            height: 100vh;
            padding: 20px;
            position: fixed;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar a {
            color: black;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #f1f1f1;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            background-color: #f8f9fa;
        }

        .table-wrapper {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #c5181f;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .header-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-bar {
            position: relative;
        }

        .search-bar input {
            border-radius: 25px;
            padding: 8px 40px 8px 20px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .search-bar i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
        }

        .card {
            border-radius: 10px;
            background-color: #c5181f;
            color: white;
            padding: 20px;
            width: 45%;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: left;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h5 {
            font-size: 48px;
            margin: 0;
        }

        .card p {
            font-size: 18px;
            margin: 0;
        }

        .icon {
            font-size: 100px;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .card-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            gap: 10px;
        }

        .card-container .card:first-child {
            margin-right: 20px;
        }

        .card-container .card:last-child {
            margin-left: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .table-wrapper {
                padding: 10px;
            }

            .table {
                font-size: 14px;
            }


            .card-container {
                flex-direction: column;
                align-items: center;
            }

            .card-container .card:first-child {
                width: 80%;
                margin: 10px 0;
            }

            .card-container .card:last-child {
                width: 80%;
                margin: 10px 0;
            }
        }

        @media (max-width: 576px) {
            .table-wrapper {
                padding: 5px;
            }

            .card-container .card {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src="{{url('/images/logo-humic-text.png')}}" alt="HUMIC Logo" class="img-fluid mb-3">
        <ul class="nav flex-column" style="flex-grow: 1;">
            <li class="nav-item">
                <a href="dashboard" class="nav-link">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="management" class="nav-link">
                    <i class="fas fa-folder"></i> Catalog Management
                </a>
            </li>
            <li class="nav-item" style="margin-top:auto;">
                <a href="login" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="card-container">
            <div class="card">
                <h5>4</h5>
                <p>Catalogs</p>
                <i class="fas fa-file-alt icon" style="color: white;"></i>
            </div>
            <div class="card">
                <h5>3</h5>
                <p>Recent Activities</p>
                <i class="fas fa-file-signature icon" style="color: white;"></i>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="header-section">
                <h3>Recent Activity</h3>
                <div class="search-bar">
                    <input type="text" class="form-control" id="search" placeholder="Search recent activities">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Activity Type</th>
                        <th>Item Name</th>
                        <th>Date & Time</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Added</td>
                        <td>Product 1</td>
                        <td>2024-10-09 12:45 PM</td>
                        <td>Added a new product to the catalog.</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Updated</td>
                        <td>Product 2</td>
                        <td>2024-10-09 1:15 PM</td>
                        <td>Updated product details for Product 2.</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Deleted</td>
                        <td>Product 3</td>
                        <td>2024-10-09 2:05 PM</td>
                        <td>Removed a discontinued product from the catalog.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
