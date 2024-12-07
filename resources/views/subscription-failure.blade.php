<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Include custom styles if needed -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-header {
            background-color: #dc3545;
            /* Red background for failure */
        }

        .btn-warning {
            background-color: #ffc107;
            /* Yellow background for button */
            border: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center py-5">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card text-center shadow-lg">
                    <!-- Card Header -->
                    <div class="card-header text-white">
                        <h5 class="mb-0">Payment Failed</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <h4 class="card-title text-danger mb-4">Oops! Something went wrong.</h4>
                        <p class="card-text">We were unable to process your payment. Please try again later or contact support for assistance.</p>
                        <!-- Back To Pricing Button -->
                        <a href="{{ url('pricing') }}" class="btn btn-warning mt-3 px-4 py-2">Back To Pricing</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>