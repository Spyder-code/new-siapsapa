<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nik</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir (dd/mm/yyyy)</th>
        <th>Alamat</th>
        <th>Agama</th>
        <th>Email</th>
        <th>Kontak</th>
        <th>Jenis Kelamin (L atau P)</th>
        <th>Golongan Darah</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nik }}'</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->tempat_lahir }}</td>
            <td>{{ date('d/m/Y', strtotime($item->tgl_lahir)) }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->agama }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->nohp }}</td>
            <td>{{ $item->jk }}</td>
            <td>{{ $item->gol_darah }}</td>
            <td>{{ $item->keterangan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
