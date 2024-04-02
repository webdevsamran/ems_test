<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Date</th>
        <th>First Checkin</th>
        <th>First Checkout</th>
        <th>Second Checkin</th>
        <th>Second Checkout</th>
        <th>Total Worked Hours</th>
    </tr>
    </thead>
    <tbody>
    @foreach($attendances as $attendance)
        <tr>
            <td>{{ $attendance->user->name }}</td>
            <td>{{ $attendance->date }}</td>
            <td>{{ $attendance->first_checkin }}</td>
            <td>{{ $attendance->first_checkout }}</td>
            <td>{{ $attendance->second_checkin }}</td>
            <td>{{ $attendance->second_checkout }}</td>
            <td>{{ (int)($attendance->minutes_worked / 60) . 'h ' . ($attendance->minutes_worked % 60) ?? 'N/A' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
