@include('dashboard/header')

<body>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        /* Apply blur effect to the table */
        .blurred {
            filter: blur(8px);
            pointer-events: none;
            /* Disable interactions */
        }
    </style>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('dashboard/sider')

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>File Management</h4>

                <!-- Table Layout -->
                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Uploaded Files</h5>
                                <small class="text-muted float-end">Manage your uploaded files</small>
                            </div>
                            <div class="container mt-5">
                                <div class="card-body">
                                    <!-- Make the table responsive by adding .table-responsive -->
                                    <div class="table-responsive blurred" id="data-table">
                                        <!-- Table -->
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th>ID</th>
                                                    <th>Type</th>
                                                    <th>Data</th>
                                                    <th>Share</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>PDF</td>
                                                    <td>2024-11-27</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info">Share</button>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-success" download="business_card.pdf">Download</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Image</td>
                                                    <td>2024-11-26</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info">Share</button>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-success" download="profile_image.jpg">Download</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Word Document</td>
                                                    <td>2024-11-25</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info">Share</button>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-success" download="resume.docx">Download</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- End of .table-responsive -->
                                </div>
                            </div>

                            <!-- Upgrade Modal -->
                            <div class="modal fade" id="upgradeModal" tabindex="-1" aria-labelledby="upgradeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="upgradeModalLabel">Upgrade Required</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            To access your data, please upgrade your plan.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Upgrade Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Include Bootstrap Bundle with Popper -->
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                            <script>
                                // Show the modal when the page loads
                                document.addEventListener('DOMContentLoaded', () => {
                                    const upgradeModal = new bootstrap.Modal(document.getElementById('upgradeModal'));
                                    upgradeModal.show();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optional: Add CSS for improved table styling -->
            <style>
                /* Card Styling */
                .card {
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }

                /* Header Styling */
                .card-header {
                    background-color: #f8f9fa;
                    font-size: 1.25rem;
                }

                /* Table Styling */
                .table {
                    border-radius: 10px;
                    overflow: hidden;
                    margin-top: 20px;
                }

                .table th,
                .table td {
                    text-align: center;
                    vertical-align: middle;
                }

                /* Highlighted row (on hover) */
                .table tbody tr:hover {
                    background-color: #f1f1f1;
                    cursor: pointer;
                }

                /* Button Styling */
                .btn-sm {
                    padding: 5px 10px;
                    font-size: 0.875rem;
                }

                .btn-info {
                    background-color: #17a2b8;
                    border-color: #17a2b8;
                }

                .btn-info:hover {
                    background-color: #138496;
                    border-color: #117a8b;
                }

                .btn-success {
                    background-color: #28a745;
                    border-color: #28a745;
                }

                .btn-success:hover {
                    background-color: #218838;
                    border-color: #1e7e34;
                }

                /* Add spacing between buttons and table cells */
                .btn {
                    margin: 0 5px;
                }
            </style>

            @include('dashboard/script')

        </div> <!-- End of layout-container -->
    </div> <!-- End of layout-wrapper -->

</body>