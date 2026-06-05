<!DOCTYPE html>
<html>
<head>
    <title>Octa Salon Income Report</title>
    <style>
        border { border: 1px solid #000; }
    </style>
</head>
<body>
    <h2>OCTA SALON INCOME REPORT</h2>
    <p>Periode Laporan: {{ date('d M Y', strtotime($startDate)) }} s/d {{ date('d M Y', strtotime($endDate)) }}</p>
    <p>Filter Tipe: {{ strtoupper($type) }}</p>
    <br>
    
    <table border="1" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <th style="padding: 8px;">No</th>
                <th style="padding: 8px;">Customer Name</th>
                <th style="padding: 8px;">Transaction Type</th>
                <th style="padding: 8px;">Payment Date/Time</th>
                <th style="padding: 8px;">Total Price</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($transactions as $trx)
                <tr>
                    <td style="text-align: center; padding: 5px;">{{ $no++ }}</td>
                    <td style="padding: 5px;">
                        @if(!empty($trx->customer_name) && $trx->customer_name !== 'Pelanggan Reservasi')
                            {{ $trx->customer_name }}
                        @elseif($trx->reservation && $trx->reservation->user)
                            {{ $trx->reservation->user->nama }}
                        @else
                            {{ $trx->customer_name ?? 'Regular Customer' }}
                        @endif
                    </td>
                    <td style="text-align: center; padding: 5px;">{{ $trx->id_reservation ? 'App Reservation' : 'Walk-In' }}</td>
                    <td style="padding: 5px;">{{ $trx->created_at->format('d M Y, H:i') }} WIB</td>
                    <td style="text-align: right; padding: 5px;">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr style="font-weight: bold; background-color: #e6e6e6;">
                <td colspan="4" style="text-align: right; padding: 8px;">GRAND TOTAL REVENUE:</td>
                <td style="text-align: right; padding: 8px;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>