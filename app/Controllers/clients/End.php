<?php
class End extends Controller
{
    public $data = [];
    public $model_home;

    public function __construct()
    {
        $this->model_home = $this->model('EndModel');
        $this->data['sub_content'][''] = "";
    }

    public function index()
    {
        $bookingId = explode('=',$_SERVER['REDIRECT_QUERY_STRING'])[1];
        $bookingInfo = $this->model_home->getBookingInfo($bookingId);
        $this->data['sub_content']['bookingInfo'] = $bookingInfo;
        $this->data['title'] = 'Thanh toán thành công';
        $this->data['content'] = 'clients/Book_tickets/end';
        $this->render('layouts/ticket_layout', $this->data);
    }
}
?>