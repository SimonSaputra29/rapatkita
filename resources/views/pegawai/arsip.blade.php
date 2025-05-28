<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Undangan Rapat</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            font-size: 13px;
            line-height: 1.7;
            color: #333;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
        }

        .header img {
            max-height: 60px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 20px;
            font-weight: 700;
            text-decoration: underline;
            color: rgba(0, 0, 0, 0.733);
            margin-bottom: 5px;
        }

        .number {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .status {
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-block;
            font-size: 14px;
            margin-top: 5px;
            background: #6c757d;
            color: white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .content {
            margin-top: 40px;
        }

        .content p {
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        td {
            padding: 8px 6px;
            vertical-align: top;
        }

        td:first-child {
            font-weight: 600;
            width: 120px;
            color: #555;
        }

        .footer {
            margin-top: 80px;
            text-align: right;
            font-style: italic;
            color: #555;
        }

        .footer strong {
            font-weight: 700;
            color: #222;
            font-style: normal;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ asset('images/logo_kantor.png') }}" alt="Logo Kantor">
        <div class="title">UNDANGAN RAPAT</div>
        <div class="number">
            Nomor: {{ $permission->id ?? '-' }}/RAPAT/{{ \Carbon\Carbon::parse($permission->created_at ?? now())->format('m/Y') }}
        </div>
        {{-- <div>
            <span class="status">Draf / Arsip</span>
        </div> --}}
    </div>

    <div class="content">
        <p>Kepada Yth:</p>
        <p><strong>{{ $permission->approver->name ?? '-' }}</strong><br>
            Email: {{ $permission->approver->email ?? '-' }}<br>
            Di Tempat</p>

        <p>Dengan hormat,</p>
        <p>Berikut adalah rancangan undangan rapat yang disimpan sebagai arsip atau draft. Undangan ini belum disetujui secara resmi.</p>

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

        @if (!empty($permission->note))
            <p>Catatan:<br>{{ $permission->note }}</p>
        @endif

        <p>Harap tinjau kembali data undangan ini sebelum menyetujui dan mengirimkan kepada peserta.</p>
    </div>

    <div class="footer">
        <p>Disusun oleh:</p>
        <p><strong>{{ $permission->user->name ?? 'Panitia Rapat' }}</strong></p>
    </div>

</body>
</html>
