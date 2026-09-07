@extends('private.layout.main')
@section('isi')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card border-0 shadow-sm">

                    {{-- ================================
                         HEADER
                    ================================= --}}
                    <div class="card-header border-0 py-3 text-white" style="background-color: rgba(108, 117, 125, 0.8);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="mr-3"
                                    style="
                                        width: 45px;
                                        height: 45px;
                                        border-radius: 10px;
                                        background: rgba(255, 255, 255, 0.2);
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                    ">
                                    <i class="fa fa-wrench text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 font-weight-bold text-white">
                                        Maintenance Sistem
                                    </h5>
                                    <small class="text-white-50">
                                        Pengaturan status pemeliharaan aplikasi
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- ================================
                         BODY
                    ================================= --}}
                    <div class="card-body">

                        {{-- Success --}}
                        @if (session('success'))
                            <div class="alert alert-success">

                                <i class="fa fa-check-circle mr-1"></i>

                                {{ session('success') }}

                            </div>
                        @endif


                        {{-- Error --}}
                        @if (session('error'))
                            <div class="alert alert-danger">

                                <i class="fa fa-exclamation-circle mr-1"></i>

                                {{ session('error') }}

                            </div>
                        @endif


                        {{-- Validation --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">

                                <ul class="mb-0 pl-3">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>
                        @endif


                        <form action="{{ route('maintenance.update') }}" method="POST">

                            @csrf


                            {{-- ================================
                                 STATUS
                            ================================= --}}
                            <div class="form-group mb-4">

                                <label class="font-weight-bold">
                                    Status Maintenance
                                </label>

                                {{-- Penting:
                                     Checkbox tidak mengirim nilai
                                     jika tidak dicentang.
                                     Hidden ini memastikan nilai 0 terkirim.
                                --}}
                                <input type="hidden" name="status" value="0">

                                <div class="custom-control custom-switch">

                                    <input type="checkbox" class="custom-control-input" id="status" name="status"
                                        value="1" {{ $maintenance->status ? 'checked' : '' }}>

                                    <label class="custom-control-label" for="status">

                                        <strong>
                                            Aktifkan Maintenance
                                        </strong>

                                    </label>

                                </div>

                                <small class="form-text text-muted">

                                    Jika aktif, pengguna umum tidak dapat
                                    mengakses aplikasi dan akan melihat halaman
                                    maintenance.

                                </small>

                            </div>


                            <hr>


                            {{-- ================================
                                 JUDUL
                            ================================= --}}
                            <div class="form-group">

                                <label for="judul" class="font-weight-bold">

                                    Judul Maintenance

                                </label>

                                <input type="text" name="judul" id="judul" class="form-control"
                                    value="{{ old('judul', $maintenance->judul) }}" placeholder="Sistem Dalam Pemeliharaan">

                            </div>


                            {{-- ================================
                                 PESAN
                            ================================= --}}
                            <div class="form-group">

                                <label for="pesan" class="font-weight-bold">

                                    Pesan Maintenance

                                </label>

                                <textarea name="pesan" id="pesan" rows="4" class="form-control"
                                    placeholder="Masukkan pesan untuk pengguna...">{{ old('pesan', $maintenance->pesan) }}</textarea>

                                <small class="form-text text-muted">

                                    Pesan ini akan ditampilkan pada halaman
                                    maintenance kepada pengguna.

                                </small>

                            </div>


                            {{-- ================================
                                 BUTTON
                            ================================= --}}
                            <div class="d-flex justify-content-end">

                                <button type="submit" class="btn btn-primary px-4">

                                    <i class="fa fa-save mr-1"></i>

                                    Simpan Pengaturan

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
