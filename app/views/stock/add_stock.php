<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stock Management</h4>
        </div>

        <div class="card-body">
            <?php echo $stock_form->start()?>
                <?php __($stock_form->getCol('item_id'))?>
                <div class="form-group mt-2">
                    <?php
                        Form::label('Unit');
                        Form::text('', $item->unit, [
                            'class' => 'form-control',
                            'required' => true,
                            'readonly' => true
                        ])
                    ?>
                </div>
                <?php __($stock_form->getCol('quantity'))?>
                <?php __($stock_form->getCol('date'))?>
                <?php __($stock_form->getCol('entry_type'))?>

                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary btn-sm">
                </div>
            <?php echo $stock_form->end()?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>