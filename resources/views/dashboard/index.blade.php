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
          <div class="row">
            <div class="col-lg-8 mb-4 order-0">
              <div class="card">
                <div class="d-flex align-items-end row">
                  <div class="col-sm-7">
                    <div class="card-body">
                      <h5 class="card-title text-warning">Congratulations {{ Auth::user()->name }}! 🎉</h5>
                      <p class="mb-4">
                        Automate data extraction with <span class="fw-bold">AI-powered</span> document parser
                      </p>
                      <a href="javascript:;" class="btn btn-sm btn-outline-warning">Explore Tools</a>
                    </div>
                  </div>
                  <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                      <img src="{{url('assets/img/illustrations/man-with-laptop-light.png')}}" height="140"
                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
              <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                          <img src="{{url('assets/img/icons/unicons/chart-success.png')}}" alt="chart success"
                            class="rounded" />
                        </div>
                        <div class="dropdown">
                          <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                          </div>
                        </div>
                      </div>
                      <span class="fw-semibold d-block mb-1">Save Money</span>
                      <h3 class="card-title mb-2">12,628</h3>
                      <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                          <img src="{{url('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card"
                            class="rounded" />
                        </div>
                        <div class="dropdown">
                          <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                          </div>
                        </div>
                      </div>
                      <span>Conversion Rate</span>
                      <h3 class="card-title text-nowrap mb-1">4,679</h3>
                      <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
              <div class="card">
                <div class="row row-bordered g-0">
                  <div class="col-md-8">
                    <h5 class="card-header m-0 me-2 pb-3">Total Growth</h5>
                    <div id="totalRevenueChart" class="px-2"></div>
                  </div>
                  <div class="col-md-4">
                    <div class="card-body">
                      <div class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-sm btn-outline-warning dropdown-toggle" type="button"
                            id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            2022
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                            <a class="dropdown-item" href="javascript:void(0);">2024</a>
                            <a class="dropdown-item" href="javascript:void(0);">2023</a>
                            <a class="dropdown-item" href="javascript:void(0);">2022</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="growthChart"></div>
                    <div class="text-center fw-semibold pt-3 mb-2">62% Total Growth</div>

                    <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                      <div class="d-flex">
                        <div class="me-2">
                          <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                          <small>2022</small>
                          <h6 class="mb-0">32.5</h6>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div class="me-2">
                          <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                          <small>2021</small>
                          <h6 class="mb-0">41.2</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
              <div class="row">
                <div class="col-6 mb-4">
                </div>
                <!-- </div>
    <div class="row"> -->
                <div class="col-12 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                          <div class="card-title">
                            <h5 class="text-nowrap mb-2">Profile Report</h5>
                            <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                          </div>
                          <div class="mt-sm-auto">
                            <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i>
                              68.2%</small>
                            <h3 class="mb-0">84,686</h3>
                          </div>
                        </div>
                        <div id="profileReportChart"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- / Content -->

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