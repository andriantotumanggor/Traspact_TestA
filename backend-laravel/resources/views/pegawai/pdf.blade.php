<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pegawai</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #eee; }
        .text-center { text-align: center; }
        h2 { text-align: center; margin-bottom: 5px; }
    </style>
</head>
<body>
    <h2>Daftar Pegawai</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Alamat</th>
                <th>Tgl Lahir</th>
                <th>L/P</th>
                <th>Gol</th>
                <th>Eselon</th>
                <th>Jabatan</th>
                <th>Tempat Tugas</th>
                <th>Agama</th>
                <th>Unit Kerja</th>
                <th>No. HP</th>
                <th>NPWP</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawai as $index => $p)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $p->nip }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->tempat_lahir }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->tgl_lahir }}</td>
                <td class="text-center">{{ $p->jk }}</td>
                <td>{{ $p->golongan?->nama }}</td>
                <td>{{ $p->eselon?->nama ?? '-' }}</td>
                <td>{{ $p->jabatan?->nama }}</td>
{{ $p->tempat_tugas?->nama }}
                <td>{{ $p->agama ?? '-' }}</td>
{{ $p->unit_kerja?->nama }}
                <td>{{ $p->no_hp ?? '-' }}</td>
                <td>{{ $p->npwp ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="15" class="text-center">Tidak ada data pegawai</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

