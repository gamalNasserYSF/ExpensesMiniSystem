@extends('layouts.app')

@section('content')

            <div class="row">
                <div class="col-md-10">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Name</th>
                            <td>{{ $expense->name }}</td>
                        </tr>
                        <tr>
                            <th>Entry Date</th>
                            <td>{{ $expense->entry_date }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ $expense->amount }}</td>
                        </tr>
                        <tr>
                            <th>Employee Name</th>
                            <td>{{ $expense->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Attachment</th>
                            <td>
                                <a href="{{ $expense->attachment }}" download="{{ $expense->name.'-'. $expense->user->name}}">
                                    Download
{{--                                    <img src="{{ asset('storage/app/'.$expense->attachment) }}" alt="Preview" width="50" height="50">--}}
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('expense.index') }}" class="btn btn-primary">back to list</a>

@stop
