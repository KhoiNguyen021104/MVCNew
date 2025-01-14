<?php
class Checkout extends Controller
{
    public $data = [];
    public $model_home;

    public function __construct()
    {
        // $this->model_home = $this->model('TicketsModel');
        $this->data['sub_content'][''] = "";

    }

    public function index()
    {
        $userId = getFlashData('userIdLogin');
        setFlashData('userIdLogin',$userId);
        $userModel = $this->model('UserModel');
        $userInfo = $userModel->detailUser($userId);
        $this->data['sub_content']['userInfo'] = $userInfo;
        $this->data['title'] = 'Thanh toán';
        $this->data['content'] = 'clients/Book_tickets/checkout';
        $this->render('layouts/ticket_layout', $this->data);
    }
}
?>