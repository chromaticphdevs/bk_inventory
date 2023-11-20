<?php

    use Services\StockService;
    load(['StockService'], SERVICES);
    
    class StockWeightConsumptionModel extends Model
    {
        public $table = 'stock_weight_consumptions';

        public $_fillables = [
            'item_id',
            'parent_id',
            'parent_key',
            'consumption',
            'weight_unit_id',
            'is_processed'
        ];

        public function add($conspData) {
            $_fillables = parent::getFillablesOnly($conspData);
            $entryID = parent::store($_fillables);

            if($entryID){
                $this->process($conspData['item_id']);
            }
        }
        /**
         * will compute how may packing is consumed
         * by the total weight consumed
         */
        public function computeTotalPackingInWeight($totalWeight, $itemWeight) {
            $totalUsedPacking = floor($totalWeight / $itemWeight);
            return $totalUsedPacking;
        }

        public function process($itemId) {
            $this->db->query(
                "SELECT SUM(consumption) as total_consumption
                    FROM {$this->table}
                        WHERE item_id = '{$itemId}'
                        AND is_processed = false"
            );

            if(!isset($this->itemModel)){
                $this->itemModel = model('ItemModel');
            }
            if(!isset($this->stockModel)){
                $this->stockModel = model('StockModel');
            }

            $item = $this->itemModel->get($itemId);
            $totalConsumption = $this->db->single()->total_consumption ?? 0;
            $date = today();

            if($totalConsumption > 0 && ($totalConsumption > $item->weight)) {
                $remainingConsumption = doubleval($totalConsumption);
                $itemWeight = doubleval($item->weight);
                $deductoToStocks = $this->computeTotalPackingInWeight($remainingConsumption, $itemWeight);
                $updatedRemainingConsumption = $remainingConsumption - ($itemWeight * $deductoToStocks);

                $this->stockModel->createOrUpdate([
                    'item_id' => $itemId,
                    'quantity' => $deductoToStocks,
                    'date' => $date,
                    'entry_origin' => 'BATCH_WEIGHT_CONSUMPTION',
                    'entry_type' => StockService::ENTRY_DEDUCT
                ]);

                $updateAllForProcessing = parent::update([
                    'is_processed' => true
                ], [
                    'item_id' => $itemId
                ]);

                //add new entry
                if($updatedRemainingConsumption) {
                    return parent::store([
                        'item_id' => $itemId,
                        'consumption' => $updatedRemainingConsumption,
                        'weight_unit_id' => $item->weight_unit_id,
                        'is_processed' => false
                    ]);
                }
            }
        }
    }