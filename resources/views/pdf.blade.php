<!DOCTYPE html>
<style>
    .main_container{
        width: 100%;
        height: 100%;
        padding: 1em;
        margin: 0px;
        box-sizing: border-box;
        font-family: "Roboto", sans-serif;
    }
    .main_container_h1{
        margin:0px 0px 16px 0px;
        padding:0px;
        font-weight: 400;
    }
    .main_container_h2{
        margin:0px 0px 16px 0px;
        padding:0px;
        font-weight: 300;
    }
    .main_container .container{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    .main_container .container .emp_details table{
        width: 100%;
        border-collapse: collapse;
    }
    .main_container .container .emp_details table tbody tr th,.main_container .container .emp_details table tbody tr td{
        padding: 8px 16px 8px 0px;
    }
    .main_container .container .emp_details table tbody tr th{
        font-weight: 400;
        text-align: start;
    }
    .main_container .container .emp_details table tbody tr td{
        font-weight: 300;
        text-align: start;
    }
    .main_container .container .emp_net_pay{
        border: 3px dotted #f1f1f1;
        padding: 12px 24px;
    }
    .main_container .container .emp_net_pay .emp_net_pay_h3{
        margin: 16px 8px 0 8px;
        text-align: center;
        font-weight: 400;
        color: black;
    }
    .main_container .container .emp_net_pay .emp_net_pay_h2{
        margin: 8px 8px 32px 8px;
        text-align: center;
        font-weight: 500;
        color: black;
    }
    .main_container .container_table{
        width: 100%;
        display: flex;
        flex-direction: row;
    }
    .main_container .container_table .containers_table_earnings{
        border-right: 1px solid #f1f1f1;
        border-collapse: collapse;
    }
    .main_container .container_table .containers_table_earnings thead{
        background: #f1f1f1;
    }
    .main_container .container_table .containers_table_earnings thead tr th,.main_container .container_table .containers_table_earnings tbody tr td, .main_container .container_table .containers_table_earnings tfoot tr th{
        padding: 8px 16px 8px 8px;
    }
    .main_container .container_table .containers_table_earnings thead tr th{
        font-weight: 500;
        text-align: start;
    }
    .main_container .container_table .containers_table_earnings tbody tr td{
        font-weight: 300;
        text-align: start;
    }
    .main_container .container_table .containers_table_earnings tfoot tr{
        border-top: 1px solid #f1f1f1;
        border-bottom: 1px solid #f1f1f1;
    }
    .main_container .container_table .containers_table_earnings tfoot tr th{
        font-weight: 500;
        text-align: start;
    }
    .main_container .container_table .containers_table_earnings tfoot tr td{
        font-weight: 300;
        text-align: start;
    }
    .main_container .container_table .containers_table_deductions{
        border-left: 1px solid #f1f1f1;
        border-collapse: collapse;
    }
    .main_container .container_table .containers_table_deductions thead{
        background: #f1f1f1;
    }
    .main_container .container_table .containers_table_deductions thead tr th,.main_container .container_table .containers_table_deductions tbody tr td, .main_container .container_table .containers_table_deductions tfoot tr th{
        padding: 8px 16px 8px 8px;
    }
    .main_container .container_table .containers_table_deductions thead tr th{
        font-weight: 500;
        text-align: start;
    }
    .main_container .container_table .containers_table_deductions tbody tr td{
        font-weight: 300;
        text-align: start;
    }
    .main_container .container_table .containers_table_deductions tfoot tr{
        border-top: 1px solid #f1f1f1;
        border-bottom: 1px solid #f1f1f1;
    }
    .main_container .container_table .containers_table_deductions tfoot tr th{
        font-weight: 500;
        text-align: start;
    }
    .main_container .container_table .containers_table_deductions tfoot tr td{
        font-weight: 300;
        text-align: start;
    }
    .container_net_payable{
        background: rgba(74, 222, 128, 0.2);
        margin-top: 24px;
        padding: 8px;
    }
    .container_net_payable .net_payable_heading{
        border-left: 2px solid rgba(74, 222, 128, 0.8);
        margin: 8px;
        padding: 0px 8px;
        font-weight: 400;
    }
    .container_net_payable .net_payable_heading .net_payable_heading_amount{
        font-weight: 600;
    }
    .container_net_payable .net_payable_heading .net_payable_heading_amount_in_words{
        font-weight: 400;
        font-size: 0.7em;
    }
    .net_pay_formula{
        font-weight: 400;
        font-size: 0.7em;
        color: gray;
    }
</style>
@php
    use App\Models\PayHead;
    use App\Models\BalanceTracking;
@endphp
<div class="main_container">
    <h1 class="main_container_h1">Payslip for the month of {{ date('F, Y', strtotime($data['date'] ?? now())) }}</h1>
    <h2 class="main_container_h2">Employee Pay Salary</h2>
    <div class="container">
        <div class="emp_details">
            <table>
                <tbody>
                <tr>
                    <th>Employee Name</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td>{{ $user->name ?? 'User' }}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td>{{ $user->department->name ?? 'Department' }}</td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td>{{ $user->designation->name ?? 'Designation' }}</td>
                </tr>
                <tr>
                    <th>Date of Joining</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td>{{ date('d-m-Y',strtotime($user->updated_at ?? now())) }}</td>
                </tr>
                <tr>
                    <th>Pay Period</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td>{{ date('F-Y', strtotime($data['date'] ?? now())) }}</td>
                </tr>
                <tr>
                    <th>Pay Date</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td>{{ date('d-m-Y', strtotime($data['date'] ?? now())) }}</td>
                </tr>
                <tr>
                    <th>CNIC Number</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td>{{ $user->cnic_number ?? '32304-4299691-1' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="emp_net_pay">
            <h3 class="emp_net_pay_h3">Employee Net Pay</h3>
            <h2 class="emp_net_pay_h2">RS {{ $data['net_payable'] ?? '5000.00' }}</h2>
        </div>
    </div>
    <hr>
    <div class="container_table">
        <table class="containers_table_earnings">
            <thead>
                <tr>
                    <th>Earnings</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
            @if(!empty($data['pay_slip_additions']))
                @foreach($data['pay_slip_additions'] as $addition)
                    @if($addition['pay_head_id'] != null)
                        @php
                            $pay_head = PayHead::find($addition['pay_head_id']);
                         @endphp
                        <tr>
                            <td>{{ $pay_head->name }}</td>
                            <td>Rs {{ $addition['amount'] }}</td>
                            <td>Rs {{ $addition['remarks'] }}</td>
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td>Basic Salary</td>
                    <td>Rs 25,000.00</td>
                </tr>
            @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Gross Earnings</th>
                    @if($data['gross_earnings'])
                        <th>Rs {{ $data['gross_earnings'] }}</th>
                    @else
                        <th>Rs 30,000.00</th>
                    @endif
                </tr>
            </tfoot>
        </table>
        <table class="containers_table_deductions">
            <thead>
                <tr>
                    <th>Deductions</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
            @if(!empty($data['pay_slip_deductions']))
                @foreach($data['pay_slip_deductions'] as $deduction)
                    @if($deduction['pay_head_id'] != null)
                        @php
                            $pay_head = PayHead::find($deduction['pay_head_id']);
                        @endphp
                        <tr>
                            <td>{{ $pay_head->name }}</td>
                            <td>Rs {{ $deduction['amount'] }}</td>
                            <td>Rs {{ $addition['remarks'] }}</td>
                        </tr>
                    @endif
                @endforeach\
            @else
                <tr>
                    <td>Tax</td>
                    <td>Rs 2,000.00</td>
                </tr>
            @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Total Deductions</th>
                    @if($data['total_deductions'])
                        <th>Rs {{ $data['total_deductions'] }}</th>
                    @else
                        <th>Rs 2,000.00</th>
                    @endif
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="container_net_payable">
        <h2 class="net_payable_heading">Total Net Payable <span class="net_payable_heading_amount">Rs {{ $data['net_payable'] ?? '5000.00' }}</span> <span class="net_payable_heading_amount_in_words">(Five Thousand Rupees Only)</span></h2>
    </div>
    <p class="net_pay_formula">
        Total Net Payable = (Gross Earnings - Total Deductions)
    </p>
    <div class="remarks_container">
        <h3 class="remarks_heading">Remarks</h3>
        <table class="remarks_table">
            <tbody>
                <tr>
                    <th>Basic Salary</th>
                    <td></td>
                    <td>-</td>
                    <td>Rs. {{ $user->basic_salary }}</td>
                </tr>
                @php
                    $userID = $user->id;
                    $month = date('m', strtotime($data['date']));
                    $year = date('Y', strtotime($data['date']));
                    $old_balance = BalanceTracking::where('user_id', $userID)->whereMonth('date', $month)->whereYear('date', $year)->latest()->skip(1)->take(1)->first();
                    $remaining_salary = null;
                    if($old_balance != null){
                        $old_balance = $old_balance->toArray();
                        $remaining_salary = (int)($old_balance['remaining_salary']);
                    }
                @endphp
                @if($remaining_salary != null)
                    <tr>
                        <th>Remaining Salary</th>
                        <td></td>
                        <td>-</td>
                        <td>Rs. {{ $remaining_salary }}</td>
                    </tr>
                @endif
                <tr>
                    <th>All Charges</th>
                    <td></td>
                    <td>-</td>
                    <td>Rs. {{ $data['gross_earnings'] }}</td>
                </tr>
                @if($remaining_salary != null)
                    <tr>
                        <th>Net Remaining</th>
                        <td></td>
                        <td>-</td>
                        <td>Rs. {{ (int)($remaining_salary - $data['gross_earnings']) }}</td>
                    </tr>
                @else
                    <tr>
                        <th>Net Remaining</th>
                        <td></td>
                        <td>-</td>
                        <td>Rs. {{ (int)($user->basic_salary - $data['gross_earnings']) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
