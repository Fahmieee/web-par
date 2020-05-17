<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nopeg</th>
            <th>Pengemudi</th>
            <th>Unit Kerja</th>
            <th>Total Kerja</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($clocks as $clock)

        @php
        $totals = DB::table('clocks')
        ->where('user_id', '=', $clock->id)
        ->whereBetween('clockin_date', [$awal, $akhir])
        ->get();

        $totalsemua = 0;
        $totaljam = null;

        foreach($totals as $total){

            if($total->clockout_date == null){

                $clockouts = $total->clockin_date;
                $clocksouttimes = '17:00';

            } else {

                if($total->clockin_date != $total->clockout_date){

                    $clockouts = $total->clockin_date;
                    $clocksouttimes = '17:00';

                } else {

                    $clockouts = $total->clockout_date;
                    $clocksouttimes = $total->clockout_time;

                }

            }

        $waktu_awal = strtotime($total->clockin_date.' '.$total->clockin_time);
        $waktu_akhir = strtotime($clockouts.' '.$clocksouttimes);

        $diff = $waktu_akhir - $waktu_awal;

        $totalsemua += $diff;

        $totaljam .= $total->clockin_date;

        }

        $jam = floor($totalsemua / (60 * 60));
        $menit = $totalsemua - $jam * (60 * 60);

        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $clock->username }}</td>
            <td>{{ $clock->first_name }}</td>
            <td>{{ $clock->unitkerja_name }}</td>
            <td>{{ $jam }} Jam {{ floor( $menit / 60 ) }} Menit</td>
        </tr>
        @endforeach
    </tbody>
</table>