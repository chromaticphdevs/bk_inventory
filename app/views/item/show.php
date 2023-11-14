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
                    <section>
                        <h4>Details</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Name : </td>
                                    <td><?php echo $item->name?></td>
                                </tr>
                                <tr>
                                    <td>Minimum Stock : </td>
                                    <td><?php echo $item->min_stock?> <?php echo $item->unit?></td>
                                </tr>
                                <tr>
                                    <td>Maximum Stock : </td>
                                    <td><?php echo $item->max_stock?> <?php echo $item->unit?></td>
                                </tr>
                                <tr>
                                    <td>Variant : </td>
                                    <td><?php echo $item->variant?> </td>
                                </tr>
                                <tr>
                                    <td>Remarks : </td>
                                    <td><?php echo $item->remarks?></td>
                                </tr>
                            </table>
                        </div>
                    </section>
                </div>
            </div>

            <div class="mt-2" style="border:1px solid #000; padding:10px">
                <section>
                    <h4>Stocks : <?php echo $item->total_stock?></h5></h4>
                    <div><?php 
                        echo wLinkDefault(_route('stock:create', [
                                'item_id' => $item->id
                        ]), 'Add Stocks'); 
                    ?></div>
                    <?php if(!empty($stocks)) :?>
                        <label for="#">Recent Movement</label>
                        <table class="table">
                            <tr>
                                <td>Date</td>
                                <td>Quantity</td>
                            </tr>
                            <tbody>
                                <?php foreach($stocks as $key => $row):?>
                                    <tr>
                                        <td><?php echo $row->date?></td>
                                        <td><?php echo $row->quantity?> (<?php echo $item->unit?>)</td>
                                    </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    <?php else:?>
                        <p>No stock logs found.</p>
                    <?php endif?>
                </section>
            </div>
        </div>
    </div>
<?php endbuild() ?>
<?php loadTo()?>