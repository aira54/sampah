@extends('layouts.app')

@section('content')
    <h1>Tambah Transaksi</h1>

    <form action="{{ route('transaksis.store') }}" method="POST">
        @csrf
        <div>
            <label for="bin_id">Bin</label>
            <select name="bin_id" required>
                <option value="">Pilih Bin</option>
                @foreach ($trashBins as $bin)
                    <option value="{{ $bin->bin_id }}">{{ $bin->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="category_id">Kategori Sampah</label>
            <select name="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach ($wasteCategories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="items">Items (kg)</label>
            <input type="number" step="0" name="items" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection
