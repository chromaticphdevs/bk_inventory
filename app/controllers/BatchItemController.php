<?php 

    class BatchItemController extends Controller
    {
        public $table = 'batch_items';

        public function __construct()
        {
            parent::__construct();
            $this->model = model('BatchItemModel');
        }

        public function delete($id) {
            $this->model->delete($id);
            return request()->return();
        }
    }