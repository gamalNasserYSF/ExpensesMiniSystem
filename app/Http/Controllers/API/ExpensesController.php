<?php

namespace App\Http\Controllers\API;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExpensesRequest;
use App\Http\Requests\Admin\UpdateExpensesRequest;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Expense::class, 'expense');
    }

    /**
     * Display a list of Expenses
     *
     */
    public function index()
    {
        if(\auth()->check() && \request()->user()->isManager or \request()->user()->role_id == 1){
            $expenses = Expense::paginate(5);
        }else{
            $expenses = Expense::whereUserId(\request()->user()->id)->paginate(5);
        }

        return response()->json([
            'result' => true,
            'data' => $expenses
        ], 200);
    }


    /**
     * Display Expense.
     *
     */
    public function show(Expense $expense)
    {
            return response()->json([
                'result' => true,
                'data' => $expense
            ], 200);
    }

    /**
     * Store a newly created Expense in storage.
     *
     */
    public function store(StoreExpensesRequest $request)
    {
        $expense = Expense::make($request->all());

        $expense->user_id = $request->user()->id;

        if ($request->hasFile('attachment')){
            $expense->attachment = $request->file('attachment')->store('uploads');
        }

        $expense->save();

        return response()->json([
            'result' => true,
            'message' => 'done'
        ]);
    }

    /**
     * Remove Expense from storage.
     *
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->json([
            'result' => true,
            'message' => 'done'
        ]);
    }

    /**
     * Approve Expense.
     *
     */
    public function approve ($id)
    {
        $expense = Expense::find($id);

        if (isset($expense))
            $expense->update([
                'status' => Expense::Status['approved']
            ]);

        return response()->json([
            'result' => true,
            'message' => 'done'
        ]);

    }

    /**
     * Cancel Expense.
     *
     */
    public function cancel ($id)
    {
        $expense = Expense::find($id);

        $this->authorize('cancel', $expense);

        if (isset($expense))
            $expense->update(['status' => Expense::Status['cancelled']]);

        return response()->json([
            'result' => true,
            'message' => 'done'
        ]);

    }

    /**
     * Reject Expense.
     *
     */
    public function reject($id)
    {
        $expense = Expense::find($id);

        if (isset($expense))
            $expense->update([
                'status' => Expense::Status['reject']
            ]);

        return response()->json([
            'result' => true,
            'message' => 'done'
        ]);
    }

}
