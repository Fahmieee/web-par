<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nopeg</th>
            <th>Pengemudi</th>
            <th>Tanggal</th>
            <th>Clockin</th>
            <th>Clockout</th>
            <th>In Km</th>
            <th>Out Km</th>
            <th>U.Kerja</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($clocks as $clock)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $clock->username }}</td>
            <td>{{ $clock->first_name }}</td>
            <td>{{ date('d/m/Y', strtotime($clock->date)) }}</td>
            <td>{{ $clock->clockin_time }}</td>
            <td>{{ $clock->clockout_time }}</td>
            <td>{{ $clock->clockin_km }}</td>
            <td>{{ $clock->clockout_km }}</td>
            <td>{{ $clock->unitkerja_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>