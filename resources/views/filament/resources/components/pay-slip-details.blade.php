@php
    use App\Models\User;
    use App\Models\BalanceTracking;

    $state = $getState();
    $date = $state['date'];
    $month = date('m', strtotime($date));
    $year = date('Y', strtotime($date));
    $user_id = $state['user_id'];
    $user = User::with(['profile','department','designation'])->find($user_id);
@endphp
<x-filament::section>

    <x-slot name="heading">
        @if($user->profile->path != null)
            <x-filament::avatar
                src="{{ Storage::url('public/'.$user->profile->path) }}"
                alt="{{ $user->name }}"
            />
        @endif
         {{ $user->name }}
    </x-slot>

    <x-slot name="description">
        <b>Email: </b>{{ $user->email }}
    </x-slot>
    <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400"><b>Department: </b>{{ $user->department->name }}</p>
    <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400"><b>Designation: </b>{{ $user->designation->name }}</p>
    <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400"><b>Date of Joining: </b>{{  date("d-m-Y",strtotime($user->updated_at)) }}</p>
    <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400"><b>Pay Period: </b>{{ date("F-Y", strtotime($date)) }}</p>
    <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400"><b>Pay Date: </b>{{ date("d-m-Y",strtotime($date)) }}</p>
    <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400"><b>CNIC Number: </b>{{ $user->cnic_number }}</p>
    <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400"><b>Basic Salary: </b>Rs. {{ $user->basic_salary }}</p>
    @php
        $u_id = $user->id;
        $balance_tracking = BalanceTracking::where('user_id', $u_id)->whereMonth('date', $month)->whereYear('date', $year)->latest()->first();
        $remaining_salary = null;
        if($balance_tracking){
            $balance_tracking = $balance_tracking->toArray();
            $remaining_salary = $balance_tracking['remaining_salary'];
        }else{
            $remaining_salary = $user->basic_salary;
        }
    @endphp
    <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400"><b>Remaining Salary: </b>Rs. {{ $remaining_salary }}</p>
</x-filament::section>
