<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExpensePolicy
{
    public function viewAny (User $user)
    {
        return true;
    }

    public function view (User $user, Expense $expense)
    {
        return ($user->isManager() or $user->id === $expense->user_id)
            ? Response::allow()
            : Response::deny('You do not own this expense.');
    }

    public function create (User $user)
    {
        // any user can create
        return true;
    }

    public function delete (User $user, Expense $expense)
    {
        return ($user->isManager() or $user->id === $expense->user_id)
            ? Response::allow()
            : Response::deny('You do not own this expense.');
    }

    public function approve (User $user)
    {
        // only manager or user has role of manager who can take action
        return $user->isManager()
            ? Response::allow()
            : Response::deny('Only manager can do this action');
    }

    public function reject (User $user)
    {
        return $user->isManager()
            ? Response::allow()
            : Response::deny('Only manager who can do this action');
    }

    public function cancel (User $user, Expense $expense)
    {
        // only expense's owner who can cancel it
        return $user->id === $expense->user_id
            ? Response::allow()
            : Response::deny('You do not own this expense.');
    }
}
