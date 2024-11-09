@extends('layouts.app')

@section('title')
    Manajemen Waste Categories
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
                        <h5 class="card-title mb-0">Daftar Waste Categories</h5>
                        <a class="btn btn-primary" href="{{ route('waste_categories.create') }}">Tambah Data</a>
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
                                <th>Deskripsi</th>
                                <th>Harga per Kg</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wasteCategories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->price_per_kg }}</td>
                                    <td>{{ $category->status }}</td>

                                    <td>
                                        <form action="{{ route('waste_categories.destroy', $category->category_id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('waste_categories.edit', $category->category_id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
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
