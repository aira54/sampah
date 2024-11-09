@extends('layouts.app')

@section('title')
    Edit Waste Categories
@endsection

@section('content')
    <section class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Waste Categories</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('waste_categories.update', $wasteCategory->category_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name', $wasteCategory->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <input type="text" name="description" class="form-control" id="description"
                                value="{{ old('description', $wasteCategory->description) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="price_per_kg" class="form-label">Harga per Kg</label>
                            <input type="number" step="0.01" name="price_per_kg" class="form-control" id="price_per_kg"
                                value="{{ old('price_per_kg', $wasteCategory->price_per_kg) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select" id="status" required>
                                <option value="active" {{ $wasteCategory->status == 'active' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="inactive" {{ $wasteCategory->status == 'inactive' ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
