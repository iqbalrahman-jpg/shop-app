<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h1 class="text-center">Toko Alat Kesehatan</h1>
    <h2 class="text-center">Laporan Belanja Anda</h2>
    <p>User ID: {{ $user->id }}</p>
    <p>Nama: {{ $user->username }}</p>
    <p>Alamat: {{ $user->address }}</p>
    <p>No HP: {{ $user->contact }}</p>
    <p>Tanggal: {{ $order->created_at->format('d-m-Y') }}</p>
    <p>ID Paypal: {{ $user->paypal_id }}</p>
    <p>Nama Bank: {{ $user->bank_name }}</p>
    <p>Cara Bayar: (Prepaid/Postpaid)</p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk dengan IDnya</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->product->name }} ({{ $item->product->id }})</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ format_price($item->product->price) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total belanja (termasuk pajak): {{ format_price($order->total_price) }}</h3>

    <div class="text-right">
        <p>TANDATANGAN TOKO</p>
    </div>
</body>
</html>
