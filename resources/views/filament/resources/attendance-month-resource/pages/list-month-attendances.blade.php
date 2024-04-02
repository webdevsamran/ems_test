@php
    use App\Models\User;
    use App\Enums\CvStatus;
    use Filament\Actions;

    $currentYear = date('Y'); // Get current year
    $currentMonth = date('n'); // Get current month (without leading zeros)
    $day = date('j'); // Get current day (without leading zeros)
    $total_days = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    $users = User::with(['attendances' => function($query) use ($currentMonth, $currentYear) {
                    $query->whereMonth('first_checkin', $currentMonth)
                          ->whereYear('first_checkin', $currentYear);
                }])->where('status', 1)
                ->where(function($query) {
                    $query->whereIn('cv_status', [CvStatus::HIRED,CvStatus::INTERN,null])
                        ->orWhereNull('cv_status');
                })
                ->get();
@endphp
<x-filament::section>
<div>
{{--    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Monthly Attendance Sheet</h1>--}}
    <x-slot name="heading">
        Monthly Attendance Sheet
    </x-slot>
    <x-slot name="description">
        This is all the Attendance For Given Month
    </x-slot>
    <div>
        {{ Actions\Action::make('test') }}
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                @for($i = 1; $i <= $total_days; $i++)
                    <th scope="col" class="px-6 py-3">
                        {{ $i }}
                    </th>
                @endfor
            </tr>
            </thead>
            <tbody>
            @if(!empty($users))
                @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        @php
                            $attendances = $user->attendances;
                            $presentDays = [];
                            foreach ($attendances as $attendance) {
                                $presentDays[] = $attendance->created_at->format('d');
                            }
                        @endphp
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        @for($i = 1; $i <= $total_days; $i++)
                            <td class="px-6 py-4">
                                @if($i <= $day)
                                    @if(in_array($i, $presentDays))
                                        <x-filament::badge color="success" size="sm" tooltip="Present">
                                            P
                                        </x-filament::badge>
                                    @else
                                        <x-filament::badge color="danger" size="sm" tooltip="Absent">
                                            A
                                        </x-filament::badge>
                                    @endif
                                @else
                                    <x-filament::badge color="gray" size="sm" tooltip="Unknown">
                                        ?
                                    </x-filament::badge>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
</x-filament::section>
