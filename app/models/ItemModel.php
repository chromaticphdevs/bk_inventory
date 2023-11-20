<?php
    load(['CategoryService'],SERVICES);
    use Services\CategoryService;

    class ItemModel extends Model
    {
        public $table = 'items';
        public $_fillables = [
            'name',
            'sku',
            'min_stock',
            'max_stock',
            'category_id',
            'weight_unit_id',
            'weight',
            'packing_id',
            'variant',
            'remarks',
            'is_visible',
        ];
        
        public function createOrUpdate($itemData, $id = null) {
            $retVal = null;
            $_fillables = $this->getFillablesOnly($itemData);

            if (!is_null($id)) {
                $this->addMessage("Item Updated");
                $retVal = parent::update($_fillables, $id);
            } else {
                $_fillables['sku'] = random_number(8);
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
            if(is_array($id)) {
                return $this->getAll([
                    'where' => $id
                ]);
            }
            
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
                "SELECT item.*, ifnull(stock.total_stock, 'No Stock') as total_stock,
                    mu.name as measurement_name,
                    pu.name as packing_name
                    FROM {$this->table} as item 

                    LEFT JOIN measurement_units as mu
                        ON mu.id = item.measurement_unit_id

                    LEFT JOIN packing_units as pu
                        ON pu.id = item.packing_id

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
                    ifnull(stock.total_stock, 'No Stock') as total_stock,
                    wu.name as weight_name, wu.abbr_name as weight_abbr_name,
                    pu.name as packing_name

                    FROM {$this->table} as item

                    LEFT JOIN weight_units as wu
                        ON wu.id = item.weight_unit_id

                    LEFT JOIN packing_units as pu
                        ON pu.id = item.packing_id

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
