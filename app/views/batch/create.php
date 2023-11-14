<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Batch Management</h4>
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('batch:index'), 'Batch list') ?>
            <?php Form::open([
                'method' => 'post'
            ])?>
                <div class="form-group mb-2">
                    <?php
                        Form::label('Batch Alias');
                        Form::text('batch_name', '', [
                            'class' => 'form-control',
                            'required' => true
                        ])
                    ?>
                </div>

                <div class="form-group mb-3">
                    <?php
                        Form::label('Date');
                        Form::date('batch_date', '', [
                            'class' => 'form-control',
                            'required' => true
                        ])
                    ?>
                </div>

                <div class="form-group">
                    <?php Form::submit('', 'Create Batch')?>
                </div>
            <?php Form::close()?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>