<?php
class RentDevice extends Controller
{
    public $data = [];
    public $model_home;

    public $deviceModel;
    public function __construct()
    {
        $this->model_home = $this->model('RentDeviceModel');
        $this->data['sub_content'][''] = "";
        $navItem = [
            'Kho thiết bị',
            'Cho thuê',
            'Danh sách khách hàng thuê đồ',
        ];
        $navLink = [
            'Devices',
            'RentDevice',
            'RentDevice/getCusRent',
        ];
        $this->deviceModel = $this->model('DeviceModel');
        $this->data['navItem'] = $navItem;
        $this->data['navLink'] = $navLink;
        $this->data['activeDevices'] = true;
    }

    public function index()
    {
        $condition = " quantity > quantity_rented";
        $devicesList = $this->deviceModel->getAllDevices($condition);
        $this->data['sub_content']['devicesList'] = $devicesList;
        $this->data['title'] = 'Cho thuê thiết bị, dụng cụ';
        $this->data['content'] = 'admin\services\rentDevices\rent';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function getBillRent()
    {
        $id = getIdObject();
        $rentStatus = $this->model_home->getStatusSlip($id);
        if ($rentStatus) {
            $msg = 'Đồ đã được trả';
            $type_msg = 'info';
            setFlashData('msg', $msg);
            setFlashData('type_msg', $type_msg);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $slip = $this->model_home->getBillRent($id);
            $this->data['sub_content']['slip'] = $slip;
            $this->data['title'] = 'Hóa đơn thuê thiết bị, dụng cụ';
            $this->data['content'] = 'admin\services\rentDevices\billRent';
            $this->render('layouts/admin_layout', $this->data);
        }
    }

    public function rentDevice()
    {
        $filterAll = filter();
        $checkEmpty = 0;
        foreach ($filterAll as $key => $value) {
            if (str_contains($key, 'quantity_rent')) {
                if (!empty($value)) $checkEmpty = 1;
            }
        }
        if (!$checkEmpty) {
            setFlashData('quantity_rent', 'Vui lòng nhập số lượng đồ cần thuê.');
            $msg = 'Thuê thiết bị thất bại';
            $type_msg = 'error';
        } else {
            unset($filterAll['rent_name']);
            unset($filterAll['rent_phone']);
            unset($filterAll['rent_id_number']);
            unset($filterAll['rent_address']);
            foreach ($filterAll as $key => $value) {
                if (empty($value) || $value < 1) {
                    unset($filterAll[$key]);
                }
            }
            $slip = [
                'rent_name' => filter()['rent_name'],
                'rent_phone' => filter()['rent_phone'],
                'rent_id_number' => filter()['rent_id_number'],
                'rent_address' => filter()['rent_address'],
                'time_rent' => date('Y-m-d H:i:s')
            ];
            $check = true;
            if ($this->model_home->addRentSlip($slip)) {
                foreach ($filterAll as $key => $value) {
                    $lastSlipId = $this->model_home->getLastSlipId();
                    $deviceId = explode('-', $key)[1];
                    $slipDetail = [
                        'rental_slip_id' => $lastSlipId[0]['rental_slip_id'],
                        'device_id' => $deviceId,
                        'quantity_rent' => $value
                    ];
                    if (!($this->model_home->addRentSlipDetail($slipDetail))) {
                        $check = false;
                    }

                    // update quantity rented device
                    if (!($this->deviceModel->updateQuantityRented($deviceId, $value))) {
                        $check = false;
                    }
                }
            } else {
                $check = false;
            }
            if ($check) {
                $msg = 'Thuê thiết bị thành công';
                $type_msg = 'success';
            } else {
                $msg = 'Thuê thiết bị thất bại';
                $type_msg = 'error';
            }
        }
        setFlashData('msg', $msg);
        setFlashData('type_msg', $type_msg);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function getCusRent()
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
        $condition = trim($condition, ' ');
        $cusRentList = $this->model_home->getAllSlip($condition);
        $this->data['sub_content']['cusRentList'] = $cusRentList;
        $this->data['title'] = 'Danh sách khách hàng thuê đồ';
        $this->data['content'] = 'admin\services\rentDevices\listCusRent';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function handleRentReturn()
    {
        $slipId = getIdObject();
        $check = true;
        if ($this->model_home->updateRentStatus($slipId)) {
            // update quantity rented device
            $condition = " rental_slip_id = $slipId";
            $deviceList = $this->model_home->getAllSlipDetail($condition);

            // update price rent slip
            $slipList = $this->model_home->getAllSlip($condition)[0];
            $timeReturn = date("Y-m-d H:i:s");
            $date1 = new DateTime($slipList['time_rent']);
            $date2 = new DateTime($timeReturn);
            $interval = $date1->diff($date2);
            $hoursDifference = $interval->h + ($interval->i / 60) + ($interval->s / 3600);
            $totalRentPrice = 0;
            foreach ($deviceList as $key => $value) {
                $deviceId = $value['device_id'];
                $deviceRentPrice = $this->deviceModel->getAllDevices(" device_id = $deviceId")[0]['price_rent'];
                $totalRentPrice += (float) $deviceRentPrice * (float) $value['quantity_rent'] * (float) $hoursDifference;
                if (!($this->deviceModel->updateQuantityRented($deviceId, $value['quantity_rent'], 1))) $check = false;
            }
            $data = [
                'rent_status' => 1,
                'total_rent_price' => $totalRentPrice,
                'time_return' => $timeReturn
            ];
            if (!($this->model_home->updateRentSlip($slipId, $data))) $check = false;
        } else {
            $check = false;
        }
        if ($check) {
            $msg = 'Trả đồ và thanh toán thành công';
            $type_msg = 'success';
        } else {
            $msg = 'Trả đồ và thanh toán thất bại';
            $type_msg = 'error';
        }
        setFlashData('msg', $msg);
        setFlashData('type_msg', $type_msg);
        redirect(_HOST_PATH_ . "/admin/RentDevice/getCusRent");
    }
}
