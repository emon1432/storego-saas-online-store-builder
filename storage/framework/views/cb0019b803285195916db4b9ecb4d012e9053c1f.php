<form method="post" action="<?php echo e(route('coupons.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name',__('Name'),array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('discount',__('Discount') ,array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::number('discount',null,array('class'=>'form-control','step'=>'0.01','placeholder'=>__('Enter Discount'),'required'=>'required'))); ?>

            <span class="small"><?php echo e(__('Note: Discount in Percentage')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('limit',__('Limit') ,array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::number('limit',null,array('class'=>'form-control','placeholder'=>__('Enter Limit'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12" id="auto">
            <?php echo e(Form::label('limit',__('Code') ,array('class'=>'col-form-label'))); ?>

            <div class="input-group">
                <?php echo e(Form::text('code',null,array('class'=>'form-control','id'=>'auto-code','required'=>'required'))); ?>

                <button class="btn btn-outline-secondary" type="button" id="code-generate"><i class="fa fa-history pr-1"></i><?php echo e(__(' Generate')); ?></button>
            </div>
        </div>
        <div class="form-group col-12 d-flex justify-content-end col-form-label">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
        </div>
    </div>
</form>
<?php /**PATH /home/emon1432/Documents/storego-saas-online-store-builder/resources/views/coupon/create.blade.php ENDPATH**/ ?>