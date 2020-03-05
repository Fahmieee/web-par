<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nopeg</th>
            <th>Pengemudi</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Unit</th>
            <th>U.Kerja</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($ptcus as $ptcu)

    @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $ptcu->username }}</td>
            <td>{{ $ptcu->first_name }}</td>
            <td>{{ date('d/m/Y', strtotime($ptcu->date)) }}</td>
            <td>{{ $ptcu->time }}</td>
            <td>{{ $ptcu->no_police }}</td>
            <td>{{ $ptcu->unitkerja_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>