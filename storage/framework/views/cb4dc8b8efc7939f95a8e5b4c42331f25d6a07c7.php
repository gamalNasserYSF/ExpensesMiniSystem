<?php $request = app('Illuminate\Http\Request'); ?>


<?php $__env->startSection('content'); ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\Expense::class)): ?>
        <p>
            <a href="<?php echo e(route('expense.create')); ?>" class="btn btn-success">Create New</a>
        </p>
    <?php endif; ?>

    <div class="panel panel-default">

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped <?php echo e(count($expenses) > 0 ? 'datatable' : ''); ?>">
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
                <?php if(count($expenses) > 0): ?>
                    <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($expense->id); ?></td>
                            <td><?php echo e($expense->name); ?></td>
                            <td><?php echo e($expense->entry_date); ?></td>
                            <td><?php echo e($expense->amount); ?></td>
                            <td><?php echo e(array_search($expense->status, \App\Models\Expense::Status)); ?></td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $expense)): ?>
                                    <a href="<?php echo e(route('expense.show', [$expense->id])); ?>" class="btn btn-xs btn-primary">View</a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('approve', $expense)): ?>
                                    <a href="<?php echo e(route('expense.approve', [$expense->id])); ?>" class="btn btn-xs btn-success">Approve</a>
                                <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reject', $expense)): ?>
                                        <a href="<?php echo e(route('expense.reject', [$expense->id])); ?>" class="btn btn-xs btn-outline-info">Reject</a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cancel', $expense)): ?>
                                        <a href="<?php echo e(route('expense.cancel', [$expense->id])); ?>" class="btn btn-xs btn-dark">Cancel</a>
                                    <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $expense)): ?>
                                    <?php echo Form::open(
                                            array('style' => 'display: inline-block;',
                                                  'method' => 'DELETE',
                                                  'onsubmit' => "return confirm('Are you sure?')",
                                                  'route' => ['expense.destroy', $expense->id]
                                                  )); ?>

                                    <?php echo Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')); ?>

                                    <?php echo Form::close(); ?>

                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No Entries in table</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="panel-footer">
            <?php echo $expenses->links('pagination::bootstrap-4'); ?>

        </div>

    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\expenses-app\resources\views/admin/expenses/index.blade.php ENDPATH**/ ?>