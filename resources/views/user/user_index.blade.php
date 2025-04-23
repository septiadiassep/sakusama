@extends('layouts.admin')

@section('title', 'Data User')

@section('content')
<div x-data="{ openadd: false, openedit: false }" class="container-xxl flex-grow-1 container-p-y">

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

  <div class="col-xxl mb-5" x-show="openadd">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Data User</h5>
        <a @click="openadd = !openadd" style="font-style: italic; cursor: pointer; color: red">Batalkan tambah user</a>
      </div>
      <div class="card-body">
        <form action="{{ route('user.store') }}" method="POST">
          @csrf
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama User</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-fullname2" class="input-group-text"
                  ><i class="icon-base bx bx-user"></i
                ></span>
                <input
                  name="name"
                  type="text"
                  class="form-control"
                  id="basic-icon-default-fullname"
                  placeholder="Arif Rahman"
                  aria-label="Arif Rahman"
                  aria-describedby="basic-icon-default-fullname2" />
              </div>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Password</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-company2" class="input-group-text"
                  ><i class="icon-base bx bx-key"></i
                ></span>
                <input
                  name="password"
                  type="password"
                  id="basic-icon-default-company"
                  class="form-control"
                  placeholder="123456"
                  aria-label="123456"
                  aria-describedby="basic-icon-default-company2" />
              </div>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="icon-base bx bx-envelope"></i></span>
                <input
                  name="email"
                  type="text"
                  id="basic-icon-default-email"
                  class="form-control"
                  placeholder="fitria.dewi"
                  aria-label="fitria.dewi"
                  aria-describedby="basic-icon-default-email2" />
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary"><i class='bx bxs-save' ></i>&nbsp;&nbsp; Simpan Data</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header footer-container d-flex align-items-center justify-content-between flex-md-row flex-column">
            <div>
              <h3 class="mt-4"><strong>Data User</strong></h3>
              <p class="text-secondary" style="margin-top: -20px">Manage Data User</p>
            </div>
            <div class="d-none d-lg-inline-block">
              <button @click="openadd = !openadd" type="button" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                </svg>&nbsp;&nbsp;
                Tambah User
              </button>
            </div>
        </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <form action="{{ route('user.index') }}" method="GET">
          @csrf
          <div class="mb-5">
            <input
              name="search"
              type="text"
              class="form-control"
              id="basic-icon-default-fullname"
              placeholder="Ketikan pencarian data user"
              value="{{ request('search') }}" 
              onkeydown="if(event.key === 'Enter'){ this.form.submit(); }" />
          </div>
        </form>
        <table class="table table-striped">
          <thead style="padding-top: 10px; padding-bottom: 10px;">
            <tr>
              <th style="padding-top: 10px; padding-bottom: 10px; text-align:center">No</th>
              <th style="padding-top: 10px; padding-bottom: 10px;">Nama User</th>
              <th style="padding-top: 10px; padding-bottom: 10px;">Password</th>
              <th style="padding-top: 10px; padding-bottom: 10px;">Email</th>
              <th style="padding-top: 10px; padding-bottom: 10px;">Created at</th>
              <th style="text-align: right; padding-top: 10px; padding-bottom: 10px;">Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($users as $user)
            <tr>
              <td style="padding-top: 10px; padding-bottom: 10px; text-align: center;">
                {{ $loop->iteration }}
              </td>
              <td style="padding-top: 10px; padding-bottom: 10px;">
                {{ $user->name }}
              </td>
              <td style="padding-top: 10px; padding-bottom: 10px;">
                {{ Str::limit($user->password, 10) }}
              </td>
              <td style="padding-top: 10px; padding-bottom: 10px;">
                {{ $user->email }}{!! $user->email_verified_at != null 
                                                                ? ' <span class="badge text-bg-primary">verified</span>' 
                                                                : ' <span class="badge text-bg-light">not verified</span>' !!}
              </td>
              <td style="padding-top: 10px; padding-bottom: 10px;">
                {{ $user->created_at }}
              </td>
              <td style="text-align: right; vertical-align: right; padding-top: 10px; padding-bottom: 10px;">
                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $user->id }}"><i class='bx bxs-trash' ></i></button>
                <a href="{{ route('user.edit', $user->id) }}" type="button" class="btn btn-warning btn-md"><i class='bx bxs-edit-alt' ></i></a>

                <!-- Modal -->
                <div class="modal fade" id="confirmDeleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                      </div>

                      <div class="modal-body">
                        Apakah yakin ingin menghapus data <strong>{{ $user->name }}</strong>?
                      </div>

                      <div class="modal-footer">
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" style="text-align: center;">
                Data tidak ditemukan
              </td>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
</div>
@endsection