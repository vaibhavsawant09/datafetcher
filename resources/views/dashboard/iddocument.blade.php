@include('dashboard/header')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('dashboard/sider')

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>ID Documents</h4>

                    <!-- Basic Layout -->
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Upload Your IDs</h5>
                                    <small class="text-muted float-end"></small>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('upload.card') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Drag and Drop File Upload -->
                                        <div class="mb-3">
                                            <label class="form-label" for="file-upload">Upload Your Invoice (Drag and Drop)</label>
                                            <div id="drop-area" class="border p-3 text-center">
                                                <p id="drop-text" class="text-muted">Drag and drop a file here, or click to select one.</p>
                                                <input type="file" id="file-upload" name="image" class="d-none" required />
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Optional: Add the required JavaScript -->
                <script>
                    // Get the file input element and the drop area
                    const fileInput = document.getElementById('file-upload');
                    const dropArea = document.getElementById('drop-area');
                    const dropText = document.getElementById('drop-text');

                    // Prevent default behavior of drag and drop
                    dropArea.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        dropArea.classList.add('border-success'); // Add a success border when file is dragged over
                        dropText.textContent = 'Release to upload the file';
                    });

                    dropArea.addEventListener('dragleave', () => {
                        dropArea.classList.remove('border-success');
                        dropText.textContent = 'Drag and drop a file here, or click to select one.';
                    });

                    dropArea.addEventListener('drop', (e) => {
                        e.preventDefault();
                        const file = e.dataTransfer.files[0]; // Get the file dropped
                        if (file) {
                            // Set the input file to the dropped file
                            fileInput.files = e.dataTransfer.files;
                            dropText.textContent = `File: ${file.name}`;
                        }
                        dropArea.classList.remove('border-success');
                    });

                    // Trigger file input when drop area is clicked
                    dropArea.addEventListener('click', () => {
                        fileInput.click();
                    });

                    // Handle file selection from input
                    fileInput.addEventListener('change', () => {
                        const selectedFile = fileInput.files[0];
                        if (selectedFile) {
                            dropText.textContent = `File: ${selectedFile.name}`;
                        }
                    });
                </script>



                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('dashboard/script')