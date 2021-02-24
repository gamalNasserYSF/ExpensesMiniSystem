@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('create', \App\Models\Expense::class)
        <p>
            <a href="{{ route('expense.create') }}" class="btn btn-success">Create New</a>
        </p>
    @endcan

    <div class="panel panel-default">

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Entry Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if (count($expenses) > 0)
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->name }}</td>
                            <td>{{ $expense->entry_date }}</td>
                            <td>{{ $expense->amount}}</td>
                            <td>{{ array_search($expense->status, \App\Models\Expense::Status)}}</td>
                            <td>
                                @can('view', $expense)
                                    <a href="{{ route('expense.show', [$expense->id]) }}" class="btn btn-xs btn-primary">View</a>
                                @endcan

                                @can('approve', $expense)
                                    <a href="{{ route('expense.approve', [$expense->id]) }}" class="btn btn-xs btn-success">Approve</a>
                                @endcan

                                    @can('reject', $expense)
                                        <a href="{{ route('expense.reject', [$expense->id]) }}" class="btn btn-xs btn-outline-info">Reject</a>
                                    @endcan

                                    @can('cancel', $expense)
                                        <a href="{{ route('expense.cancel', [$expense->id]) }}" class="btn btn-xs btn-dark">Cancel</a>
                                    @endcan

                                @can('delete', $expense)
                                    {!! Form::open(
                                            array('style' => 'display: inline-block;',
                                                  'method' => 'DELETE',
                                                  'onsubmit' => "return confirm('Are you sure?')",
                                                  'route' => ['expense.destroy', $expense->id]
                                                  ))
                                    !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">No Entries in table</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="panel-footer">
            {!! $expenses->links('pagination::bootstrap-4') !!}
        </div>

    </div>

@endsection

