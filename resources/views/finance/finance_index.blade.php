@extends('layouts.admin')

@section('title', 'Data Keuangan')

@section('content')
<div x-data="{ openItem: null }" class="container-xxl flex-grow-1 container-p-y">

  {{-- Header Card & Buttons --}}
  <div class="card mb-5">
    <div class="card-header footer-container d-flex align-items-center justify-content-between flex-md-row flex-column">
      <div>
        <h3 class="mt-2"><strong>Data Keuangan</strong></h3>
        <p class="text-secondary" style="margin-top: -20px">Manage Data Keuangan</p>
      </div>
      <div class="d-none d-lg-inline-block">
        <button @click="openItem = (openItem === 'addIncome' ? null : 'addIncome')" type="button" class="btn btn-primary">
          <i class="menu-icon tf-icons bx bx-plus"></i>
          Tambah Transaksi
        </button>
      </div>
    </div>
  </div>

  {{-- Style Hover Table List  --}}
  <style>
      .table-hover tbody tr:hover {
          background-color: #fdfdfd;
      }
  </style>

  {{-- Cards Overviews --}}
  <div class="row">
    <div class="col-lg-3 col-md-3 col-3 mb-5">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="dropdown">
              <h5 style="margin-bottom: -2px; font-weight: bold">Saldo Sekarang</h5>
              <small class="text-secondary">Saldo per April 2025</small>
            </div>
            <div class="avatar flex-shrink-0">
              <img
                src="{{ asset('sneat-v3.0.0') }}/assets/img/icons/unicons/chart-success.png"
                alt="chart success"
                class="rounded"
                style="margin-top: 7px" />
            </div>
          </div>
          <h3 style="margin-bottom: 1px; font-weight: bold;">{{ formatToMillion($balance_now) }}</h3>
          <small class="text-secondary">{{ formatRupiah($balance_now) }}</small>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-3 mb-5">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="dropdown">
              <h5 style="margin-bottom: -2px; font-weight: bold">Pemasukan</h5>
              <small class="text-secondary">Pemasukan per April 2025</small>
            </div>
            <div class="avatar flex-shrink-0">
              <img
                src="{{ asset('sneat-v3.0.0') }}/assets/img/icons/unicons/wallet-info.png"
                alt="chart success"
                class="rounded"
                style="margin-top: 7px" />
            </div>
          </div>
          <h3 style="margin-bottom: 1px; font-weight: bold;">{{ formatToMillion($total_pemasukan) }}</h3>
          <small class="text-secondary">{{ formatRupiah($total_pemasukan) }}</small>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-3 mb-5">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="dropdown">
              <h5 style="margin-bottom: -2px; font-weight: bold">Pengeluaran</h5>
              <small class="text-secondary">Pengeluaran per April 2025</small>
            </div>
            <div class="avatar flex-shrink-0">
              <img src="{{ asset('sneat-v3.0.0') }}/assets/img/icons/unicons/paypal.png" alt="paypal" class="rounded" />
            </div>
          </div>
          <h3 style="margin-bottom: 1px; font-weight: bold;" class="text-danger">- {{ formatToMillion($total_pengeluaran) }}</h3>
          <small class="text-danger">- {{ formatRupiah($total_pengeluaran) }}</small>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-3 mb-5">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="dropdown">
              <h5 style="margin-bottom: -2px; font-weight: bold">Tabungan</h5>
              <small class="text-secondary">Jumlah tabungan hingga saat ini</small>
            </div>
            <div class="avatar flex-shrink-0">
              <img
                src="{{ asset('sneat-v3.0.0') }}/assets/img/icons/unicons/wallet-info.png"
                alt="chart success"
                class="rounded"
                style="margin-top: 7px" />
            </div>
          </div>
          <h3 style="margin-bottom: 1px; font-weight: bold;">Rp 0</h3>
          <small class="text-secondary">Rp 0</small>
        </div>
      </div>
    </div>
  </div>

  {{-- Popup Toast Actions Respon --}}
  @if (session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
          <div class="toast-body">
            {{ session('success') }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
  @elseif (session('error'))
    <div class="toast-container position-fixed bottom-0 end-0 p-5">
      <div id="liveToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
          <div class="toast-body">
            {{ session('error') }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>  
  @endif

  {{-- Form Add Income --}}
  <div class="col-xxl mb-5" x-show="openItem === 'addIncome'">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h4>Tambah Transaksi</h4>
      </div>
      <div class="card-body" style="margin-top: -20px">
        <form id="formAddIncome" action="{{ route('finance.store') }}" method="POST">
          @csrf
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Tanggal Proses</label>
            <div class="col-sm-10" >
              <div class="row g-2">
                  <div class="col-3">
                      <input class="form-control" id="tgl_proses" type="date" name="tanggal_proses"/>
                  </div>
                  <div class="col-3" style="margin-right: 5px">
                      <input type="text" id="wkt_proses" name="waktu" class="form-control" placeholder="HH:mm:ss" pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}">
                  </div>
                  <div class="col-3">
                      <a id="ambilWaktu" type="button" class="btn btn-primary text-white"><i class='icon-base bx bx-refresh'></i>Ambil Waktu Saat Ini</a>
                  </div>
              </div>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label">Detail Transaksi</label>
            <div class="col-sm-10">
              <div>
                <textarea
                  name="detail"
                  class="form-control auto-resize"
                  placeholder="Belanja, Token Listrik, Dll."
                  rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Pencatat</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="icon-base bx bx-user"></i></span>
                <select name="pencatat" class="form-control">
                  <option value="">Pilih Pencatat</option>
                  @foreach($users as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
              </div>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Jumlah Nominal</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="icon-base bx bx-money-withdraw"></i></span>
                <input
                  name="jumlah_rupiah"
                  type="text"
                  id="rupiahInput"
                  class="form-control"
                  placeholder="Rp. 0" />
              </div>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Tipe Transaksi</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="icon-base bx bx-category"></i></span>
                <select name="tipe_transaksi" class="form-control">
                    <option value="">Pilih Tipe Transaksi</option>
                    <option value="Pemasukan">Pemasukan</option>
                    <option value="Pengeluaran">Pengeluaran</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Kategori</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="icon-base bx bx-purchase-tag-alt"></i></span>
                <input list="tipeList" name="kategori_transaksi" class="form-control" placeholder="Ketik kategori..." />

                <datalist id="tipeList">
                    @foreach($kategoriTransaksi as $kategori)
                        <option value="{{ $kategori }}">
                    @endforeach
                </datalist>

              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary"  style="margin-right: 6px"><i class='bx bx-money-withdraw' ></i>&nbsp;&nbsp; Simpan Pemasukan</button>
              <button type="reset" class="btn btn-secondary"><i class='icon-base bx bx-eraser' ></i>&nbsp;&nbsp; Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="card">
    {{-- Table Data --}}
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <form action="{{ route('finance.index') }}" method="GET">
          @csrf
          <div class="mb-5">
            <input
              name="search"
              type="text"
              class="form-control"
              id="basic-icon-default-fullname"
              placeholder="Cari data keuangan"
              value="{{ request('search') }}" 
              onkeydown="if(event.key === 'Enter'){ this.form.submit(); }" />
          </div>
        </form>
        <table class="table table-bordered table-hover">
          <thead style="padding-top: 10px; padding-bottom: 10px;">
            <tr>
              <th style="padding-top: 10px; padding-bottom: 10px; text-align:center">#</th>
              <th style="padding-top: 10px; padding-bottom: 10px;">Tanggal</th>
              <th style="padding-top: 10px; padding-bottom: 10px; width: 60%">Detail Transaksi</th>
              <th style="padding-top: 10px; padding-bottom: 10px;">Pencatat</th>
              <th style="text-align: right; padding-top: 10px; padding-bottom: 10px;">Jumlah Nominal</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0" style="font-size: 13px">
            @forelse($finance as $item)
              <tr onclick="window.location='{{ route('finance.edit', $item->id) }}'" style="cursor: pointer;" class="hover:underline hover:text-blue-600">
                <td style="padding-top: 10px; padding-bottom: 10px; text-align: center;">
                  {{ $loop->iteration }}
                </td>
                <td style="padding-top: 10px; padding-bottom: 10px;">
                  {{ formatTanggal($item->tgl_proses) }}
                </td>
                <td style="padding-top: 10px; padding-bottom: 10px;">
                  <div style="display: flex; justify-content: space-between;">
                    <div>{{ $item->detail }} </div>
                    <div>
                      @if ($item->kategori === 'Pemasukan')
                        <span class="badge bg-label-primary">Pemasukan</span>
                      @else
                        <span class="badge bg-label-danger">Pengeluaran</span>
                      @endif
                      @if($item->sub_kategori)
                        <span class="badge bg-label-info">{{ $item->sub_kategori }}</span>
                      @endif
                    </div>
                  </div>
                </td>
                <td style="padding-top: 10px; padding-bottom: 10px;">
                  {{ $item->pencatat->name }}
                </td>
                <td style="text-align: right; padding-top: 10px; padding-bottom: 10px;" class="{{ $item->kategori === 'Pengeluaran' ? 'text-danger' : '' }}">
                  @if($item->kategori === 'Pemasukan')
                    Rp{{ formatRupiah($item->jumlah_rupiah) }}
                    @else
                    - Rp{{ formatRupiah($item->jumlah_rupiah) }}
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" style="text-align: center; padding-top: 10px; padding-bottom: 10px;">
                    <strong>Tidak ada data keuangan</strong>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection