<?php 
    namespace Services;

    class ItemService {
        const CATEGORY = 'ITEMS';

        public static function packing() {
            return [
                'per_sack' => 'Per Sack',
                'per_item' => 'Per Item'
            ];
        }
    }