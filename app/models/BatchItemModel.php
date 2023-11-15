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
            $where = null;
            $order = null;
            $limit = null;

            if(!empty($params['where'])) {
                $where = " WHERE ".parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {$params['order']}";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT {$params['limit']}";
            }
            $this->db->query(
                "SELECT {$this->table}.*, item.name as item_name,
                    sku,weight,weight_unit_id,
                    wu.name as weight_unit_name,
                    packing_id, pu.name as packing_name,
                    variant 
                    FROM {$this->table}

                    LEFT JOIN items as item
                        ON {$this->table}.item_id = item.id
                    LEFT JOIN weight_units as wu
                        ON wu.id = item.weight_unit_id
                    LEFT JOIN packing_units as pu
                        ON pu.id = item.packing_id  
                    {$where} {$order} {$limit}  
                "
            );

            return $this->db->resultSet();
        }
    }