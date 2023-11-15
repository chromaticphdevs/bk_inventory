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
                    <div class="col-md-7 mt-5">
                        <section class="mb-3">
                            <h5>Item Detail</h5>
                            <div class="form-group">
                                <?php __($item_form->getCol('name'))?>
                            </div>
                            <div class="form-group">
                                <div class="col"><?php __($item_form->getCol('packing_id'))?></div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-md-9"><?php __($item_form->getCol('weight'))?></div>
                                <div class="col-md-3"><?php __($item_form->getCol('weight_unit_id'))?></div>
                            </div>
                            <div class="form-group"><?php __($item_form->getCol('variant'))?></div>
                        </section>

                        <section class="mt-5">
                            <h5>Stock Settings</h5>
                            <div class="row">
                                <div class="col"><?php __($item_form->getCol('min_stock'))?></div>
                                <div class="col"><?php __($item_form->getCol('max_stock'))?></div>
                            </div>
                        </section>

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