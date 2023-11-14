<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Batch Management</h4>
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('batch:index'), 'Batches')?> &nbsp;
            <?php echo wLinkDefault(_route('batch:show', $batch->id), 'View Batch')?>
            <?php Form::open([
                'method' => 'post'
            ])?>
                <div class="form-group">
                    <?php 
                        Form::label('Reference');
                        Form::text('', $batch->batch_reference, [
                            'class' => 'form-control',
                            'readonly' => true
                        ]);
                    ?>
                </div>
                <div class="form-group mb-2">
                    <?php
                        Form::label('Batch Alias');
                        Form::text('batch_name', $batch->batch_name, [
                            'class' => 'form-control',
                            'required' => true
                        ])
                    ?>
                </div>

                <div class="form-group mb-3">
                    <?php
                        Form::label('Date');
                        Form::date('batch_date', $batch->batch_date, [
                            'class' => 'form-control',
                            'required' => true
                        ])
                    ?>
                </div>

                <div class="form-group">
                    <?php Form::submit('', 'Update Batch')?>
                </div>
            <?php Form::close()?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>