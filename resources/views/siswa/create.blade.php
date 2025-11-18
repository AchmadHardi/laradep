@extends('template.main')

@section('title', 'Add Siswa')

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
                            <h3 class="card-title">Add Siswa</h3>
                        </div>

                        <div class="card-body">

                            <form action="/siswa" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="lembaga_id">Lembaga</label>
                                    <select name="lembaga_id" id="lembaga_id" class="form-control" required>
                                        <option value="">-- Pilih Lembaga --</option>
                                        @foreach ($lembaga as $l)
                                            <option value="{{ $l->id }}">{{ $l->nama_lembaga }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis" required>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto (optional)</label>
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
