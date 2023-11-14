<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Item</h4>
            <?php Flash::show()?>
        </div>
        <div class="card-body">
            <?php echo wLinkDefault(_route('item:index'), 'List of Items')?>
            <?php echo $item_form->start()?>
                <div class="row">
                    <div class="col-md-7">
                        <?php __($item_form->getCol('name'))?>
                        <div class="row">
                            <div class="col"><?php __($item_form->getCol('unit'))?></div>
                        </div>

                        <div class="row">
                            <div class="col"><?php __($item_form->getCol('min_stock'))?></div>
                            <div class="col"><?php __($item_form->getCol('max_stock'))?></div>
                        </div>
                        <div class="row">
                            <div class="col"><?php __($item_form->getCol('variant'))?></div>
                        </div>

                        <div class="mt-3"><?php __($item_form->getCol('submit'))?></div>
                    </div>
                </div>
            <?php echo $item_form->end();?>
        </div>
    </div>
<?php endbuild()?>
<script>
    $(document).ready(function() {
        $(body).on('submit', function() {
            alert('submit?');
        });
    });
</script>
<?php loadTo()?>