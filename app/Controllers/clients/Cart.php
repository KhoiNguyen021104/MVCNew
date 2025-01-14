<?php
class Cart extends Controller
{
    public $data = [];
    public $model_home;

    public function __construct()
    {
        $this->model_home = $this->model('CartModel');
        $this->data['sub_content'][''] = "";

    }

    public function index()
    {
        $userId = getFlashData('userIdLogin');
        setFlashData('userIdLogin',$userId);
        $userModel = $this->model('UserModel');
        $userInfo = $userModel->detailUser($userId);
        $this->data['sub_content']['userInfo'] = $userInfo;

        $bookingData = $this->model_home->getAllBooking($userId);
        $this->data['sub_content']['bookingData'] = $bookingData;

        $this->data['title'] = 'Giỏ hàng';
        $this->data['content'] = 'clients\Book_tickets\cart';
        $this->render('layouts/ticket_layout', $this->data);
    }
}
?>