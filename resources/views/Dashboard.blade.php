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
            overflow-x: hidden;
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
            transition: transform 0.3s ease;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a {
            color: black;
            text-decoration: none;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background 0.3s ease;
            gap: 10px;
        }

        .sidebar a:hover {
            background-color: #f1f1f1;
        }

        .sidebar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .sidebar-profile .profile-fullname {
            font-weight: bold;
        }

        .profile-fullname {
            margin-bottom: -20px;
            font-size: 20px;
            font-weight: normal;
            color: #666;
        }

        .sidebar a:hover {
            background-color: #f1f1f1;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            background-color: #f8f9fa;
            transition: margin-left 0.3s ease;
        }

        .content.shift {
            margin-left: 0;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
        .pagination-wrapper .btn {
            margin: 0 5px;
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
            width: 250px;
            margin-left: auto;
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

        .toggle-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                position: absolute;
                transform: translateX(-100%);
            }

            .sidebar.visible {
                transform: translateX(0);
            }

            .sidebar-profile img {
                width: 30px;
                height: 30px;
            }

            .sidebar-profile .profile-fullname {
                font-size: 16px;
            }

            .sidebar-profile .text-muted {
                font-size: 14px;
            }

            .content {
                margin-left: 0;
            }

            .content.shift {
                margin-left: 200px;
            }

            .toggle-btn {
                display: block;
                margin-bottom: 20px;
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

            .card-container .card:first-child,
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
    <div class="sidebar" id="sidebar">
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
                <a href="profile" class="nav-link sidebar-profile">
                    <img src="{{ session('admin.profile_image') }}" alt="Profile Picture">
                    <div>
                        <span class="profile-fullname">{{ session('admin.first_name') }} {{ session('admin.last_name') }}</span><br>
                        <span class="text-muted">Admin</span>
                    </div>
                </a>
            </li>
            <li class="nav-item d-flex">
                <a href="settings" class="nav-link" style="border-left: 1px solid #ccc; padding-left: 15px;">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="javascript:void(0);" id="logoutBtn" class="nav-link flex-grow-1" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </a>
            </li>
        </ul>
    </div>
    

    <div class="content" id="content">
        <button class="btn btn-danger toggle-btn" id="toggleBtn">
            <i class="fas fa-bars"></i>
        </button>
        <div class="card-container">
            <div class="card">
                <h5>{{ $catalogCount }}</h5>
                <p>Catalogs</p>
                <i class="fas fa-file-alt icon" style="color: white;"></i>
            </div>
            <div class="card">
                <h5>{{ $logCount }}</h5>
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
                    @if(count($logs) > 0)
                        @php $i = ($currentPage - 1) * 8 + 1; @endphp
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $log['activity'] }}</td>
                                <td>{{ $log['item_name'] }}</td>
                                <td>{{ $log['date_time'] }}</td>
                                <td>{{ $log['description'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">No catalogs available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        
            <div class="pagination-wrapper">
                @for ($page = 1; $page <= $lastPage; $page++)
                    <a href="{{ request()->url() }}?page={{ $page }}" class="btn {{ $page == $currentPage ? 'btn-danger' : 'btn-secondary' }}">
                        {{ $page }}
                    </a>
                @endfor
            </div>
        </div>
        
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggleBtn').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');

            sidebar.classList.toggle('visible');
            content.classList.toggle('shift');
        });

        document.getElementById('confirmLogoutButton').addEventListener('click', function() {
        window.location.href = 'login'; // Redirect to the login page or actual logout route
         });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
