<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nopeg</th>
            <th>Pengemudi</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Suhu</th>
            <th>Tekanan Darah</th>
            <th>Unit Kerja</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($dcus as $dcu)

    @php
    if($dcu->hasil == '3'){
        $status = 'UNFIT';
    } else {
        $status = 'FIT';
    }

    @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $dcu->username }}</td>
            <td>{{ $dcu->first_name }}</td>
            <td>{{ date('d/m/Y', strtotime($dcu->date)) }}</td>
            <td>{{ $dcu->time }}</td>
            <td>{{ $dcu->suhu }} C</td>
            <td>{{ $dcu->darah }} mmAh</td>
            <td>{{ $dcu->unitkerja_name }}</td>
            <td>{{ $status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>