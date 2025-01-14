<?php
class SendMailBooking extends Controller
{
    public $data = [];
    public $model_home;
    public function __construct()
    {
        $this->model_home = $this->model('SendMailBookingModel');
        $this->data['sub_content'][''] = "";
    }
    public function index()
    {
        $toMail = $_POST['mailCustomer'];
        $bookingId = $this->model_home->getBookingId($toMail)[0]['booking_id'];
        $subject = 'XÁC NHẬN ĐẶT VÉ KHU VUI CHƠI GIẢI TRÍ THIÊN ĐƯỜNG BẢO SƠN';
        $content = "Dưới đây là đường link xác nhận đặt vé của bạn, vui lòng nhấn vào đường link để hoàn tất thủ tục đặt vé!
        <br>
        Link: http://localhost/MVCNew/clients/End?id=$bookingId";
        sendMail($toMail, $subject, $content);
        redirect($_SERVER['HTTP_REFERER']);
    }
}

