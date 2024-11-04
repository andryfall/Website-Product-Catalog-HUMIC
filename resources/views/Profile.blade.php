<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Admin Profile</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
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

        .sidebar-profile .profile-fullname {
            font-weight: bold;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: margin-left 0.3s ease;
            height: 100vh;
        }

        .content.shift {
            margin-left: 0;
        }

        .profile-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 50px;
            max-width: 800px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .profile-picture-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }

        .profile-picture {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
        }

        .edit-profile-pic-btn {
            display: none;
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #c5181f;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .profile-picture-container:hover .edit-profile-pic-btn {
            display: block;
        }

        .profile-name {
            font-size: 24px;
            font-weight: bold;
        }

        .profile-fullname {
            margin-bottom: -20px;
            font-size: 20px;
            font-weight: normal;
            color: #666;
        }

        .change-password-form {
            margin-top: 30px;
            width: 100%;
            max-width: 600px;
        }

        .change-password-form label {
            text-align: left;
            display: block;
        }

        .btn-save-changes {
            background-color: #c5181f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-save-changes:hover {
            background-color: #a41419;
        }

        .toggle-btn {
            display: none;
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

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                position: absolute;
                transform: translateX(-100%);
            }

            .sidebar.visible {
                transform: translateX(0);
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
                position: absolute;
                top: 20px;
                left: 20px;
                z-index: 1000;
            }

            .profile-card {
                padding: 30px;
            }

            .profile-picture {
                width: 150px;
                height: 150px;
            }

            .profile-name {
                font-size: 28px;
            }

            .change-password-form {
                max-width: 100%;
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

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fixed-top mx-auto text-center mt-3" role="alert" style="width: 90%; max-width: 500px; z-index: 1050;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show fixed-top mx-auto text-center mt-3" role="alert" style="width: 90%; max-width: 500px; z-index: 1050;">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="content" id="content">
        <button class="btn btn-danger toggle-btn" id="toggleBtn">
            <i class="fas fa-bars"></i>
        </button>
        <div class="profile-card">
            <div class="profile-info">
                <div class="profile-picture-container">
                    <div class="profile-picture" style="background-image: url('{{ session('admin.profile_image') }}');"></div>
                    <button class="edit-profile-pic-btn" onclick="document.getElementById('profileImageInput').click()">Edit</button>
                </div>
                <div class="profile-fullname">{{ session('admin.first_name') }} {{ session('admin.last_name') }}</div>
                <div class="profile-name">Admin</div>
            </div>

            <div class="change-password-form">
                <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="profile_image" id="profileImageInput" class="form-control" style="display: none;" onchange="this.form.submit()">
                </form>

                <form action="{{ route('update.admin') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" id="editFirstName" name="firstNameAdmin" class="form-control" value="{{ session('admin.first_name') }}" required>
                        </div>
                        <div class="col">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" id="editLastName" name="lastNameAdmin" class="form-control" value="{{ session('admin.last_name') }}" required>
                        </div>
                    </div>

                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="email" id="editEmail" name="emailAdmin" class="form-control" autocomplete="off" value="{{ session('admin.email') }}" required> 

                    <button type="submit" class="btn-save-changes">Save changes</button>
                </form>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            content.classList.toggle('shift');
            sidebar.classList.toggle('visible');
        });

    </script>
</body>

</html>
