@extends('template.main')

@section('title', 'Add Lembaga')

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
                        <li class="breadcrumb-item"><a href="/lembaga">Lembaga</a></li>
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
                            <h3 class="card-title">Add Lembaga</h3>
                        </div>

                        <div class="card-body">

                            <form action="/lembaga" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_lembaga">Nama Lembaga</label>
                                    <input type="text" class="form-control" id="nama_lembaga"
                                           name="nama_lembaga" required maxlength="255">
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="/lembaga" class="btn btn-secondary">Cancel</a>
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
