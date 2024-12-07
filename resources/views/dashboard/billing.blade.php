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
                                @if ($subscription)
                                <div class="mb-4">
                                    <h6 class="mb-1">Your Current Plan is {{ $subscription->name }}</h6>
                                    <p>{{ $subscription->description }}</p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-1">Active until {{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }}</h6>
                                    <p>We will send you a notification upon Subscription expiration</p>
                                </div>
                                @else
                                <p>No subscriptions found.</p>
                                @endif
                            </div>


                            <!-- Right Column - Alert and Progress -->
                            <div class="col-lg-6 col-12 mb-4">
                                <!-- Alert Section -->
                                @if ($remainingDays <= 7)
                                    <div class="alert alert-warning mb-4" role="alert">
                                    <h5 class="alert-heading mb-1 d-flex align-items-center">
                                        <span class="alert-icon rounded-circle">
                                            <i class="bx bx-error bx-md"></i>
                                        </span>
                                        <span>We need your attention!</span>
                                    </h5>
                                    <span class="ms-3 ps-1">Your plan expires in {{ $remainingDays }} days</span>
                            </div>
                            @endif

                            <!-- Plan Statistics -->
                            <div class="plan-statistics">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">Days</h6>
                                    <h6 class="mb-1">{{ $remainingDays }} of 30 Days</h6>
                                </div>
                                <div class="progress rounded mb-1">
                                    <div class="progress-bar w-{{ intval(($remainingDays / 30) * 100) }} rounded" role="progressbar" aria-valuenow="{{ intval(($remainingDays / 30) * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small>{{ $remainingDays }} days remaining until your plan requires an update</small>
                            </div>
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
                                @forelse ($user->subscriptions as $index => $sub)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sub->name ?? 'N/A' }}</td> <!-- Assuming you have a relation 'plan' for plan name -->
                                    <td>{{ $sub->amount }} INR</td>
                                    <td>{{ \Carbon\Carbon::parse($sub->end_date)->isFuture() ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm">Details</button>
                                        @if (!\Carbon\Carbon::parse($sub->end_date)->isFuture())
                                        <button class="btn btn-success btn-sm">Renew</button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No subscription history found</td>
                                </tr>
                                @endforelse
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