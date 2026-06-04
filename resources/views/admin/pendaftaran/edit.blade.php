@extends('admin.layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pendaftaran</h1>
        <div>
            <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="btn btn-sm btn-info">
                <i class="bi bi-eye"></i> Detail
            </a>
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Pendaftaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nomor Pendaftaran</label>
                            <input type="text" class="form-control" value="{{ $pendaftaran->no_pendaftaran }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" value="{{ $pendaftaran->user->name }}" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                                <select name="jurusan" id="jurusan" class="form-select @error('jurusan') is-invalid @enderror" required>
                                    <option value="IPA" {{ $pendaftaran->jurusan == 'IPA' ? 'selected' : '' }}>IPA</option>
                                    <option value="IPS" {{ $pendaftaran->jurusan == 'IPS' ? 'selected' : '' }}>IPS</option>
                                    <option value="Bahasa" {{ $pendaftaran->jurusan == 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                                </select>
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gelombang" class="form-label">Gelombang <span class="text-danger">*</span></label>
                                <select name="gelombang" id="gelombang" class="form-select @error('gelombang') is-invalid @enderror" required>
                                    <option value="1" {{ $pendaftaran->gelombang == '1' ? 'selected' : '' }}>Gelombang 1</option>
                                    <option value="2" {{ $pendaftaran->gelombang == '2' ? 'selected' : '' }}>Gelombang 2</option>
                                    <option value="3" {{ $pendaftaran->gelombang == '3' ? 'selected' : '' }}>Gelombang 3</option>
                                </select>
                                @error('gelombang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nilai_un" class="form-label">Nilai UN</label>
                                <input type="number" step="0.01" min="0" max="100"
                                       class="form-control @error('nilai_un') is-invalid @enderror"
                                       id="nilai_un" name="nilai_un" value="{{ old('nilai_un', $pendaftaran->nilai_un) }}">
                                @error('nilai_un')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nilai_rapor" class="form-label">Nilai Rapor</label>
                                <input type="number" step="0.01" min="0" max="100"
                                       class="form-control @error('nilai_rapor') is-invalid @enderror"
                                       id="nilai_rapor" name="nilai_rapor" value="{{ old('nilai_rapor', $pendaftaran->nilai_rapor) }}">
                                @error('nilai_rapor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3" class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan', $pendaftaran->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Saat Ini</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td>Status Berkas</td>
                            <td>:</td>
                            <td>{!! $pendaftaran->status_berkas_badge !!}</td>
                        </tr>
                        <tr>
                            <td>Status Verifikasi</td>
                            <td>:</td>
                            <td>{!! $pendaftaran->status_verifikasi_badge !!}</td>
                        </tr>
                        <tr>
                            <td>Status Seleksi</td>
                            <td>:</td>
                            <td>{!! $pendaftaran->status_seleksi_badge !!}</td>
                        </tr>
                    </table>

                    @if($pendaftaran->catatan)
                    <div class="alert alert-warning mt-3">
                        <strong>Catatan:</strong>
                        <p class="mb-0 small">{{ $pendaftaran->catatan }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
