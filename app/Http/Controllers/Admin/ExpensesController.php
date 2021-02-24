<?php

namespace App\Http\Controllers\Admin;

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

        if(\auth()->check() && auth()->user()->isManager or \auth()->user()->role_id == 1){
            $expenses = Expense::paginate(5);
        }else{
            $expenses = Expense::whereUserId(\auth()->user()->id)->paginate(5);
        }

        return view('admin.expenses.index', compact('expenses'));
    }


    /**
     * Display Expense.
     *
     */
    public function show(Expense $expense)
    {
        return view('admin.expenses.show', compact('expense'));
    }


    /**
     * Show the form for creating new Expense.
     *
     */
    public function create()
    {
        return view('admin.expenses.create');
    }

    /**
     * Store a newly created Expense in storage.
     *
     */
    public function store(StoreExpensesRequest $request)
    {
        $expense = Expense::make($request->all());

        if ($request->hasFile('attachment')){
            $expense->attachment = $request->file('attachment')->store('uploads');
        }

        $expense->save();

        return redirect()->route('expense.index');
    }


    /**
     * Show the form for editing Expense.
     *
     */
    public function edit(Expense $expense)
    {
        return view('expense.edit', compact('expense'));
    }

    /**
     * Update Expense in storage.
     *
     */
    public function update(Request $request, Expense $expense)
    {
        $expense->update($request->all());

        return redirect()->route('expense.index');
    }


    /**
     * Remove Expense from storage.
     *
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expense.index');
    }

    /**
     * Approve Expense.
     *
     */
    public function approve($id)
    {
        Expense::find($id)->update([
            'status' => Expense::Status['approved']
        ]);

        return redirect()->route('expense.index');
    }

    /**
     * Cancel Expense.
     *
     */
    public function cancel($id)
    {
        Expense::find($id)->update([
            'status' => Expense::Status['cancelled']
        ]);

        return redirect()->route('expense.index');
    }

    /**
     * Reject Expense.
     *
     */
    public function reject($id)
    {
        Expense::find($id)->update([
            'status' => Expense::Status['reject']
        ]);

        return redirect()->route('expense.index');
    }

}
