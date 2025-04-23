@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-xxl mb-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Ubah Data User</h5>
            </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
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
                    value="{{ $user->name }}"
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
                    placeholder="Isi jika ingin mengganti password"
                    aria-label="Isi jika ingin mengganti password"
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
                    value="{{ $user->email }}"
                    aria-describedby="basic-icon-default-email2" />
                </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" style="margin-right: 10px"><i class='bx bxs-save'></i>&nbsp;&nbsp; Simpan Perubahan</button>
                <a href="{{ route('user.index') }}"class="btn btn-secondary"><i class='bx bx-arrow-back'></i>&nbsp;&nbsp; Batalkan</a>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection