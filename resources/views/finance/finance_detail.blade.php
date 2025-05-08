@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container-xxl container-p-y">
    <a href="{{ route('finance.index') }}" type="button" class="btn btn-primary btn-md mb-5"><i class='bx bx-arrow-back' ></i>&nbsp;&nbsp;Kembali</a>&nbsp;
    <button type="button" class="btn btn-light text-danger btn-md mb-5" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $finance->id }}"><i class='bx bxs-trash' ></i>&nbsp;&nbsp;Hapus Data </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal{{ $finance->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
            </div>

            <div class="modal-body">
            Apakah yakin ingin menghapus data <strong>{{ $finance->detail }}</strong>?
            </div>

            <div class="modal-footer">
            <form action="{{ route('finance.destroy', $finance->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </form>
            </div>

        </div>
        </div>
    </div>

    <form id="formUpdateFinance" action="{{ route('finance.update', $finance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-6 gy-6">
            <!-- Basic Layout -->
            <div class="col-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4>Detail Transaksi</h4>
                    </div>
                    {{-- @if ($errors->any())
                        <div class="bg-red-100 p-4 rounded">
                            <ul class="list-disc list-inside text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <div class="card-body" style="margin-top: -10px">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Waktu Proses</label>
                            <div class="col-9">
                                <div class="row g-2">
                                    <div class="col-5">
                                        <input class="form-control" id="tgl_proses" type="date" name="tanggal_proses" value="{{ \Illuminate\Support\Str::limit($finance->tgl_proses, 10, '') }}" />
                                    </div>
                                    <div class="col-5">
                                        <input type="text" id="wkt_proses" value="{{ \Carbon\Carbon::parse($finance->tgl_proses)->format('H:i:s') }}" name="waktu" class="form-control" placeholder="HH:mm:ss" pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}">
                                    </div>
                                    <div class="col-2">
                                        <a id="ambilWaktu" type="button" class="btn btn-primary text-white" style="width: 100%">
                                            Today
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Detail Transaksi</label>
                            <div class="col-sm-9">
                                <div>
                                    <textarea name="detail" class="form-control auto-resize" placeholder="Belanja, Token Listrik, Dll." rows="3">{{ $finance->detail }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-icon-default-email">Pencatat</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="icon-base bx bx-user"></i></span>
                                    <select name="pencatat" class="form-control">
                                        <option value="">Pilih Pencatat</option>
                                        @foreach($users as $item)
                                        <option value="{{ $item->id }}" {{ $finance->id_pencatat == $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-icon-default-email">Jumlah Nominal (Rp.)</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="icon-base bx bx-money-withdraw"></i></span>
                                    <input value="{{ formatRupiah($finance->jumlah_rupiah) }}" name="jumlah_rupiah" type="text" id="rupiahInput" class="form-control" placeholder="Rp. 0" />
                                </div>
                                    @if ($errors->has('jumlah_rupiah'))
                                        <div class="text-danger" style="font-size: 12px">{{ $errors->first('jumlah_rupiah') }}</div>
                                    @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-icon-default-email">Tipe Transaksi</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="icon-base bx bx-category"></i></span>
                                    <select name="tipe_transaksi" class="form-control">
                                        <option value="">Pilih Tipe Transaksi</option>
                                        <option value="Pemasukan" {{ $finance->id_kategori == 1 ? 'selected' : '' }}>Pemasukan</option>
                                        <option value="Pengeluaran" {{ $finance->id_kategori == 2 ? 'selected' : '' }}>Pengeluaran</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-icon-default-email">Kategori</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="icon-base bx bx-purchase-tag-alt"></i></span>

                                    <select name="kategori" id="tipeList" class="form-control">
                                        @foreach($kategoriTransaksi as $item)
                                        <option value="{{ $item }}" {{ $finance->sub_kategori == $item ? 'selected' : '' }}/>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end mb-4">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary" style="margin-right: 6px"><i class='bx bx-check'></i>&nbsp;&nbsp; Simpan Perubahan</button>
                                <button type="reset" class="btn btn-secondary"><i class='icon-base bx bx-undo'></i>&nbsp;&nbsp; Rollback</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic with Icons -->
            <div class="col-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Bukti Transaksi</h5>
                        <small class="text-body-secondary float-end">*) Capture / Screenshot</small>
                    </div>
                    <div class="card-body">
                        <img src="https://www.aputf.org/wp-content/uploads/2015/06/default-placeholder1-1024x1024-960x540.png" alt="Deskripsi Gambar" style="max-width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
