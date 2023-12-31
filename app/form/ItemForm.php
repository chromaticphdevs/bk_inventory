<?php

    namespace Form;

    load(['Form'],CORE);
    load(['ItemService'], SERVICES);

    use Core\Form;
    use Services\ItemService;

    class ItemForm extends Form{
        private $weightUnitModel,$packingUnitModel;
        public function __construct($name = '')
        {
            parent::__construct();
            $this->name = empty($name) ? 'Item Form' : $name;
            $this->weightUnitModel = model('WeightUnitModel');
            $this->packingUnitModel = model('PackingUnitModel');

            $this->addName();
            $this->addSku();
            $this->addBarcode();
            $this->addCostPrice();
            $this->addSellPrice();
            $this->addMinStock();
            $this->addMaxStock();
            $this->addVariant();
            $this->addRemarks();

            $this->addUnit();
            $this->addWeight();

            $this->addPacking();
            $this->addQuantityPerCase();

            $this->customSubmit('Save Item');
        }

        public function addName() {
            $this->add([
                'name' => 'name',
                'type' => 'text',
                'required' => true,
                'options' => [
                    'label' => 'Item Name'
                ],
                'class' => 'form-control'
            ]);
        }

        public function addSku() {
            $this->add([
                'name' => 'sku',
                'type' => 'text',
                'required' => true,
                'options' => [
                    'label' => 'Product Code'
                ],
                'class' => 'form-control'
            ]);
        }

        public function addBarcode() {
            $this->add([
                'name' => 'barcode',
                'type' => 'text',
                'options' => [
                    'label' => 'Barcode'
                ],
                'class' => 'form-control'
            ]);
        }

        public function addCostPrice() {
            $this->add([
                'name' => 'cost_price',
                'type' => 'text',
                'required' => true,
                'options' => [
                    'label' => 'Cost Price'
                ],
                'class' => 'form-control'
            ]);
        }

        public function addSellPrice() {
            $this->add([
                'name' => 'sell_price',
                'type' => 'text',
                'required' => true,
                'options' => [
                    'label' => 'Sell Price'
                ],
                'class' => 'form-control'
            ]);
        }

        public function addMinStock() {
            $this->add([
                'name' => 'min_stock',
                'type' => 'number',
                'required' => true,
                'options' => [
                    'label' => 'Minimum Stocks'
                ],
                'class' => 'form-control'
            ]);
        }

        public function addMaxStock() {
            $this->add([
                'name' => 'max_stock',
                'type' => 'number',
                'required' => true,
                'options' => [
                    'label' => 'Maximum Stocks'
                ],
                'class' => 'form-control'
            ]);
        }


        // public function addCategory() {
            
        //     $categories = $this->categoryModel->all([
        //         'active' => 1,
        //         'category' => CategoryService::ITEM
        //     ],'name asc');
        //     $categories = arr_layout_keypair($categories,['id','name']);
        //     $this->add([
        //         'name' => 'category_id',
        //         'type' => 'select',
        //         'required' => true,
        //         'options' => [
        //             'label' => 'Category',
        //             'option_values' => $categories
        //         ],
        //         'class' => 'form-control'
        //     ]);
        // }


        public function addVariant() {
            $this->add([
                'name' => 'variant',
                'type' => 'text',
                'options' => [
                    'label' => 'Variant'
                ],
                'class' => 'form-control'
            ]);
        }

        public function addRemarks() {
            $this->add([
                'name' => 'remarks',
                'type' => 'textarea',
                'options' => [
                    'label' => 'Remarks',
                    'rows' => 3
                ],
                'class' => 'form-control'
            ]);
        }

        // public function addManufacturer() {
        //     $categories = $this->categoryModel->all([
        //         'active' => 1,
        //         'category' => CategoryService::MANUFACTURER
        //     ],'name asc');

        //     $categories = arr_layout_keypair($categories,['id','name']);
        //     $this->add([
        //         'name' => 'manufacturer_id',
        //         'type' => 'select',
        //         'required' => true,
        //         'options' => [
        //             'label' => 'Manufacturer',
        //             'option_values' => $categories
        //         ],
        //         'class' => 'form-control'
        //     ]);
        // }

        // public function addBrand() {
        //     $categories = $this->categoryModel->all([
        //         'active' => 1,
        //         'category' => CategoryService::BRAND
        //     ],'name asc');
            
        //     $categories = arr_layout_keypair($categories,['id','name']);
        //     $this->add([
        //         'name' => 'brand_id',
        //         'type' => 'select',
        //         'required' => true,
        //         'options' => [
        //             'label' => 'Brand Name',
        //             'option_values' => $categories
        //         ],
        //         'class' => 'form-control'
        //     ]);
        // }

        /**
         * for medical items
         */
        public function addUnit() {
            $weightUnits = $this->weightUnitModel->all();
            $weightUnitsArray = arr_layout_keypair($weightUnits, ['id', 'abbr_name@name']);

            $this->add([
                'name' => 'weight_unit_id',
                'type' => 'select',
                'options' => [
                    'label' => 'Weight Unit',
                    'option_values' => $weightUnitsArray
                ],
                'class' => 'form-control'
            ]);
        }

        public function addPacking() {
            $packingUnits = $this->packingUnitModel->all();
            $packingUnitArray = arr_layout_keypair($packingUnits, ['id', 'name']);

            $this->add([
                'name' => 'packing_id',
                'type' => 'select',
                'options' => [
                    'label' => 'Packing',
                    'option_values' => $packingUnitArray
                ],
                'class' => 'form-control'
            ]);
        }

        public function addWeight() {
            $this->add([
                'name' => 'weight',
                'type' => 'text',
                'options' => [
                    'label' => 'Weight'
                ],
                'class' => 'form-control'
            ]);
        }

        public function addQuantityPerCase() {
            $this->add([
                'name' => 'qty_per_case',
                'type' => 'number',
                'options' => [
                    'label' => 'Quantity Per Case'
                ],
                'class' => 'form-control'
            ]);
        }
    }