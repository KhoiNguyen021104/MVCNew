<?php
class CheckTicket extends Controller
{
    public $data = [];
    public $model_home;
    public function __construct()
    {
        $this->model_home = $this->model('CheckTicketModel');
        $this->data['sub_content'][''] = "";
        $navItem = [
            'Danh mục',
            'Soát vé vào'
        ];
        $navLink = [
            'Tickets',
            'CheckTicket'
        ];
        $this->data['navItem'] = $navItem;
        $this->data['navLink'] = $navLink;
        $this->data['activeTicket'] = true;
    }

    public function index()
    {
        $this->data['title'] = 'Soát vé vào';
        $this->data['content'] = 'admin\tickets\checkTicket\scan';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function handleQrCode()
    {
        $strQuery = $_SERVER['QUERY_STRING'];
        $qrCode = 'qrcode_' . $strQuery . '.png';
        $cnt = $this->model_home->checkExistQr($qrCode);
        if (!$cnt || !(str_contains($strQuery, 'MHDTDBS'))) {
            setFlashData('msg', 'Mã Qr không tồn tại');
            setFlashData('type_msg', 'error');
        } else {
            $bookingId = explode('-', $strQuery)[1];
            $useStatus = $this->model_home->getUseStatus($bookingId)[0]['use_status'];
            if ($useStatus == 0) {
                $this->model_home->updateUseStatus($bookingId);
                setFlashData('msg', 'Vé vào hợp lệ');
                setFlashData('type_msg', 'success');
            } else {
                setFlashData('msg', 'Vé vào đã  sử dụng');
                setFlashData('type_msg', 'error');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
