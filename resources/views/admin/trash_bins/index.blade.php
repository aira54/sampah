@extends('layouts.app')

@section('title')
    Manajemen Trash Bin
@endsection

@section('styles')
    <style>
        /* Styles */
    </style>
@endsection

@section('content')
    <section class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Daftar Trash Bin</h5>
                        <a class="btn btn-primary" href="{{ route('trash_bins.create') }}">Tambah Data</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table id="datatable-standard" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>QR Code</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarTrashBin as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->location }}</td>
                                    <td>@if($row->qr_code_path)
                                        <div class="qr-code" width="5px">
                                            {!! Storage::get($row->qr_code_path) !!}
                                        </div>
                                    @endif
                                    
                                    </td>
                                    <td>{{ $row->status }}</td>
                                    <td>
                                        <form action="{{ route('trash_bins.destroy', $row->bin_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('trash_bins.edit', $row->bin_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
