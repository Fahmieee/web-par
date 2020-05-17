<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Merk</th>
            <th>Tahun</th>
            <th>No Police</th>
            <th>Total KM</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($units as $unit)

            @php
            $totals = DB::table('driving')
            ->leftJoin("clocks", "clocks.id", "=", "driving.clock_id")
            ->where('driving.unit_id', '=', $unit->id)
            ->whereBetween('clockin_date', [$awal, $akhir])
            ->get();

            $grandtotal = 0;
            foreach($totals as $total){

                if($total->km_akhir == null){

                    $akhirs = $total->km_awal;

                } else {

                    $akhirs = $total->km_akhir;

                }

                $totalnya = $akhirs - $total->km_awal;

                $grandtotal += $totalnya;

            }


            @endphp

            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $unit->merk }} {{ $unit->model }}</td>
                <td>{{ $unit->years }}</td>
                <td>{{ $unit->no_police }}</td>
                <td>{{ $grandtotal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>