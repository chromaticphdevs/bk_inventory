<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stock Management</h4>
        </div>

        <div class="card-body">
            <?php echo $stock_form->start()?>
                <?php echo Form::hidden('item_id', $item->id);?>
                <div class="form-group">
                    <?php
                        echo $item_form->label('name');
                        echo Form::text('', $item->name, [
                            'class' => 'form-control',
                            'readonly' => true
                        ])
                    ?>
                </div>
                <div class="form-group mt-2">
                    <div class="row">
                        <div class="col-md-6"><?php __($stock_form->getCol('quantity'))?></div>
                        <div class="col-md-6">
                            <?php
                                echo $item_form->label('packing_id');
                                Form::text('', $item->packing_name, [
                                    'class' => 'form-control',
                                    'required' => true,
                                    'readonly' => true
                                ])
                            ?>
                        </div>
                    </div>
                </div>
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