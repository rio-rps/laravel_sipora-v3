@extends('private.layout.main')

@section('isi')

    <style>
        /* ================================
           DASHBOARD STATISTIK
        ================================= */

        .dashboard-stats {
            margin-bottom: 25px;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            min-height: 125px;
            color: #fff;
            margin-bottom: 15px;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            right: -35px;
            bottom: -45px;
        }

        .stat-card .card-body {
            position: relative;
            z-index: 2;
            padding: 22px;
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            background: rgba(255, 255, 255, 0.18);
            margin-right: 15px;
        }

        .stat-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .stat-primary {
            background: linear-gradient(135deg, #4e73df, #224abe);
        }

        .stat-warning {
            background: linear-gradient(135deg, #f6c23e, #dda20a);
        }

        .stat-success {
            background: linear-gradient(135deg, #1cc88a, #13855c);
        }

        .stat-danger {
            background: linear-gradient(135deg, #e74a3b, #be2617);
        }


        /* ================================
           ACTIVITY CARD
        ================================= */

        .activity-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .activity-header {
            background: linear-gradient(135deg, #343a40, #1f2327);
            color: #fff;
            padding: 18px 22px;
        }

        .activity-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .activity-header small {
            color: rgba(255, 255, 255, 0.7);
        }

        .activity-table {
            margin-bottom: 0;
        }

        .activity-table thead th {
            background: #f8f9fc;
            border-top: none;
            color: #6c757d;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .activity-table tbody tr {
            transition: 0.2s;
        }

        .activity-table tbody tr:hover {
            background-color: #f8f9fc;
        }

        .activity-number {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e9ecef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #495057;
        }

        .activity-date {
            color: #6c757d;
            font-size: 12px;
        }

        .activity-log {
            font-weight: 500;
            color: #343a40;
        }

        .activity-footer {
            background: #fff5f5;
            color: #dc3545;
            padding: 12px 20px;
            font-size: 12px;
            font-weight: 500;
            border-top: 1px solid #f5c6cb;
        }


        /* ================================
           BIODATA INFORMATION
        ================================= */

        .profile-warning-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .profile-warning-header {
            background: linear-gradient(135deg, #343a40, #212529);
            padding: 20px 25px;
            color: #fff;
        }

        .profile-warning-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .profile-warning-body {
            padding: 30px;
        }

        .warning-box {
            border-left: 5px solid #dc3545;
            background: #fff5f5;
            border-radius: 10px;
            padding: 25px;
        }

        .warning-icon {
            font-size: 45px;
            color: #dc3545;
            margin-bottom: 15px;
        }

        .btn-complete-profile {
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.25);
        }


        /* ================================
           RESPONSIVE MOBILE
        ================================= */

        @media (max-width: 768px) {

            .stat-card {
                min-height: 110px;
            }

            .stat-value {
                font-size: 17px;
            }

            .stat-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
            }

            .profile-warning-body {
                padding: 20px;
            }

        }
    </style>


    @if ($session == true)
        <div class="row dashboard-stats">

            <!-- DIKIRIM -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">

                <div class="card stat-card stat-primary shadow">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="stat-icon">
                                <i class="fa fa-paper-plane"></i>
                            </div>

                            <div>

                                <div class="stat-title">
                                    Permohonan
                                </div>

                                <div class="stat-value">
                                    {{ format_rupiah($dikirim) }}
                                </div>

                                <small>
                                    Permohonan Dikirim
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- DIPROSES -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">

                <div class="card stat-card stat-warning shadow">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="stat-icon">
                                <i class="fa fa-spinner"></i>
                            </div>

                            <div>

                                <div class="stat-title">
                                    Permohonan
                                </div>

                                <div class="stat-value">
                                    {{ format_rupiah($diproses) }}
                                </div>

                                <small>
                                    Sedang Diproses
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- DITERIMA -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">

                <div class="card stat-card stat-success shadow">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="stat-icon">
                                <i class="fa fa-check-circle"></i>
                            </div>

                            <div>

                                <div class="stat-title">
                                    Permohonan
                                </div>

                                <div class="stat-value">
                                    {{ format_rupiah($diterima) }}
                                </div>

                                <small>
                                    Permohonan Diterima
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- DITOLAK -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">

                <div class="card stat-card stat-danger shadow">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="stat-icon">
                                <i class="fa fa-times-circle"></i>
                            </div>

                            <div>

                                <div class="stat-title">
                                    Permohonan
                                </div>

                                <div class="stat-value">
                                    {{ format_rupiah($ditolak) }}
                                </div>

                                <small>
                                    Permohonan Ditolak
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ================================
             LOG ACTIVITY
        ================================= -->

        <div class="row">

            <div class="col-md-12">

                <div class="card activity-card">

                    <div class="activity-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5>
                                    <i class="fa fa-history mr-2"></i>
                                    Log Activity
                                </h5>

                                <small>
                                    Riwayat aktivitas terbaru Anda
                                </small>

                            </div>

                            <i class="fa fa-list-alt fa-2x"></i>

                        </div>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table activity-table">

                                <thead>

                                    <tr>

                                        <th class="text-center" width="8%">
                                            No
                                        </th>

                                        <th width="25%">
                                            Tanggal
                                        </th>

                                        <th>
                                            Aktivitas
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse ($Log as $LogAss)
                                        <tr>

                                            <td class="text-center">

                                                <span class="activity-number">

                                                    {{ $loop->iteration }}

                                                </span>

                                            </td>


                                            <td>

                                                <span class="activity-date">

                                                    <i class="fa fa-calendar mr-1"></i>

                                                    {{ cek_date_ddmmyyyy_his_v1($LogAss->created_at) }}

                                                </span>

                                            </td>


                                            <td>

                                                <span class="activity-log">

                                                    {{ $LogAss->aktivitas }}

                                                </span>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="3" class="text-center text-muted p-4">

                                                <i class="fa fa-info-circle mr-2"></i>

                                                Belum ada aktivitas.

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>


                    <div class="activity-footer">

                        <i class="fa fa-info-circle mr-1"></i>

                        Hanya menampilkan 10 aktivitas terakhir.

                    </div>

                </div>

            </div>

        </div>
    @elseif ($session == false)
        <!-- ================================
             BIODATA BELUM LENGKAP
        ================================= -->

        <div class="content-body">

            <div class="card profile-warning-card">

                <div class="profile-warning-header">

                    <h4>

                        <i class="fa fa-info-circle mr-2 text-warning"></i>

                        INFORMASI

                    </h4>

                </div>


                <div class="profile-warning-body">

                    <div class="warning-box text-center">

                        <div class="warning-icon">

                            <i class="fa fa-exclamation-triangle"></i>

                        </div>


                        <h4 class="text-danger font-weight-bold">

                            PENTING!

                        </h4>


                        <p class="text-muted mt-3">

                            Silakan lengkapi biodata Anda terlebih dahulu agar dapat
                            menggunakan seluruh fitur dan menu yang tersedia pada sistem.

                        </p>


                        <a href="{{ route('biodata.index') }}" class="btn btn-primary btn-complete-profile mt-2">

                            <i class="fa fa-user-edit mr-2"></i>

                            Lengkapi Biodata

                        </a>

                    </div>

                </div>

            </div>

        </div>
    @endif

@endsection
