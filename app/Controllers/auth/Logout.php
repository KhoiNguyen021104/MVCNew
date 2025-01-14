<?php
class Logout extends Controller
{
    public $data = [];
    public $model_home;
    public function __construct()
    {
        $this->model_home = $this->model('LogoutModel');
        $this->data['sub_content'][''] = "";
    }
    public function index()
    {
        if (isset(explode("=", $_SERVER['QUERY_STRING'])[1])) {
            $id = explode("=", $_SERVER['QUERY_STRING'])[1];
            $accountModel = $this->model('AccountModel');
            $username = $accountModel->getUsernameByUserId($id)[0]['username'];
            $this->model_home->setTokenLogin($username);
            session_destroy();
        } else {
            $this->model_home->setTokenLogin($_SERVER['QUERY_STRING']);
        }
        redirect(_HOST_PATH_ . '/auth/login');
    }
}
