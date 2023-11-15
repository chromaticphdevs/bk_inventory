<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Batch Management</h4>
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('batch:index'), 'Batches')?> 
            <?php echo wLinkDefault(_route('batch:edit', $batch->id), 'Edit')?>
            &nbsp;
            <?php 
                if(isEqual($batch->save_status, 'unsaved')) {
                    echo wLinkDefault(_route('batch:save', $batch->id), 'Save', [
                        'class' => 'form-verify',
                    ]);
                } else {
                    echo "<span class='badge bg-success'>Saved</span>";
                }
            ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>Reference</td>
                        <td><?php echo $batch->batch_reference?></td>
                    </tr>
                    <tr>
                        <td>Alias</td>
                        <td><?php echo $batch->batch_name?></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><?php echo $batch->batch_date?></td>
                    </tr>
                    <tr>
                        <td>Box Produced</td>
                        <td>
                            <?php 
                                echo  number_format($batch->result_quantity,0) . '&nbsp;';
                                if(is_null($batch->result_quantity)) {
                                    echo wLinkDefault(_route('batch:produced', $batch->id), 'Add Batch Produced');
                                } else {
                                    echo wLinkDefault(_route('batch:produced', $batch->id), 'Update Batch');
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card-body">
            <?php if(isEqual($batch->save_status, 'unsaved')) :?>
            <section class="mb-3">
                <?php
                    Form::open([
                        'method' => 'post'
                    ])
                ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php
                                    echo $itemForm->label('name');
                                    Form::select('item_id', $itemArray, '',[
                                        'class' => 'form-control',
                                        'required' => true,
                                        'id' => 'item_id'
                                    ])
                                ?>
                                <small>Info. abcd</small>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?php
                                    Form::label('Quantity');
                                    Form::text('quantity', '',[
                                        'class' => 'form-control',
                                        'required' => true
                                    ])
                                ?>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <?php
                                    echo $itemForm->label('packing_id');
                                    Form::text('', '', [
                                        'class' => 'form-control',
                                        'readonly' => true,
                                        'id' => 'packing_id'
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <?php
                                    echo $itemForm->label('weight_unit_id');
                                    Form::text('', '', [
                                        'class' => 'form-control',
                                        'readonly' => true,
                                        'id' => 'weight_unit_id'
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <?php
                                    echo $itemForm->label('weight');
                                    Form::text('', '', [
                                        'class' => 'form-control',
                                        'readonly' => true,
                                        'id' => 'weight'
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?php
                                    Form::label('Save');
                                    Form::submit('add_item', 'Add Item', [
                                        'style' => 'display:block',
                                        'class' => 'btn btn-primary btn-sm'
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                <?php Form::close()?>
            </section>
            <?php endif?>

            <?php Flash::show('mess-add-item')?>

            <?php echo wDivider() ?>

            <div class="table-responsive">
                <table class="table-bordered table">
                    <tr>
                        <td><?php echo $itemForm->label('name')?></td>
                        <td>Quantity</td>
                        <td><?php echo $itemForm->label('packing_id')?></td>
                        <td><?php echo $itemForm->label('weight_unit_id')?></td>
                        <td><?php echo $itemForm->label('weight')?></td>
                        <td>Consp</td>
                        <?php if(isEqual($batch->save_status, 'unsaved')) :?>
                        <td>Action</td>
                        <?php endif?>
                    </tr>

                    <?php foreach($batchItems as $key => $row) :?>
                        <tr>
                            <td><?php echo $row->item_name?></td>
                            <td><?php echo $row->quantity?></td>
                            <td><?php echo $row->packing_name?></td>
                            <td><?php echo $row->weight_unit_name?></td>
                            <td><?php echo $row->weight?></td>
                            <td><?php echo ($row->weight * $row->quantity) . ' '.$row->weight_unit_name?></td>
                            <?php if(isEqual($batch->save_status, 'unsaved')) :?>
                            <td><?php echo wLinkDefault(_route('batch-item:delete', $row->id), 'Delete')?></td>
                            <?php endif?>
                        </tr>
                    <?php endforeach?>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts') ?>
    <script>
        $(document).ready(function(){
            const itemSelect = $('#item_id');
            itemSelect.change(function(){
                let itemId = $(this).val();

                if(itemId.empty) {
                    $('#unit').val('');
                } else {
                    $.ajax({
                        type: 'get',
                        url: getURL('api/item/get'),
                        data: {
                            id : itemId
                        },
                        success: function(response){
                            let responseData = JSON.parse(response);
                            $('#packing_id').val(responseData.item.packing_name);
                            $('#weight_unit_id').val(responseData.item.weight_name);
                            $('#weight').val(responseData.item.weight);
                        }
                    })
                }
            });

        });
    </script>
<?php endbuild()?>
<?php loadTo()?>