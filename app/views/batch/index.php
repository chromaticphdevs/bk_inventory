<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Batch Management</h4>
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('batch:create'), 'Create New Batch') ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Reference</th>
                        <th>Batch Name</th>
                        <th>Batch Date</th>
                        <th>Result Quantity</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($batches as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->batch_reference?></td>
                                <td><?php echo $row->batch_name?></td>
                                <td><?php echo $row->batch_date?></td>
                                <td><?php echo number_format($row->result_quantity,0)?>  Boxes</td>
                                <td>
                                    <?php echo wLinkDefault(_route('batch:edit', $row->id), 'Edit')?>
                                    <?php echo wLinkDefault(_route('batch:show', $row->id), 'Show')?>
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