<?php 

    class Item extends Controller
    {
        private $itemModel;

        public function __construct()
        {
            parent::__construct();
            $this->itemModel = model('ItemModel');
        }
        public function get(){
            $req = request()->inputs();
            $item = $this->itemModel->get($req['id']);
            echo json_encode([
                'item' => $item
            ]);
        }
    }