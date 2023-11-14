<?php 
    class BatchItemModel extends Model
    {
        public $table = 'batch_items';

        public function add($batchData) {
            $batchItem = parent::single([
                'batch_id' => $batchData['batch_id'],
                'item_id'  => $batchData['item_id']
            ]);

            if($batchItem) {
                $this->addMessage("Batch updated successfully");
                return parent::update([
                    'quantity' => $batchItem->quantity + $batchData['quantity']
                ], $batchItem->id);
            } else {
                $this->addMessage("Batch created");
                return parent::store($batchData);
            }
        }

        public function getAll($params = []) {
            $this->db->query(
                "SELECT {$this->table}.*, name,
                    sku,unit,variant FROM {$this->table}
                    LEFT JOIN items as item
                        ON {$this->table}.item_id = item.id"
            );

            return $this->db->resultSet();
        }
    }