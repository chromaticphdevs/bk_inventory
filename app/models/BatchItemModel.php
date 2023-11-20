<?php

    use Services\StockService;
    load(['StockService'], SERVICES);

    class BatchItemModel extends Model
    {
        public $table = 'batch_items';
        private $stockWeightConsumptionModel;

        public function add($batchData) {
            
            if(!isset($this->itemModel)){
                $this->itemModel = model('ItemModel');
            }
            $item = $this->itemModel->get($batchData['item_id']);

            if(!isset($this->stockWeightConsumptionModel)) {
                $this->stockWeightConsumptionModel = model('StockWeightConsumptionModel');
            }
            $consumption  = $batchData['consumption'];

            if(isEqual($consumption['consp_type'], 'weight')) {
                $consumptionByWeight = $consumption['consp_by_weight'];
                $id = $this->stockWeightConsumptionModel->store([
                    'item_id' => $batchData['item_id'],
                    'consumption' => $consumptionByWeight,
                    'weight_unit_id' => $item->weight_unit_id,
                    'is_processed' => false
                ]);

                if($id) {
                    $this->stockWeightConsumptionModel->process($batchData['item_id']);
                }
            } else {
                if(!isset($this->stockModel)) {
                    $this->stockModel = model('StockModel');
                }
                $this->stockModel->createOrUpdate([
                    'item_id' => $batchData['item_id'],
                    'quantity' => $consumption['consp_per_packing'],
                    'entry_type' => StockService::ENTRY_DEDUCT,
                    'entry_origin' => 'BATCH_CREATE',
                    'date' => today()
                ]);
            }


            $batchItem = parent::single([
                'batch_id' => $batchData['batch_id'],
                'item_id'  => $batchData['item_id']
            ]);


            if($batchItem) {
                if(isEqual($consumption['consp_type'], 'weight')) {
                    $newWeight = $batchItem->total_weight + floatval($consumption['consp_by_weight']);
                    //get total weight
                    $totalPackingUsed = $this->stockWeightConsumptionModel->computeTotalPackingInWeight($newWeight, $item->weight);

                    return parent::update([
                        'quantity' => $totalPackingUsed,
                        'total_weight' => $newWeight
                    ], $batchItem->id);
                } else {
                    $newQuantity = $batchItem->quantity + $consumption['consp_per_packing'];
                    return parent::update([
                        'quantity' => $newQuantity,
                        'total_weight' => $newQuantity * $item->weight
                    ], $batchItem->id);
                }
                $this->addMessage("Batch updated successfully");
            } else {
                $this->addMessage("Batch created");
                if(isEqual($consumption['consp_type'], 'weight')) {
                    $batchSaveData = [
                        'quantity' => $this->stockWeightConsumptionModel->computeTotalPackingInWeight(floatval($consumption['consp_by_weight']), $item->weight),
                        'total_weight'   => floatval($consumption['consp_by_weight']),
                        'item_id' => $batchData['item_id'],
                        'batch_id' => $batchData['batch_id']
                    ];
                } else {
                    $batchSaveData = [
                        'quantity' => $consumption['consp_per_packing'],
                        'total_weight'   => $consumption['consp_per_packing'] * $item->weight,
                        'item_id' => $batchData['item_id'],
                        'batch_id' => $batchData['batch_id']
                    ];
                }
                return parent::store($batchSaveData);
            }
        }


        public function get($id) {
            if(is_array($id)) {
                return $this->getAll([
                    'where' => $id
                ])[0] ?? false;
            }

            return $this->getAll([
                'where' => [
                    'batch_items.id' => $id
                ]
            ])[0] ?? false;
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