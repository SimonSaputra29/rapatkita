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
            border-bottom: 2px solid #080808FF;
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
            margin-bottom: 5px;
        }

        .status {
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-block;
            font-size: 14px;
            margin-top: 5px;
            color: white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .approved {
            background: linear-gradient(45deg, #28a745, #218838);
        }

        .rejected {
            background: linear-gradient(45deg, #dc3545, #c82333);
        }

        .pending {
            background: linear-gradient(45deg, #ffc107, #e0a800);
            color: #212529;
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
    <div class="kop-surat" style="text-align: center; margin-bottom: 20px;">
    <table style="width: 100%; border-bottom: 2px solid black; padding-bottom: 10px;">
        <tr>
            <td style="width: 100px; text-align: left;">
                @if ($base64Logo)
                    <img src="{{ $base64Logo }}" alt="Logo Kantor" style="height: 80px;">
                @else
                    <div style="width: 80px; height: 80px; background-color: #eee;"></div>
                @endif
            </td>
            <td style="text-align: center;">
                <div style="font-size: 18px; font-weight: bold; text-transform: uppercase;">
                    {{ $company['name'] ?? 'SMK Wikrama 1 Garut' }}
                </div>
                <div style="font-size: 14px; margin-top: 4px;">
                    {{ $company['address'] ?? 'Jalan Otista Kp. Tanjung RT.003 RW.013 Ds. Pasawahan Kec. Tarogong Kaler Kabupaten Garut (0262)' }}
                </div>
                <div style="font-size: 13px; margin-top: 4px;">
                    Telp: {{ $company['phone'] ?? '2802880' }} |
                    Email: {{ $company['email'] ?? 'smkwikrama1garut.sch.id' }} |
                    Website: {{ $company['website'] ?? 'https://smkwikrama1garut.sch.id' }}
                </div>
            </td>
        </tr>
    </table>
</div>



    {{-- <div class="header">
        <!-- Logo kantor, sesuaikan path gambar -->
        <img src="{{ asset('images/logo_kantor.png') }}" alt="Logo Kantor">
        <div class="title">UNDANGAN RAPAT</div>
        

        <div>
            @if ($permission->status == 'approved')
                <span class="status approved">Disetujui</span>
            @elseif($permission->status == 'rejected')
                <span class="status rejected">Ditolak</span>
            @else
                <span class="status pending">Menunggu Persetujuan</span>
            @endif
        </div>
    </div> --}}

    <div class="content">
        <div class="number">
            Nomor :
            {{ $permission->id ?? '-' }}/RAPAT/{{ \Carbon\Carbon::parse($permission->created_at ?? now())->format('m/Y') }}
        </div>
        <div class="div">Lampiran : -</div>
        <div class="div">Hal : Undangan Rapat</div>



        <p>Kepada Yth:</p>
        <p><strong>{{ $permission->approver->name ?? '-' }}</strong><br>
            Email: {{ $permission->approver->email ?? '-' }}<br>
            Di Tempat</p>

        <p>Dengan hormat,</p>
        <p>Sehubungan dengan kegiatan koordinasi internal, kami mengundang Saudara/i untuk menghadiri rapat yang akan
            dilaksanakan pada:</p>

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

        <p>Demikian undangan ini kami sampaikan. Atas perhatian dan kehadirannya, kami ucapkan terima kasih.</p>
    </div>

    <div class="footer">
        <p>Hormat kami,</p>
        <p><strong>{{ $permission->approver->name ?? 'Panitia Rapat' }}</strong></p>
    </div>

</body>
