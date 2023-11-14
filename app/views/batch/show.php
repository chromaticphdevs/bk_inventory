<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Batch Management</h4>
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('batch:index'), 'Batches')?> &nbsp;
            <?php echo wLinkDefault(_route('batch:edit', $batch->id), 'Edit')?>
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
                                    Form::label('Item');
                                    Form::select('item_id', $itemArray, '',[
                                        'class' => 'form-control',
                                        'required' => true,
                                        'id' => 'item_id'
                                    ])
                                ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <?php
                                    Form::label('Quantity');
                                    Form::number('quantity', '',[
                                        'class' => 'form-control',
                                        'required' => true
                                    ])
                                ?>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <?php
                                    Form::label('Unit');
                                    Form::text('', '', [
                                        'class' => 'form-control',
                                        'readonly' => true,
                                        'id' => 'unit'
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

            <?php Flash::show('mess-add-item')?>

            <?php echo wDivider() ?>

            <div class="table-responsive">
                <table class="table-bordered table">
                    <tr>
                        <td>Item</td>
                        <td>Unit</td>
                        <td>Quantity</td>
                    </tr>

                    <?php foreach($batchItems as $key => $row) :?>
                        <tr>
                            <td><?php echo $row->name?></td>
                            <td><?php echo $row->unit?></td>
                            <td><?php echo $row->quantity?></td>
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
                            $('#unit').val(responseData.item.unit)
                        }
                    })
                }
            });

        });
    </script>
<?php endbuild()?>
<?php loadTo()?>