<?php
    load(['CategoryService'],SERVICES);
    use Services\CategoryService;

    class ItemModel extends Model
    {
        public $table = 'items';
        public $_fillables = [
            'name',
            'sku',
            'barcode',
            'cost_price',
            'sell_price',
            'min_stock',
            'max_stock',
            'category_id',
            'variant',
            'remarks',
            'is_visible',
            'unit',

        ];
        
        public function createOrUpdate($itemData, $id = null) {
            $retVal = null;
            $_fillables = $this->getFillablesOnly($itemData);
            $item = $this->getItemByUniqueKey(random_number(), $itemData['name'], $id);

            if (!is_null($id)) {
                if($item && ($item->id != $id)) {
                    $this->addError("SKU Or Name Already exists");
                    return false;
                }
                $this->addMessage("Item Updated");
                $retVal = parent::update($_fillables, $id);
            } else {
                if($item) {
                    $this->addError("SKU Or Name Already exists");
                    return false;
                }
                $retVal = parent::store($_fillables);
            }

            return $retVal;
        }

        public function getImages($id) {
            return [];
        }


        private function getItemByUniqueKey($sku,$name, $id = null) {
            $product = parent::single([
                'sku' => [
                    'condition' => 'equal',
                    'value' => $sku,
                    'concatinator' => 'OR'
                ]
            ]);
            if($product->id == $id) {
                return false;
            }return true;
        }

         /**
         * override Model:get
         */
        public function get($id) {
            return $this->getAll([
                'where' => [
                    'item.id' => $id
                ]
            ])[0] ?? false;
        }

        /**
         * override Model:all
         */
        public function all($where = null , $order_by = null , $limit = null) {
            $productQuantitySQL = $this->_productTotalStockSQLSnippet();

            if(!is_null($where)) {
                $where = " WHERE " . parent::conditionConvert($where);
            }

            if(!is_null($order_by)) {
                $order_by = " ORDER BY {$order_by} ";
            }

            $this->db->query(
                "SELECT item.*, ifnull(stock.total_stock, 'No Stock') as total_stock
                    FROM {$this->table} as item 
                    LEFT JOIN ($productQuantitySQL) as stock
                    ON stock.item_id = item.id
                    {$where} {$order_by} {$limit}"
            );

            return $this->db->resultSet();
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            $productQuantitySQL = $this->_productTotalStockSQLSnippet();

            if(!empty($params['where'])) {
                $where = ' WHERE '.parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = ' ORDER BY '.$params['order'];
            }

            if(!empty($params['limit'])) {
                $limit = ' LIMIT '.$params['limit'];
            }

            $this->db->query(
                "SELECT item.*,
                    ifnull(stock.total_stock, 'No Stock') as total_stock
                    FROM {$this->table} as item


                    LEFT JOIN ($productQuantitySQL) as stock
                    ON stock.item_id = item.id
                    
                    {$where} {$order} {$limit} "
            );

            $items = $this->db->resultSet();
            
            foreach($items as $key => $row) {
                $row->images = $this->getImages($row->id);
            }
            
            return $items;
        }

        private function _productTotalStockSQLSnippet() {
            return "SELECT SUM(quantity) as total_stock ,item_id
            FROM stocks 
            GROUP BY item_id";
        }

        public function totalItem() {
            $this->db->query(
                "SELECT count(id) as total_item
                    FROM {$this->table}"
            );
            return $this->db->single()->total_item ?? 0;
        }
    }
