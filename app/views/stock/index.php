<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stocks</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Packing</th>
                        <th>Date</th>
                    </thead>

                    <tbody>
                        <?php foreach($stocks as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->item_name?></td>
                                <td><?php echo $row->quantity?></td>
                                <td><?php echo $row->packing_name?></td>
                                <td><?php echo $row->date?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>