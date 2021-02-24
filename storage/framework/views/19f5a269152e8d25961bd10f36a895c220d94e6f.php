<?php $__env->startSection('content'); ?>

            <div class="row">
                <div class="col-md-10">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Name</th>
                            <td><?php echo e($expense->name); ?></td>
                        </tr>
                        <tr>
                            <th>Entry Date</th>
                            <td><?php echo e($expense->entry_date); ?></td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td><?php echo e($expense->amount); ?></td>
                        </tr>
                        <tr>
                            <th>Employee Name</th>
                            <td><?php echo e($expense->user->name); ?></td>
                        </tr>
                        <tr>
                            <th>Attachment</th>
                            <td>
                                <a href="<?php echo e($expense->attachment); ?>" download="<?php echo e($expense->name.'-'. $expense->user->name); ?>">
                                    Download

                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="<?php echo e(route('expense.index')); ?>" class="btn btn-primary">back to list</a>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\expenses-app\resources\views/admin/expenses/show.blade.php ENDPATH**/ ?>