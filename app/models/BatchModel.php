<?php 

    class BatchModel extends Model
    {
        public $table = 'batches';

        public function create($batchData) {
            $batchData['batch_reference'] = random_number();
            return parent::store($batchData);
        }
    }