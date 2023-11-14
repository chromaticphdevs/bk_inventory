<?php

    use Form\UserForm;
    load(['UserForm'], APPROOT.DS.'form');

    class UserController extends Controller
    {
        private $user_form, $model;

        public function __construct()
        {
            parent::__construct();
            $this->user_form = new UserForm();    
            $this->model = model('UserModel');
        }
        
        public function index() {
            $users = $this->model->getAll();
            $this->data['users'] = $users;
            return $this->view('user/index', $this->data);
        }

        public function create() {
            if(isSubmitted()) {
                $post = request()->posts();
                $isOkay = $this->model->create($post);

                if($isOkay) {
                    Flash::set($this->model->getMessageString(), 'success', 'create-user');
                } else {
                    Flash::set($this->model->getErrorString(), 'success', 'create-user');
                }

                return redirect(_route('user:index'));
            }
            $this->data['user_form'] = $this->user_form;
            return $this->view('user/create', $this->data);
        }

        public function edit($id) {
            $user = $this->model->get($id);
            if(isSubmitted()) {
                $post = request()->posts();
                $this->model->update($post, $id);
                Flash::set('User Updated');
                return redirect(_route('user:index'));
            }
            $this->data['user'] = $user;
            $this->user_form->setValueObject($user);
            $this->data['user_form'] = $this->user_form;
            return $this->view('user/edit', $this->data);
        }

        public function show($id) {

        }
    }