<?php
    use Form\ItemForm;
    use Form\StockForm;
    load(['StockForm', 'ItemForm'], APPROOT.DS.'form');

    class StockController extends Controller
    {
        public function __construct()
        {
            $this->data['stock_form'] = new StockForm();
            $this->data['item_form']  = new ItemForm();
            $this->model = model('StockModel');
            $this->itemModel = model('ItemModel');
        }
        public function index() {
            $this->data['stocks'] = $this->model->getProductLogs([
                'order' => 'stock.id desc'
            ]);
            return $this->view('stock/index', $this->data);
        }

        public function addStock() {
            $request = request()->inputs();

            if(isSubmitted()) {
                $post = request()->posts();
                $res = $this->model->createOrUpdate($post);

                if($res) {
                    Flash::set("Stock added");
                    return redirect(_route('item:show', $request['item_id']));
                } else {
                    Flash::set($this->model->getErrorString(), 'danger');
                    return request()->return();
                }
            }

            if(!isset($request['item_id'])) {
                Flash::set("Invalid Request",'danger');
                csrfValidate();
            }
            $item = $this->itemModel->get($request['item_id']);
            $this->data['item'] = $item;
            $this->data['stock_form']->setValue('item_id', $request['item_id']);
            return $this->view('stock/add_stock', $this->data);
        }

        public function log() {
            $request = request()->inputs();

            if (isset($request['item_id'])) {
                $logs = $this->model->getProductLogs($request['item_id']);
            } else {
                $logs = $this->model->all(null,'id desc');
            }

            $this->data['logs'] = $logs;
            return $this->view('stock/logs', $this->data);
        }
    }