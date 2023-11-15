<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Items</h4>
            <?php echo wLinkDefault(_route('item:create'), 'Add New Item')?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                        <th>#</th>
                        <th><?php echo $item_form->label('variant')?></th>
                        <th><?php echo $item_form->label('name')?></th>
                        <th>Stock</th>
                        <th><?php echo $item_form->label('packing_id')?></th>
                        <th>Min Stock</th>
                        <th><?php echo $item_form->label('weight')?></th>
                        <th><?php echo $item_form->label('weight_unit_id')?></th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($items as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->variant?></td>
                                <td><?php echo $row->name?></td>
                                <td>
                                    <?php
                                        if($row->total_stock < $row->min_stock) {
                                            echo "<span class='badge bg-danger'>{$row->total_stock}</span>";
                                        } else {
                                            echo "<span>{$row->total_stock}</span>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $row->packing_name?></td>
                                <td><?php echo $row->min_stock?></td>
                                <td><?php echo $row->weight?></td>
                                <td><?php echo $row->weight_abbr_name?></td>
                                <td>
                                    <?php 
                                        $anchor_items = [
                                            [
                                                'url' => _route('item:show' , $row->id),
                                                'text' => 'View',
                                                'icon' => 'eye'
                                            ],

                                            [
                                                'url' => _route('item:edit' , $row->id),
                                                'text' => 'Edit',
                                                'icon' => 'edit'
                                            ]
                                        ];
                                    echo anchorList($anchor_items)?>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>