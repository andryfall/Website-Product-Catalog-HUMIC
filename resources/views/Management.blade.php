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
            flex-direction: column;
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

        .sidebar .nav-item i {
            margin-right: 10px;
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
        
        .table tbody td.description {
            max-width: 500px;
            overflow:hidden;
            text-overflow:ellipsis;
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
            flex-wrap: wrap;
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

        /* Styles for the plus button */
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
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .add-button:hover {
            background-color: #a9151a;
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
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

            .search-bar {
                width: 100%;
                margin-top: 10px;
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
        }

        @media (max-width: 576px) {
            .table-wrapper {
                padding: 5px;
            }

            .action-icons button {
                font-size: 16px;
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date & Time</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Digital Stethoscope</td>
                        <td>2024-10-09 12:45 PM</td>
                        <td class="description">A digital stethoscope is an innovative tool used to visually observe heart sounds without the need to rely on the sense of hearing. It focuses on utilizing sound signals specifically to detect heart valve disease.</td>
                        <td class="action-icons">
                            <button class="edit-button" data-id="1"><i class="fas fa-edit"></i></button>
                            <button class="delete-button" data-id="3"><i class="fas fa-trash"></i></button>
                            <button class="info-button" data-id="3"><i class="fas fa-info-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>SiHEDAF</td>
                        <td>2024-10-09 1:15 PM</td>
                        <td class="description">SiHEDAF functions as an Atrial Fibrillation (AF) detector based on Photoplethysmograph (PPG) signal. AF occurrence statistics can be used as an indication of stroke risk in patients.</td>
                        <td class="action-icons">
                            <button class="edit-button" data-id="2"><i class="fas fa-edit"></i></button>
                            <button class="delete-button" data-id="3"><i class="fas fa-trash"></i></button>
                            <button class="info-button" data-id="3"><i class="fas fa-info-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Antropometri Kit</td>
                        <td>2024-10-09 2:05 PM</td>
                        <td class="description">Anthropometry Kit is a series of tools that function to detect stunting in children through measuring body weight, length and height as well as upper arm and head circumference.</td>
                        <td class="action-icons">
                            <button class="edit-button" data-id="3"><i class="fas fa-edit"></i></button>
                            <button class="delete-button" data-id="3"><i class="fas fa-trash"></i></button>
                            <button class="info-button" data-id="3"><i class="fas fa-info-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>AMons</td>
                        <td>2024-10-09 3:05 PM</td>
                        <td class="description">AMons is a portable ECG device equipped with AI-based detection algorithms for near real-time detection and alerting of various arrhythmias, offering a solution for monitoring and timely intervention in heart conditions that may otherwise go undetected.</td>
                        <td class="action-icons">
                            <button class="edit-button" data-id="3"><i class="fas fa-edit"></i></button>
                            <button class="delete-button" data-id="3"><i class="fas fa-trash"></i></button>
                            <button class="info-button" data-id="3"><i class="fas fa-info-circle"></i></button>
                        </td>
                    </tr>
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
                    <form id="createCatalogForm">
                        <div class="mb-3">
                            <label for="catalogName" class="form-label">Catalog Name</label>
                            <input type="text" class="form-control" id="catalogName" required>
                        </div>
                        <div class="mb-3">
                            <label for="catalogDescription" class="form-label">Catalog Description</label>
                            <textarea class="form-control" id="catalogDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="catalogImage" class="form-label">Catalog Image</label>
                            <input type="file" class="form-control" id="catalogImage" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="catalogPdf" class="form-label">Catalog PDF</label>
                            <input type="file" class="form-control" id="catalogPdf" accept="application/pdf" required>
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
                    <form id="editCatalogForm">
                        <input type="hidden" id="editCatalogId">
                        <div class="mb-3">
                            <label for="editCatalogName" class="form-label">Catalog Name</label>
                            <input type="text" class="form-control" id="editCatalogName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCatalogDescription" class="form-label">Catalog Description</label>
                            <textarea class="form-control" id="editCatalogDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editCatalogImage" class="form-label">Catalog Image</label>
                            <input type="file" class="form-control" id="editCatalogImage" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="editCatalogPdf" class="form-label">Catalog PDF</label>
                            <input type="file" class="form-control" id="editCatalogPdf" accept="application/pdf">
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
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let deleteProductId = null;
    
        // Show the edit modal and populate the fields
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function () {
                const rowId = this.getAttribute('data-id');
                const existingData = {
                    1: {
                        name: 'Product 1',
                        description: 'Added a new product to the catalog.',
                    },
                    2: {
                        name: 'Product 2',
                        description: 'Updated product details for Product 2.',
                    },
                    3: {
                        name: 'Product 3',
                        description: 'Removed a discontinued product from the catalog.',
                    },
                };
    
                const productData = existingData[rowId];
                document.getElementById('editCatalogId').value = rowId;
                document.getElementById('editCatalogName').value = productData.name;
                document.getElementById('editCatalogDescription').value = productData.description;
    
                const editCatalogModal = new bootstrap.Modal(document.getElementById('editCatalogModal'));
                editCatalogModal.show();
            });
        });
    
        // Handle delete button click
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                deleteProductId = this.getAttribute('data-id');
                const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
                confirmDeleteModal.show();
            });
        });
    
        // Detail modal functionality
        const detailModal = new bootstrap.Modal(document.getElementById('detailCatalogModal'));
    
        document.querySelectorAll('.info-button').forEach(button => {
            button.addEventListener('click', (event) => {
                const productId = button.getAttribute('data-id');
    
                const catalogData = {
                    1: {
                        name: 'Digital Stethoscope',
                        date: '2024-10-09 12:45 PM',
                        description: 'A digital stethoscope is an innovative tool used to visually observe heart sounds without the need to rely on the sense of hearing. It focuses on utilizing sound signals specifically to detect heart valve disease.',
                    },
                    2: {
                        name: 'SiHEDAF',
                        date: '2024-10-09 1:15 PM',
                        description: 'SiHEDAF functions as an Atrial Fibrillation (AF) detector based on Photoplethysmograph (PPG) signal. AF occurrence statistics can be used as an indication of stroke risk in patients.',
                    },
                    3: {
                        name: 'Antropometri Kit',
                        date: '2024-10-09 2:05 PM',
                        description: 'Anthropometry Kit is a series of tools that function to detect stunting in children through measuring body weight, length and height as well as upper arm and head circumference.',
                    },
                    4: {
                        name: 'AMons',
                        date: '2024-10-09 3:05 PM',
                        description: 'AMons is a portable ECG device equipped with AI-based detection algorithms for near real-time detection and alerting of various arrhythmias, offering a solution for monitoring and timely intervention in heart conditions that may otherwise go undetected',
                    },
                };
    
                const product = catalogData[productId];
                document.getElementById('detailProductName').textContent = product.name;
                document.getElementById('detailProductDate').textContent = product.date;
                document.getElementById('detailProductDescription').textContent = product.description;
    
                detailModal.show();
            });
        });
    
        document.getElementById('createCatalogForm').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Catalog created!');
            bootstrap.Modal.getInstance(document.getElementById('createCatalogModal')).hide();
        });
    </script>
</body>

</html>
