@php
    use App\Models\Projection;
//    dd($filters,$users);
@endphp
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Designation</th>
        <th>Total Worked Hours</th>
        <th>Total Worked Days</th>
        <th>On Working Hours</th>
        <th>On Working Days</th>
        <th>Off Working Hours</th>
        <th>Off Working Days</th>
        <th>Total Projection</th>
    </tr>
    </thead>
    <tbody>
    @php
        if($filters){
            $created_from = $filters['attendances']['created_from'];
            $created_until = $filters['attendances']['created_until'];
        }
    @endphp

    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->department->name ?? 'N/A' }}</td>
            <td>{{ $user->designation->name ?? 'N/A' }}</td>
            <td>
                @php
                    $attendances = $user->attendances->toArray() ?? [];
                    if(empty($attendances)){
                        echo 'N/A';
                    }else{
                        if($created_from && $created_until){
                            $attendances = collect($attendances)->whereBetween('date',[$created_from,$created_until])->toArray();
                        }elseif ($created_from){
                            $attendances = collect($attendances)->where('date','>=',$created_from)->toArray();
                        }elseif ($created_until){
                            $attendances = collect($attendances)->where('date','<=',$created_until)->toArray();
                        }
                        $total = 0;
                        foreach($attendances as $attendance){
                            $total += $attendance['minutes_worked'];
                        }
                        $total = (int)($total / 60) . 'h ' . ($total % 60) . 'm';
                        echo $total;
                    }
                @endphp
            </td>
            <td>
                @php
                    $attendances = $user->attendances->toArray() ?? [];
                    if(empty($attendances)){
                        echo 'N/A';
                    }else{
                        if($created_from && $created_until){
                            $attendances = collect($attendances)->whereBetween('date',[$created_from,$created_until])->toArray();
                        }elseif ($created_from){
                            $attendances = collect($attendances)->where('date','>=',$created_from)->toArray();
                        }elseif ($created_until){
                            $attendances = collect($attendances)->where('date','<=',$created_until)->toArray();
                        }
                        $total = count($attendances) . ' Days';
                        echo $total;
                    }
                @endphp
            </td>
            <td>
                @php
                    $attendances = $user->attendances->toArray() ?? [];
                    if(empty($attendances)){
                        echo 'N/A';
                    }else{
                        if($created_from && $created_until){
                            $attendances = collect($attendances)->whereBetween('date',[$created_from,$created_until])->toArray();
                        }elseif ($created_from){
                            $attendances = collect($attendances)->where('date','>=',$created_from)->toArray();
                        }elseif ($created_until){
                            $attendances = collect($attendances)->where('date','<=',$created_until)->toArray();
                        }
                        $extractedRecords = [];
                        foreach ($attendances as $attendance) {
                            $createdAt = strtotime($attendance['created_at']);
                            if (date('w', $createdAt) != 0) {
                                $record = [
                                    'id' => $attendance['id'],
                                    'user_id' => $attendance['user_id'],
                                    'first_checkin' => $attendance['first_checkin'],
                                    'first_checkout' => $attendance['first_checkout'],
                                    'second_checkin' => $attendance['second_checkin'],
                                    'second_checkout' => $attendance['second_checkout'],
                                    'minutes_worked' => $attendance['minutes_worked'],
                                    'created_at' => $attendance['created_at'],
                                    'updated_at' => $attendance['updated_at']
                                ];
                                $extractedRecords[] = $record;
                            }
                        }
                        $total = 0;
                        foreach($extractedRecords as $attendance){
                            $total += $attendance['minutes_worked'];
                        }
                        $total = (int)($total / 60) . 'h ' . ($total % 60) . 'm';
                        echo $total;
                    }
                @endphp
            </td>
            <td>
                @php
                    $attendances = $user->attendances->toArray() ?? [];
                    if(empty($attendances)){
                        echo 'N/A';
                    }else{
                        if($created_from && $created_until){
                            $attendances = collect($attendances)->whereBetween('date',[$created_from,$created_until])->toArray();
                        }elseif ($created_from){
                            $attendances = collect($attendances)->where('date','>=',$created_from)->toArray();
                        }elseif ($created_until){
                            $attendances = collect($attendances)->where('date','<=',$created_until)->toArray();
                        }
                        $extractedRecords = [];
                        foreach ($attendances as $attendance) {
                            $createdAt = strtotime($attendance['created_at']);
                            if (date('w', $createdAt) != 0) {
                                $record = [
                                    'id' => $attendance['id'],
                                    'user_id' => $attendance['user_id'],
                                    'first_checkin' => $attendance['first_checkin'],
                                    'first_checkout' => $attendance['first_checkout'],
                                    'second_checkin' => $attendance['second_checkin'],
                                    'second_checkout' => $attendance['second_checkout'],
                                    'minutes_worked' => $attendance['minutes_worked'],
                                    'created_at' => $attendance['created_at'],
                                    'updated_at' => $attendance['updated_at']
                                ];
                                $extractedRecords[] = $record;
                            }
                        }
                        $total = count($extractedRecords) . ' Days';
                        echo $total;
                    }
                @endphp
            </td>
            <td>
                @php
                    $attendances = $user->attendances->toArray() ?? [];
                    if(empty($attendances)){
                        echo 'N/A';
                    }else{
                        if($created_from && $created_until){
                            $attendances = collect($attendances)->whereBetween('date',[$created_from,$created_until])->toArray();
                        }elseif ($created_from){
                            $attendances = collect($attendances)->where('date','>=',$created_from)->toArray();
                        }elseif ($created_until){
                            $attendances = collect($attendances)->where('date','<=',$created_until)->toArray();
                        }
                        $extractedRecords = [];
                        foreach ($attendances as $attendance) {
                            $createdAt = strtotime($attendance['created_at']);
                            if (date('w', $createdAt) == 0) {
                                $record = [
                                    'id' => $attendance['id'],
                                    'user_id' => $attendance['user_id'],
                                    'first_checkin' => $attendance['first_checkin'],
                                    'first_checkout' => $attendance['first_checkout'],
                                    'second_checkin' => $attendance['second_checkin'],
                                    'second_checkout' => $attendance['second_checkout'],
                                    'minutes_worked' => $attendance['minutes_worked'],
                                    'created_at' => $attendance['created_at'],
                                    'updated_at' => $attendance['updated_at']
                                ];
                                $extractedRecords[] = $record;
                            }
                        }
                        $total = 0;
                        foreach($extractedRecords as $attendance){
                            $total += $attendance['minutes_worked'];
                        }
                        $total = (int)($total / 60) . 'h ' . ($total % 60) . 'm';
                        echo $total;
                    }
                @endphp
            </td>
            <td>
                @php
                    $attendances = $user->attendances->toArray() ?? [];
                    if(empty($attendances)){
                        echo 'N/A';
                    }else{
                        if($created_from && $created_until){
                            $attendances = collect($attendances)->whereBetween('date',[$created_from,$created_until])->toArray();
                        }elseif ($created_from){
                            $attendances = collect($attendances)->where('date','>=',$created_from)->toArray();
                        }elseif ($created_until){
                            $attendances = collect($attendances)->where('date','<=',$created_until)->toArray();
                        }
                        $extractedRecords = [];
                        foreach ($attendances as $attendance) {
                            $createdAt = strtotime($attendance['created_at']);
                            if (date('w', $createdAt) == 0) {
                                $record = [
                                    'id' => $attendance['id'],
                                    'user_id' => $attendance['user_id'],
                                    'first_checkin' => $attendance['first_checkin'],
                                    'first_checkout' => $attendance['first_checkout'],
                                    'second_checkin' => $attendance['second_checkin'],
                                    'second_checkout' => $attendance['second_checkout'],
                                    'minutes_worked' => $attendance['minutes_worked'],
                                    'created_at' => $attendance['created_at'],
                                    'updated_at' => $attendance['updated_at']
                                ];
                                $extractedRecords[] = $record;
                            }
                        }
                        $total = count($extractedRecords) . ' Days';
                        echo $total;
                    }
                @endphp
            </td>
            <td>
                @php
                    if($created_from && $created_until){
                        $projections = Projection::whereBetween('date',[$created_from,$created_until])->get();
                    }elseif ($created_from){
                        $projections = Projection::where('date','>=',$created_from)->get();
                    }elseif ($created_until){
                        $projections = Projection::where('date','<=',$created_until)->get();
                    }else{
                        $projections = Projection::all();
                    }
                    $total_hours = null;
                    foreach ($projections as $projection){
                        $total_hours += $projection->total_minutes;
                    }
                    echo (int)($total_hours / 60) . 'h ' . ($total_hours % 60) . 'm' ?? 'N/A';
                @endphp
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
