@extends('layouts.app')

@section('title')
    Tambah Trash Bin
@endsection

@section('content')
    <section class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Trash Bin</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('trash_bins.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Trash Bin" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" name="location" class="form-control" id="location" placeholder="Lokasi Trash Bin" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select" id="status" required>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
