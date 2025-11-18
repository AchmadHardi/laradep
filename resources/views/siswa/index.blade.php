@extends('template.main')

@section('title', 'Siswa')

@section('content')

    <div class="content-wrapper">

        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Content Header -->


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">
                                <div class="text-right">
                                    <a href="/siswa/export" class="btn btn-success">
                                        <i class="fa-solid fa-file-excel"></i> Export Excel
                                    </a>
                                    <a href="/siswa/create" class="btn btn-primary">
                                        <i class="fa-solid fa-plus"></i> Add Siswa
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">

                                <table id="example1" class="table table-striped table-bordered table-hover text-center"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Lembaga</th>
                                            <th>Foto</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($siswa as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->nis }}</td>
                                                <td>{{ $row->nama }}</td>
                                                <td>{{ $row->email }}</td>

                                                <td>
                                                    {{ $row->lembaga->nama_lembaga ?? '-' }}
                                                </td>

                                                <td>
                                                    @if ($row->foto)
                                                        <a href="{{ asset('storage/foto_siswa/' . $row->foto) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/foto_siswa/' . $row->foto) }}"
                                                                alt="Foto"
                                                                style="max-width: 80px; cursor: pointer; border-radius: 5px;">
                                                        </a>
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>


                                                <td>
                                                    <form class="d-inline" action="/siswa/{{ $row->id }}/edit"
                                                        method="GET">
                                                        <button type="submit" class="btn btn-success btn-sm mr-1">
                                                            <i class="fa-solid fa-pen"></i> Edit
                                                        </button>
                                                    </form>

                                                    <form class="d-inline" action="/siswa/{{ $row->id }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            id="btn-delete">
                                                            <i class="fa-solid fa-trash-can"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
<script>
    $(document).ready(function () {
        $('#example1').DataTable({
            responsive: true,
            autoWidth: false
        });
    });
</script>
