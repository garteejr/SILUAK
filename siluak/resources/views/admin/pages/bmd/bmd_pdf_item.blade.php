<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Pengajuan BMD #{{ $bmd->id }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
            line-height: 1.4;
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
            font-size: 14pt;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 0;
            font-size: 9pt;
            font-weight: bold;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 6px 8px;
            vertical-align: top;
            border: 1px solid #000;
        }

        .label {
            font-weight: bold;
            width: 30%;
            background-color: #f0f0f0;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .item-table th, .item-table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .item-table th {
            background-color: #f0f0f0;
            text-align: center;
            font-size: 10pt;
        }

        .box {
            border: 1px solid #000;
            padding: 10px;
            min-height: 60px;
            margin-bottom: 20px;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .footer td {
            width: 50%;
            text-align: center;
        }

        .signature-space {
            height: 60px;
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

    <div style="text-align: center; margin-bottom: 15px;">
        <h3 style="text-decoration: underline; margin-bottom: 5px; text-transform: uppercase;">FORM PENGADAAN BARANG MILIK DAERAH (BMD)</h3>
        <p style="margin: 0;">Nomor: #BMD-{{ $bmd->id }}/{{ date('Y') }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama Pemohon</td>
            <td>{{ $bmd->nama }}</td>
        </tr>
        <tr>
            <td class="label">Unit Kerja / Bidang</td>
            <td>{{ $bmd->bidang }}</td>
        </tr>
        <tr>
            <td class="label">Kode</td>
            <td style="font-family: monospace;">{{ $bmd->kode }}</td>
        </tr>
        <tr>
            <td class="label">Program</td>
            <td>{{ $bmd->program }}</td>
        </tr>
        <tr>
            <td class="label">Kegiatan</td>
            <td>{{ $bmd->kegiatan }}</td>
        </tr>
        <tr>
            <td class="label">Output</td>
            <td><strong>{{ $bmd->output }}</strong></td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>{{ $bmd->status }}</td>
        </tr>
    </table>

    <p style="font-weight: bold; margin-bottom: 5px;">Daftar Barang yang Diajukan:</p>
    <table class="item-table">
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 60%;">Nama Barang</th>
                <th style="width: 15%;">Jumlah</th>
                <th style="width: 15%;">Satuan</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $items = is_array($bmd->items) ? $bmd->items : json_decode($bmd->items, true);
            @endphp
            @if(is_array($items))
                @foreach($items as $index => $item)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $item['nama_barang'] ?? '-' }}</td>
                        <td style="text-align: center;">{{ $item['jumlah'] ?? 0 }}</td>
                        <td style="text-align: center;">{{ $item['satuan'] ?? 'Unit' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <p style="font-weight: bold; margin-bottom: 5px;">Keterangan / Alasan Pengajuan:</p>
    <div class="box">
        {{ $bmd->keterangan }}
    </div>

    @if($bmd->catatan_admin)
    <p style="font-weight: bold; margin-bottom: 5px;">Catatan Admin:</p>
    <div class="box" style="font-style: normal; background-color: #f9f9f9;">
        {{ $bmd->catatan_admin }}
    </div>
    @endif

    <table class="footer">
        <tr>
            <td>
                <p>Mengetahui,</p>
                <p>Pemohon</p>
                <div class="signature-space"></div>
                <p><strong>( {{ $bmd->nama }} )</strong></p>
            </td>
            <td>
                <p>Semarang, {{ date('d F Y') }}</p>
                <p>Kepala Bagian Umum,</p>
                <div class="signature-space"></div>
                <p><strong>( __________________________ )</strong></p>
            </td>
        </tr>
    </table>
</body>
</html>