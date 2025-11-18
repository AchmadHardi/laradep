@extends('template.main')

@section('title', 'Edit Siswa')

@section('content')

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div>

                <div class="col-sm-6">@extends('template.main')

@section('title', 'Edit Profile')

@section('content')

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Profile</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nama_kandidat">Nama Kandidat</label>
                                    <input type="text" class="form-control" id="nama_kandidat"
                                           name="nama_kandidat" value="{{ old('nama_kandidat', $profile->nama_kandidat) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="position_kandidat">Position Kandidat</label>
                                    <input type="text" class="form-control" id="position_kandidat"
                                           name="position_kandidat" value="{{ old('position_kandidat', $profile->position_kandidat) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="image">Image (optional)</label>

                                    @if ($profile->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/profile_images/' . $profile->image) }}"
                                                 alt="Profile Image" style="width: 100px; border-radius: 5px;">
                                        </div>
                                    @endif

                                    <input type="file" class="form-control" id="image" name="image">
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('profiles.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/siswa">Siswa</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Edit Siswa</h3>
                        </div>

                        <div class="card-body">

                            <form action="/siswa/{{ $siswa->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="lembaga_id">Lembaga</label>
                                    <select name="lembaga_id" id="lembaga_id" class="form-control" required>
                                        @foreach ($lembaga as $l)
                                            <option value="{{ $l->id }}"
                                                {{ $l->id == $siswa->lembaga_id ? 'selected' : '' }}>
                                                {{ $l->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" id="nis"
                                           name="nis" value="{{ old('nis', $siswa->nis) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama"
                                           name="nama" value="{{ old('nama', $siswa->nama) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email"
                                           name="email" value="{{ old('email', $siswa->email) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto (optional)</label>

                                    @if ($siswa->foto)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/foto_siswa/' . $siswa->foto) }}"
                                                 alt="" style="width: 100px;">
                                        </div>
                                    @endif

                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="/siswa" class="btn btn-secondary">Cancel</a>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
