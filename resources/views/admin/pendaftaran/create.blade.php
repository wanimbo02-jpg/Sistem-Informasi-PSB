@extends('admin.layouts.app')

@section('title', 'Tambah Pendaftaran Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Pendaftaran Siswa</h3>
                </div>
                <!-- /.card-header -->

                <form action="{{ route('admin.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Data Pribadi -->
                        <h4>Data Pribadi Siswa</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                           value="{{ old('nama_lengkap') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Panggilan</label>
                                    <input type="text" name="nama_panggilan" class="form-control"
                                           value="{{ old('nama_panggilan') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" class="form-control"
                                           value="{{ old('tempat_lahir') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                           value="{{ old('tanggal_lahir') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Agama <span class="text-danger">*</span></label>
                                    <select name="agama" class="form-control" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kewarganegaraan</label>
                                    <input type="text" name="kewarganegaraan" class="form-control"
                                           value="{{ old('kewarganegaraan', 'WNI') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Anak Ke</label>
                                    <input type="number" name="anak_ke" class="form-control"
                                           value="{{ old('anak_ke') }}" min="1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jumlah Saudara</label>
                                    <input type="number" name="jumlah_saudara" class="form-control"
                                           value="{{ old('jumlah_saudara') }}" min="0">
                                </div>
                            </div>
                        </div>

                        <!-- Data Alamat -->
                        <h4 class="mt-4">Data Alamat</h4>
                        <hr>
                        <div class="form-group">
                            <label>Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" name="rt" class="form-control" value="{{ old('rt') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" name="rw" class="form-control" value="{{ old('rw') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kelurahan <span class="text-danger">*</span></label>
                                    <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kota <span class="text-danger">*</span></label>
                                    <input type="text" name="kota" class="form-control" value="{{ old('kota') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <h4 class="mt-4">Data Orang Tua</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Data Ayah</h5>
                                <div class="form-group">
                                    <label>Nama Ayah <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Pendidikan Ayah</label>
                                    <select name="pendidikan_ayah" class="form-control">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D1">D1</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah') }}">
                                </div>
                                <div class="form-group">
                                    <label>Penghasilan Ayah</label>
                                    <select name="penghasilan_ayah" class="form-control">
                                        <option value="">Pilih Penghasilan</option>
                                        <option value="< 1.000.000">< Rp 1.000.000</option>
                                        <option value="1.000.000 - 3.000.000">Rp 1.000.000 - 3.000.000</option>
                                        <option value="3.000.000 - 5.000.000">Rp 3.000.000 - 5.000.000</option>
                                        <option value="5.000.000 - 10.000.000">Rp 5.000.000 - 10.000.000</option>
                                        <option value="> 10.000.000">> Rp 10.000.000</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No HP Ayah</label>
                                    <input type="text" name="no_hp_ayah" class="form-control" value="{{ old('no_hp_ayah') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5>Data Ibu</h5>
                                <div class="form-group">
                                    <label>Nama Ibu <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Pendidikan Ibu</label>
                                    <select name="pendidikan_ibu" class="form-control">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D1">D1</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu') }}">
                                </div>
                                <div class="form-group">
                                    <label>Penghasilan Ibu</label>
                                    <select name="penghasilan_ibu" class="form-control">
                                        <option value="">Pilih Penghasilan</option>
                                        <option value="< 1.000.000">< Rp 1.000.000</option>
                                        <option value="1.000.000 - 3.000.000">Rp 1.000.000 - 3.000.000</option>
                                        <option value="3.000.000 - 5.000.000">Rp 3.000.000 - 5.000.000</option>
                                        <option value="5.000.000 - 10.000.000">Rp 5.000.000 - 10.000.000</option>
                                        <option value="> 10.000.000">> Rp 10.000.000</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No HP Ibu</label>
                                    <input type="text" name="no_hp_ibu" class="form-control" value="{{ old('no_hp_ibu') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Data Akademik -->
                        <h4 class="mt-4">Data Akademik</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NPSN Sekolah</label>
                                    <input type="text" name="npsn_sekolah" class="form-control" value="{{ old('npsn_sekolah') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tahun Lulus</label>
                                    <input type="text" name="tahun_lulus" class="form-control" value="{{ old('tahun_lulus') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nilai Akhir</label>
                                    <input type="number" step="0.01" name="nilai_akhir" class="form-control" value="{{ old('nilai_akhir') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Ijazah</label>
                                    <input type="text" name="no_ijazah" class="form-control" value="{{ old('no_ijazah') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No SKHUN</label>
                                    <input type="text" name="no_skhun" class="form-control" value="{{ old('no_skhun') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Upload Files -->
                        <h4 class="mt-4">Upload Dokumen</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto Siswa</label>
                                    <input type="file" name="foto_siswa" class="form-control-file" accept="image/*">
                                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Akte Kelahiran</label>
                                    <input type="file" name="akte_kelahiran" class="form-control-file" accept=".pdf,image/*">
                                    <small class="text-muted">Format: PDF/JPG/PNG, Maks: 5MB</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kartu Keluarga</label>
                                    <input type="file" name="kartu_keluarga" class="form-control-file" accept=".pdf,image/*">
                                    <small class="text-muted">Format: PDF/JPG/PNG, Maks: 5MB</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ijazah</label>
                                    <input type="file" name="ijazah" class="form-control-file" accept=".pdf,image/*">
                                    <small class="text-muted">Format: PDF/JPG/PNG, Maks: 5MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
