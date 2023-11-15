<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Item Preview</h4>
            <?php Flash::show()?>   
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('item:edit', $item->id))?>
            <div class="row">
                <div class="col-md-6">
                    <section class="mt-2">
                        <h4>Details</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td><?php echo $item_form->label('name')?></td>
                                    <td><?php echo $item->name?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $item_form->label('packing_id')?></td>
                                    <td><?php echo $item->packing_name?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $item_form->label('weight_unit_id')?></td>
                                    <td><?php echo $item->weight?> <?php echo $item->weight_name?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $item_form->label('variant')?></td>
                                    <td><?php echo $item->variant?> </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>Stock Settings</strong></td>
                                </tr>
                                <tr>
                                    <td>Minimum Stock : </td>
                                    <td><?php echo $item->min_stock?></td>
                                </tr>
                                <tr>
                                    <td>Maximum Stock : </td>
                                    <td><?php echo $item->max_stock?></td>
                                </tr>
                            </table>
                        </div>
                    </section>
                </div>
            </div>

            <div class="mt-5" style="border:1px solid #000; padding:10px">
                <section>
                    <span class="h4">
                        Stocks : <?php echo $item->total_stock?> <?php echo $item->packing_name?>
                        <?php if($item->total_stock < $item->min_stock) :?>
                            <span class="badge bg-danger">Low</span>
                        <?php endif?>
                    </span>
                    <div class="mt-3">
                        <?php 
                            echo wLinkDefault(_route('stock:create', [
                                    'item_id' => $item->id
                            ]), 'Add Stocks'); 
                        ?>
                    </div>
                    <?php if(!empty($stocks)) :?>
                        <?php $weightTotal = 0?>
                        <label for="#">Recent Movement</label>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Date</td>
                                    <td>Quantity</td>
                                    <td><?php echo $item_form->label('packing_id')?></td>
                                    <td><?php echo $item_form->label('weight_unit_id')?></td>
                                    <td><?php echo $item_form->label('weight')?></td>
                                </tr>
                                <tbody>
                                    <?php foreach($stocks as $key => $row):?>
                                        <?php $weightTotal += $row->item_weight * $row->quantity?>
                                        <tr>
                                            <td><?php echo $row->date?></td>
                                            <td><?php echo $row->quantity?></td>
                                            <td><?php echo $row->packing_name?></td>
                                            <td><?php echo $row->item_weight?></td>
                                            <td><?php echo $row->weight_abbr_name?></td>
                                        </tr>
                                    <?php endforeach?>
                                </tbody>
                            </table>
                        </div>
                        <h4 class="mt-3">Total Weight : <?php echo $weightTotal?> <?php echo $item->weight_name?></h4>
                    <?php else:?>
                        <p>No stock logs found.</p>
                    <?php endif?>
                </section>
            </div>
        </div>
    </div>
<?php endbuild() ?>
<?php loadTo()?>