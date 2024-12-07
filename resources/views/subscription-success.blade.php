@include('dashboard/header')

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('dashboard/sider')

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4">Payment Status</h4>

                <!-- Success Card -->
                <div class="card text-center">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Payment Successful</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-success">Thank you for your payment!</h4>
                        <p class="card-text">Your subscription has been successfully activated.</p>

                        <p><strong>Amount Paid:</strong> ₹{{ $amount }}</p>
                        <p><strong>Activation Date:</strong> {{ $activation_date->format('Y-m-d') }}</p>
                        <p><strong>End Date:</strong> {{ $end_date->format('Y-m-d') }}</p>

                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    </div>
                </div>
            </div>

            @include('dashboard/script')
        </div>
    </div>
</body>