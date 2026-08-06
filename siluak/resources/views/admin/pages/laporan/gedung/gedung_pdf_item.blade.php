<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Kerusakan Gedung #{{ $laporan->id }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            margin: 0.5cm;
        }

        .header-table {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header-table td {
            vertical-align: middle;
            border: none !important;
        }

        .logo {
            width: 70px;
            height: auto;
        }

        .header-text {
            text-align: center;
            padding-right: 70px;
        }

        .header-text h2 {
            margin: 0;
            font-size: 16pt;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 0;
            font-size: 10pt;
            font-weight: bold;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 8px;
            vertical-align: top;
            border: 1px solid #000;
        }

        .label {
            font-weight: bold;
            width: 35%;
            background-color: #f0f0f0;
        }

        .box {
            border: 1px solid #000;
            padding: 15px;
            background: #fff;
            min-height: 120px;
            margin-top: 5px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }

        .signature-space {
            height: 70px;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td style="width: 80px;">
                @php
                    $path = public_path('assets/logo.png');
                    if (file_exists($path)) {
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    } else {
                        $base64 = null;
                    }
                @endphp
                @if ($base64)
                    <img src="{{ $base64 }}" class="logo">
                @endif
            </td>
            <td class="header-text">
                <h2>PEMERINTAH PROVINSI JAWA TENGAH</h2>
                <h2>DINAS KEARSIPAN DAN PERPUSTAKAAN</h2>
                <p>Jalan Dr. Setiabudi No. 201 C Semarang, Kode Pos 50263</p>
                <p>Telepon: (024) 7473746, Faksimile: (024) 7473800</p>
            </td>
        </tr>
    </table>

    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="text-decoration: underline; margin-bottom: 5px;">LAPORAN KERUSAKAN GEDUNG</h3>
        <p style="margin: 0;">Nomor Laporan: #BLD-{{ $laporan->id }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama Pelapor</td>
            <td>{{ $laporan->nama }}</td>
        </tr>
        <tr>
            <td class="label">Kontak / No. Telepon</td>
            <td>{{ $laporan->telepon }}</td>
        </tr>
        <tr>
            <td class="label">Unit Kerja / Bidang</td>
            <td>{{ $laporan->bidang }}</td>
        </tr>
        <tr>
            <td class="label">Gedung</td>
            <td>Gedung {{ $laporan->gedung }}</td>
        </tr>
        <tr>
            <td class="label">Lokasi Detail</td>
            <td>{{ $laporan->lokasi }}</td>
        </tr>
        <tr>
            <td class="label">Prioritas</td>
            <td>{{ $laporan->prioritas ?? 'Belum Diatur' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Laporan</td>
            <td>{{ $laporan->created_at->translatedFormat('d F Y, H:i') }} WIB</td>
        </tr>
        <tr>
            <td class="label">Status Saat Ini</td>
            <td><strong>{{ $laporan->status }}</strong></td>
        </tr>
    </table>

    <p style="font-weight: bold; margin-bottom: 5px;">Deskripsi Kerusakan:</p>
    <div class="box">
        {{ $laporan->deskripsi }}
    </div>

    <div class="footer">
        <p>Semarang, {{ date('d F Y') }}</p>
        <p>Admin Bagian Umum,</p>
        <div class="signature-space"></div>
        <p><strong>( __________________________ )</strong></p>
    </div>
</body>

</html>
