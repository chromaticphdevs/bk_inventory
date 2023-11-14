<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Produced</h4>
            <?php echo wLinkDefault(_route('batch:show', $batch->id), 'Back to Batch') ?>
        </div>

        <div class="card-body">
            <div class="col-md-5">
                <?php
                    Form::open([
                        'method' => 'post'
                    ])
                ?>
                    <div class="form-group mb-3">
                        <?php
                            Form::label('Number of boxes Produced');
                            Form::text('result_quantity', $batch->result_quantity, [
                                'class' => 'form-control',
                                'required' => true
                            ])
                        ?>
                    </div>

                    <div class="form-group">
                        <?php Form::submit('btn_boxes_produced', 'Save Changes')?>
                    </div>
                <?php Form::close()?>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>