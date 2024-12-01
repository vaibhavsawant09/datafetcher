@include('dashboard/header')

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Sidebar -->
            @include('dashboard/sider')

            <!-- Main Content Section -->
            <div class="main-content flex-grow-1 p-3">

                <!-- Current Plan Card -->
                <div class="card mb-4">
                    <h5 class="card-header">Current Plan</h5>
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column - Plan Details -->
                            <div class="col-lg-6 col-12 mb-4">
                                <div class="mb-4">
                                    <h6 class="mb-1">Your Current Plan is Basic</h6>
                                    <p>A simple start for everyone</p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-1">Active until Dec 09, 2021</h6>
                                    <p>We will send you a notification upon Subscription expiration</p>
                                </div>
                                <div>
                                    <h6 class="mb-1">
                                        <span class="me-1">$199 Per Month</span>
                                        <span class="badge bg-label-primary">Popular</span>
                                    </h6>
                                    <p class="mb-1">Standard plan for small to medium businesses</p>
                                </div>
                            </div>

                            <!-- Right Column - Alert and Progress -->
                            <div class="col-lg-6 col-12 mb-4">
                                <!-- Alert Section -->
                                <div class="alert alert-warning mb-4" role="alert">
                                    <h5 class="alert-heading mb-1 d-flex align-items-center">
                                        <span class="alert-icon rounded-circle">
                                            <i class="bx bx-error bx-md"></i>
                                        </span>
                                        <span>We need your attention!</span>
                                    </h5>
                                    <span class="ms-3 ps-1">Your plan requires an update</span>
                                </div>

                                <!-- Plan Statistics -->
                                <div class="plan-statistics">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Days</h6>
                                        <h6 class="mb-1">12 of 30 Days</h6>
                                    </div>
                                    <div class="progress rounded mb-1">
                                        <div class="progress-bar w-25 rounded" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>18 days remaining until your plan requires an update</small>
                                </div>
                            </div>

                            <!-- Buttons Section -->
                            <div class="col-12 d-flex gap-2 flex-wrap">
                                <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#pricingModal">Upgrade Plan</button>
                                <button class="btn btn-label-danger cancel-subscription">Cancel Subscription</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subscription History Table -->
                <div class="card">
                    <h5 class="card-header">Subscription History</h5>
                    <div class="card-body">
                        <!-- Make the table responsive by adding .table-responsive -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Plan</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Basic</td>
                                        <td>$199</td>
                                        <td>Active</td>
                                        <td>
                                            <button class="btn btn-info btn-sm">Details</button>
                                            <button class="btn btn-success btn-sm">Renew</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Pro</td>
                                        <td>$299</td>
                                        <td>Inactive</td>
                                        <td>
                                            <button class="btn btn-info btn-sm">Details</button>
                                            <button class="btn btn-success btn-sm">Renew</button>
                                        </td>
                                    </tr>
                                    <!-- Add more rows as necessary -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- End of main-content -->

        </div> <!-- End of layout-container -->
    </div> <!-- End of layout-wrapper -->

    @include('dashboard/script')

</body>