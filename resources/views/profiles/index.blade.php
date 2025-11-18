@extends('template.main')

@section('title', 'Profile Kandidat')

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
                                    <a href="{{ route('profiles.create') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-plus"></i> Add Profile
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">

                                <table id="example1" class="table table-striped table-bordered table-hover text-center"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Kandidat</th>
                                            <th>Position</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->nama_kandidat }}</td>
                                                <td>{{ $row->position_kandidat }}</td>

                                                <td>
                                                    @if ($row->image)
                                                        <a href="{{ asset('storage/profile_images/' . $row->image) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/profile_images/' . $row->image) }}"
                                                                alt="Foto"
                                                                style="max-width: 80px; cursor: pointer; border-radius: 5px;">
                                                        </a>
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>

                                                <td>
                                                    <form class="d-inline" action="{{ route('profiles.edit', $row->id) }}"
                                                        method="GET">
                                                        <button type="submit" class="btn btn-success btn-sm mr-1">
                                                            <i class="fa-solid fa-pen"></i> Edit
                                                        </button>
                                                    </form>

                                                    <form class="d-inline" action="{{ route('profiles.destroy', $row->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus profile ini?')">
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
