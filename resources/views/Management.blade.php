<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Admin Catalog Management</title>
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

        .table tbody td.description {
            max-width: 500px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
        }

        .header-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .main-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            width: 100%;
        }

        .action-icons button {
            border: none;
            background: none;
            color: #c5181f;
            margin-right: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        .action-icons button:hover {
            color: #a11215;
        }

        .add-button {
            background-color: #c5181f;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .add-button:hover {
            background-color: #a9151a;
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
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
                margin-top: 10px;
            }

            .table {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .table-wrapper {
                padding: 5px;
                margin-top: 5px;
            }

            .action-icons button {
                font-size: 16px;
            }

            .add-button {
                width: 40px;
                height: 40px;
                font-size: 18px;
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

        <div class="main-title">
            Catalog Management
        </div>

        <div class="table-wrapper">
            <div class="header-section">
                <h3>Product Catalog</h3>
                <div class="search-bar">
                    <input type="text" class="form-control" id="search" placeholder="Search catalog">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date & Time</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="catalogTableBody">
                    @if(count($catalogs) > 0)
                        @foreach ($catalogs as $id => $catalog)
                            <tr class="catalog-row">
                                <td class="catalog-name">{{ $catalog['name'] }}</td>
                                <td>{{ $catalog['created_at'] }}</td>
                                <td class="description">{{ $catalog['description'] }}</td>
                                <td class="action-icons">
                                    <button class="edit-button" data-id="{{ $id }}" 
                                        data-name="{{ $catalog['name'] }}" 
                                        data-description="{{ $catalog['description'] }}" 
                                        data-image="{{ $catalog['image'] }}" 
                                        data-pdf="{{ $catalog['pdf'] }}" 
                                        data-bs-toggle="modal" data-bs-target="#editCatalogModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <button class="delete-button" data-id="{{ $id }}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-action="{{ route('catalog.delete', $id) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    
                                    <button class="info-button" data-id="{{ $id }}" 
                                        data-name="{{ $catalog['name'] }}" 
                                        data-date="{{ $catalog['created_at'] }}" 
                                        data-description="{{ $catalog['description'] }}" 
                                        data-image="{{ $catalog['image'] }}" 
                                        data-pdf="{{ $catalog['pdf'] }}"
                                        data-bs-toggle="modal" data-bs-target="#detailCatalogModal">
                                        <i class="fas fa-info-circle"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">No catalogs available.</td>
                        </tr>
                    @endif
                </tbody>                              
            </table>
        </div>
    </div>

    <!-- Plus button -->
    <button class="add-button" data-bs-toggle="modal" data-bs-target="#createCatalogModal">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Modal for creating catalog -->
    <div class="modal fade" id="createCatalogModal" tabindex="-1" aria-labelledby="createCatalogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="createCatalogModalLabel">Create Catalog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createCatalogForm" method="POST" action="{{ route('catalog.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="catalogName" class="form-label">Catalog Name</label>
                            <input type="text" class="form-control" id="catalogName" name="catalogName" required>
                        </div>
                        <div class="mb-3">
                            <label for="catalogDescription" class="form-label">Catalog Description</label>
                            <textarea class="form-control" id="catalogDescription" name="catalogDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="catalogImage" class="form-label">Catalog Image</label>
                            <input type="file" class="form-control" id="catalogImage" name="catalogImage" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="catalogPDF" class="form-label">Catalog PDF</label>
                            <input type="file" class="form-control" id="catalogPDF" name="catalogPDF" accept="application/pdf" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger">Create Catalog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing catalog -->
    <div class="modal fade" id="editCatalogModal" tabindex="-1" aria-labelledby="editCatalogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="editCatalogModalLabel">Edit Catalog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCatalogForm" action="{{ route('catalog.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editCatalogId" name="catalogId">
                        <div class="mb-3">
                            <label for="editCatalogName" class="form-label">Catalog Name</label>
                            <input type="text" class="form-control" id="editCatalogName" name="catalogName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCatalogDescription" class="form-label">Catalog Description</label>
                            <textarea class="form-control" id="editCatalogDescription" name="catalogDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editCatalogImage" class="form-label">Catalog Image (optional)</label>
                            <input type="file" class="form-control" id="editCatalogImage" name="catalogImage" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="editCatalogPdf" class="form-label">Catalog PDF (optional)</label>
                            <input type="file" class="form-control" id="editCatalogPdf" name="catalogPDF" accept="application/pdf">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger">Save Changes</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for deletion -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('catalog.delete', $id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for details -->
    <div class="modal fade" id="detailCatalogModal" tabindex="-1" aria-labelledby="detailCatalogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailCatalogModalLabel">Catalog Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Product Name:</strong></td>
                                <td><span id="detailProductName"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Date & Time:</strong></td>
                                <td><span id="detailProductDate"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td><span id="detailProductDescription"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Image:</strong></td>
                                <td>
                                    <img id="detailProductImage" src="" alt="Product Image" class="img-fluid" style="max-width: 200px;">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PDF File:</strong></td>
                                <td>
                                    <a id="detailProductPdf" href="" target="_blank">View PDF</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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

        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#catalogTableBody .catalog-row');
            
            rows.forEach(row => {
                const name = row.querySelector('.catalog-name').textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.getElementById('toggleBtn').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');

            sidebar.classList.toggle('visible');
            content.classList.toggle('shift');
        });

        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const description = this.dataset.description;
                const image = this.dataset.image;
                const pdf = this.dataset.pdf;
    
                document.getElementById('editCatalogId').value = id;
                document.getElementById('editCatalogName').value = name;
                document.getElementById('editCatalogDescription').value = description;
            });
        });

        document.querySelectorAll('.info-button').forEach(button => {
            button.addEventListener('click', function() {
                const name = this.dataset.name;
                const date = this.dataset.date;
                const description = this.dataset.description;
                const image = this.dataset.image;
                const pdf = this.dataset.pdf;

                document.getElementById('detailProductName').textContent = name;
                document.getElementById('detailProductDate').textContent = date;
                document.getElementById('detailProductDescription').textContent = description;
                document.getElementById('detailProductImage').src = image;
                document.getElementById('detailProductPdf').href = pdf;
                
            });
        });

    </script>
    
    
</body>

</html>
