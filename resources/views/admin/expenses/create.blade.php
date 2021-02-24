@extends('layouts.app')

@section('content')
    <h3 class="page-title">Create Expense</h3>

    {!! Form::open(['method' => 'POST', 'route' => ['expense.store'], 'id' => 'expense', 'files' => true]) !!}

            <div class="row">

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="col-md-8 form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'moneyFormat', 'placeholder' => 'Enter name', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                    <div class="col-md-8 form-group">
                        {!! Form::label('entry_date', 'Date', ['class' => 'control-label']) !!}
                        {!! Form::date('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>

                        @if($errors->has('entry_date'))
                            <p class="help-block">
                                {{ $errors->first('entry_date') }}
                            </p>
                        @endif
                    </div>

                <div class="col-md-8 form-group">
                    {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
                    {!! Form::number('amount', old('amount'), ['class' => 'form-control', 'id' => 'moneyFormat', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>

                <div class="col-md-8 form-group">
                    {!! Form::label('attachment', 'Attachment', ['class' => 'control-label']) !!}
                    {!! Form::file('attachment', old('attachment'), ['class' => 'form-control', 'id' => 'attachment', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('attachment'))
                        <p class="help-block">
                            {{ $errors->first('attachment') }}
                        </p>
                    @endif
                </div>
            </div>

    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{{ route('expense.index') }}" class="btn">Cancel</a>
    {!! Form::close() !!}

@endsection


