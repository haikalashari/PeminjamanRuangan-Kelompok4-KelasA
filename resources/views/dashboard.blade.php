@extends('layouts.layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            @foreach($data as $item)
              <div class="col-xl-4 col-md-6">
                  <div class="card info-card {{ $item['icon'] == 'bi-cart' ? 'sales-card' : ($item['icon'] == 'bi-shop' ? 'revenue-card' : 'customers-card') }}">
                      <div class="card-body">
                          <h5 class="card-title">{{ $item['title'] }}</h5>

                          <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi {{ $item['icon'] }}"></i>
                              </div>
                              <div class="ps-3">
                                  <h6>{{ $item['value'] }}</h6>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            @endforeach
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>

              <div class="activity">
                @foreach($ruanganLimaTerbaru as $item)
                <div class="activity-item d-flex justify-content-center">
                  <div class="activite-label">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    <a href="{{ route('ruangan.show', $item) }}" class="fw-bold text-dark">{{ $item->nama }}</a> telah dipinjam
                  </div>
                </div><!-- End activity item-->
                @endforeach
              </div>

            </div>
          </div><!-- End Recent Activity -->

          <!-- Website Traffic -->
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Ketersediaan Ruangan<span>| Today</span></h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Access From',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [
                        @foreach($arrayStatusRuangan as $value)
                        {
                          value: {{ $value['value'] }},
                          name: "{{ $value['title'] }}"
                        },
                        @endforeach
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Website Traffic -->
        </div><!-- End Right side columns -->
      </div>
      <div class="row">
        <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        const dates = @json($dates);
                        const students = @json($students);
                        const admins = @json($admins);
                        const rooms = @json($rooms);

                        new ApexCharts(document.querySelector("#reportsChart"), {
                          series: [{
                            name: 'Students',
                            data: students,
                          }, {
                            name: 'Admins',
                            data: admins,
                          }, {
                            name: 'Rooms',
                            data: rooms,
                          }],
                          chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                              show: false
                            },
                          },
                          markers: {
                            size: 4
                          },
                          colors: ['#4154f1', '#2eca6a', '#ff771d'],
                          fill: {
                            type: "gradient",
                            gradient: {
                              shadeIntensity: 1,
                              opacityFrom: 0.3,
                              opacityTo: 0.4,
                              stops: [0, 90, 100]
                            }
                          },
                          dataLabels: {
                            enabled: false
                          },
                          stroke: {
                            curve: 'smooth',
                            width: 2
                          },
                          xaxis: {
                            type: 'datetime',
                            categories: dates,
                          },
                          tooltip: {
                            x: {
                              format: 'dd/MM/yy'
                            },
                          }
                        }).render();
                      });
                  </script>

                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Peminjaman Terbaru <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">Nama Ruangan</th>
                        <th scope="col">Waktu Mulai</th>
                        <th scope="col">Waktu Selesai</th>
                        <th scope="col">Tujuan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($peminjamanLimaTerbaru as $item)
                      <tr>
                        <th scope="row"><a href="{{ route('peminjaman.show', $item) }}">{{ $item->id }}</a></th>
                        <td>{{ $item->mahasiswa->user->name }}</td>
                        <td>{{ $item->ruangan->nama }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai }}</td>
                        <td>{{ $item->tujuan }}</td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Ruangan Yang Paling Banyak dipinjam</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kapasitas</th>
                        <th scope="col">Jumlah Peminjaman</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($ruanganPalingBanyakDipinjam as $item)
                      @if($item->peminjaman_count == 0)
                      @continue
                      @endif
                      <tr>
                        <th scope="row"><a href="{{ route('ruangan.show', $item) }}">{{ $item->id }}</a></th>
                        <td><a href="#" class="text-primary fw-bold">{{ $item->nama }}</a></td>
                        <td>{{ $item->kapasitas }}</td>
                        <td class="fw-bold">{{ $item->peminjaman_count }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->
      </div>
    </section>
@endsection