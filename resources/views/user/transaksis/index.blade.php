@extends('layouts.app')

@section('content')
    <h1>Daftar Transaksi</h1>
    <a href="{{ route('transaksis.create') }}">Tambah Transaksi</a>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>User</th>
                <th>Bin</th>
                <th>Kategori</th>
                <th>Items (kg)</th>
                <th>Total Amount</th>
                <th>Deposit Date</th>
                <th>Status Verifikasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->transaksi_id }}</td>
                    <td>{{ $transaksi->user->name }}</td>
                    <td>{{ $transaksi->trashBin->name }}</td>
                    <td>{{ $transaksi->wasteCategory->name }}</td>
                    <td>{{ $transaksi->items }}</td>
                    <td>{{ $transaksi->total_amount }}</td>
                    <td>{{ $transaksi->deposit_date }}</td>
                    <td>{{ $transaksi->verified ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <form action="{{ route('transaksis.destroy', $transaksi->transaksi_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
