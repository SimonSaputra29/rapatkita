<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undangan Rapat</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
        }
        .status {
            margin-top: 10px;
            font-size: 13px;
            font-weight: bold;
            color: white;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .approved {
            background-color: #28a745;
        }
        .rejected {
            background-color: #dc3545;
        }
        .pending {
            background-color: #ffc107;
            color: #212529;
        }
        .content {
            margin-top: 30px;
        }
        .content table {
            width: 100%;
            margin-top: 10px;
        }
        .content td {
            vertical-align: top;
            padding: 2px 5px;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .footer p {
            margin-bottom: 80px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">UNDANGAN RAPAT</div>
        <div>
            Nomor: {{ $permission->id ?? '-' }}/RAPAT/{{ \Carbon\Carbon::parse($permission->created_at ?? now())->format('m/Y') }}
        </div>

        {{-- Tambahkan status di sini --}}
        <div style="margin-top: 10px;">
            @if($permission->status == 'approved')
                <span class="status approved">Disetujui</span>
            @elseif($permission->status == 'rejected')
                <span class="status rejected">Ditolak</span>
            @else
                <span class="status pending">Menunggu Persetujuan</span>
            @endif
        </div>
    </div>

    <div class="content">
        <p>Kepada Yth:</p>
        <p><strong>{{ $permission->approver->name ?? '-' }}</strong><br>
        Email: {{ $permission->approver->email ?? '-' }}<br>
        Di Tempat</p>

        <p>Dengan hormat,</p>
        <p>Sehubungan dengan kegiatan koordinasi internal, kami mengundang Saudara/i untuk menghadiri rapat yang akan dilaksanakan pada:</p>

        <table>
            <tr>
                <td>Tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($permission->date ?? now())->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>: {{ $permission->time ?? '-' }} WIB</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>: {{ $permission->location ?? '-' }}</td>
            </tr>
            <tr>
                <td>Topik</td>
                <td>: {{ $permission->topic ?? '-' }}</td>
            </tr>
            <tr>
                <td>Partisipasi</td>
                <td>: {{ $permission->participants ?? '-' }}</td>
            </tr>
        </table>

        @if(!empty($permission->note))
        <p>Catatan:<br>{{ $permission->note }}</p>
        @endif

        <p>Demikian undangan ini kami sampaikan. Atas perhatian dan kehadirannya, kami ucapkan terima kasih.</p>
    </div>

    <div class="footer">
        <p>Hormat kami,</p>
        <p><strong>{{ $permission->approver->name ?? 'Panitia Rapat' }}</strong></p>
    </div>

</body>
</html>
