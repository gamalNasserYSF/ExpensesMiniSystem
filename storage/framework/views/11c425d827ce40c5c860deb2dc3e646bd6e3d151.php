<?php $__env->startSection('content'); ?>
    <h3 class="page-title">Create Expense</h3>

    <?php echo Form::open(['method' => 'POST', 'route' => ['expense.store'], 'id' => 'expense', 'files' => true]); ?>


            <div class="row">

                <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>">

                <div class="col-md-8 form-group">
                    <?php echo Form::label('name', 'Name', ['class' => 'control-label']); ?>

                    <?php echo Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'moneyFormat', 'placeholder' => 'Enter name', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('name')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('name')); ?>

                        </p>
                    <?php endif; ?>
                </div>

                    <div class="col-md-8 form-group">
                        <?php echo Form::label('entry_date', 'Date', ['class' => 'control-label']); ?>

                        <?php echo Form::date('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']); ?>

                        <p class="help-block"></p>

                        <?php if($errors->has('entry_date')): ?>
                            <p class="help-block">
                                <?php echo e($errors->first('entry_date')); ?>

                            </p>
                        <?php endif; ?>
                    </div>

                <div class="col-md-8 form-group">
                    <?php echo Form::label('amount', 'Amount', ['class' => 'control-label']); ?>

                    <?php echo Form::number('amount', old('amount'), ['class' => 'form-control', 'id' => 'moneyFormat', 'placeholder' => '', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('amount')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('amount')); ?>

                        </p>
                    <?php endif; ?>
                </div>

                <div class="col-md-8 form-group">
                    <?php echo Form::label('attachment', 'Attachment', ['class' => 'control-label']); ?>

                    <?php echo Form::file('attachment', old('attachment'), ['class' => 'form-control', 'id' => 'attachment', 'placeholder' => '', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('attachment')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('attachment')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>

    <?php echo Form::submit('Save', ['class' => 'btn btn-success']); ?>

    <a href="<?php echo e(route('expense.index')); ?>" class="btn">Cancel</a>
    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\expenses-app\resources\views/admin/expenses/create.blade.php ENDPATH**/ ?>