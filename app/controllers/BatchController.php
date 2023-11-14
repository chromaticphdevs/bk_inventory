<?php 

    class BatchController extends Controller
    {
        private $model;
        private $itemModel, $batchItemModel;

        public function __construct()
        {
            parent::__construct();
            $this->model = model('BatchModel');
            $this->itemModel = model('ItemModel');
            $this->batchItemModel = model('BatchItemModel');
        }

        public function index() {
            $this->data['batches'] = $this->model->all();
            return $this->view('batch/index', $this->data);
        }

        public function create() {
            if(isSubmitted()){
                $post = request()->posts();
                $id = $this->model->create([
                    'batch_name' => $post['batch_name'],
                    'batch_date' => $post['batch_date'],
                ]);

                if($id) {
                    Flash::set("Batch Success");
                    return redirect(_route('batch:index'));
                }
            }
            return $this->view('batch/create', $this->data);
        }

        public function show($id) {
            $batch = $this->model->get($id);
            $this->data['batch'] = $batch;

            if(isSubmitted()) {
                $post = request()->posts();
                $isOkay = $this->batchItemModel->add([
                    'item_id' => $post['item_id'],
                    'batch_id' => $batch->id,
                    'quantity' => $post['quantity']
                ]);

                if($isOkay) {
                    Flash::set($this->batchItemModel->getMessageString(), 'success', 'mess-add-item');
                } else {
                    Flash::set($this->batchItemModel->getErrorString(), 'danger', 'mess-add-item');
                }

                return redirect(_route('batch:show', $id));
            }

            $items = $this->itemModel->all();
            $itemArray = arr_layout_keypair($items, ['id', 'name@variant']);
            
            $batchItems = $this->batchItemModel->getAll();
            $this->data['itemArray'] = $itemArray;
            $this->data['batchItems'] = $batchItems;
            return $this->view('batch/show', $this->data);
        }

        public function edit($id) {
            $batch = $this->model->get($id);
            $this->data['batch'] = $batch;
            return $this->view('batch/edit', $this->data);
        }

        public function delete() {

        }
        
        public function produced($id) {
            if(isSubmitted()) {
                $post = request()->posts();
                $this->model->update([
                    'result_quantity' => $post['result_quantity']
                ], $id);
                Flash::set("Produced Update");
                return redirect(_route('batch:show', $id));
            }
            $this->data['batch'] = $this->model->get($id);
            return $this->view('batch/produced', $this->data);
        }
    }