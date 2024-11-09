@extends('layouts.app')

@section('title')
    <title>Edit Trash Bin</title>
@endsection

@section('content')
    <section class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Trash Bin</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('trash_bins.update', $trashBin->bin_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $trashBin->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" name="location" class="form-control" id="location" value="{{ $trashBin->location }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="qr_code" class="form-label">QR Code</label>
                            @if($trashBin->qr_code_path)
                                        <div class="qr-code" width="5px">
                                            {!! Storage::get($trashBin->qr_code_path) !!}
                                        </div>
                                    @endif
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select" id="status" required>
                                <option value="active" {{ $trashBin->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ $trashBin->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="{{ route('trash_bins.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
