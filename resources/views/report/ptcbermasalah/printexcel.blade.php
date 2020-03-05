<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nopeg</th>
            <th>Pengemudi</th>
            <th>Unit</th>
            <th>Tanggal</th>
            <th>U.Kerja</th>
            <th>Bagian</th>
            <th>Detail</th>
            <th>Kondisi</th>
            <th>Level</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($ptcsalahs as $ptcsalah)

    @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $ptcsalah->username }}</td>
            <td>{{ $ptcsalah->first_name }}</td>
            <td>{{ $ptcsalah->no_police }}</td>
            <td>{{ date('d/m/Y', strtotime($ptcsalah->date)) }}</td>
            <td>{{ $ptcsalah->unitkerja_name }}</td>
            <td>{{ $ptcsalah->type_name }}</td>
            <td>{{ $ptcsalah->detail_name }}</td>
            <td>{{ $ptcsalah->parameter }}</td>
            <td>{{ $ptcsalah->level }}</td>
        </tr>
    @endforeach
    </tbody>
</table>