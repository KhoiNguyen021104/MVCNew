<?php
class Home extends Controller
{
    public $data = [];
    public $model_home;
    public function __construct()
    {
        $this->model_home = $this->model('HomeModel');
        $navItem = [
            'Tài khoản'
        ];
        $navLink = [
            'Account'
        ];
        $this->data['navItem'] = $navItem;
        $this->data['navLink'] = $navLink;
        $this->data['sub_content'][''] = "";
        $this->data['activeAccount'] = true;
    }

    public function index()
    {
        $condition = '';
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                if (empty($value))
                    continue;
                if (is_string($value)) {
                    $condition .= $key . "='" . $value . "' and ";
                } else if (is_numeric($value)) {
                    $condition .= $key . "=" . $value . " and ";
                }
            }
        }
        $condition = rtrim($condition, ' and ');
        // $listAccount = $this->model_home->getAllAccount($condition);
        $this->data['content'] = 'admin\account\list';
        $this->data['title'] = 'Quản lí tài khoản';
        // $this->data['sub_content']['listAccount'] = $listAccount;
        $this->render('layouts/admin_layout', $this->data);
    }
}
