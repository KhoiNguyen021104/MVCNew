<?php
class Devices extends Controller
{
    public $data = [];
    public $model_home;
    public function __construct()
    {
        $this->model_home = $this->model('DeviceModel');
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
        $this->data['navItem'] = $navItem;
        $this->data['navLink'] = $navLink;
        $this->data['activeDevices'] = true;
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
        $devicesList = $this->model_home->getAllDevices($condition);
        $this->data['sub_content']['devicesList'] = $devicesList;
        $this->data['title'] = 'Thiết bị, dụng cụ cho thuê';
        $this->data['content'] = 'admin\services\rentDevices\list';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function getAddDevice()
    {
        $this->data['title'] = 'Thêm thiết bị, dụng cụ cho thuê';
        $this->data['content'] = 'admin\services\rentDevices\add';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function handelImage()
    {
        $image = $_FILES['device_image'];
        if (!empty($image['name'])) {
            $extend = '.jpg';
            if (explode("/", $image['type'])[1] == 'png') $extend = '.png';
            $fileName = time() . $extend;
            move_uploaded_file(
                $_FILES['device_image']['tmp_name'],
                _DIR_ROOT_ . '\public\assets\admin\images\devices\device-' . $fileName
            );
            $fileName = 'device-' . $fileName;
            return $fileName;
        }
    }

    public function postAddDevice()
    {
        $fileName = $this->handelImage();
        $filterAll = filter();
        $check = true;
        if(!is_int($filterAll['price_rent'])) {
            $check = false;
            setFlashData('price_rent','Giá thuê phải là 1 số');
        }
        if(!is_int($filterAll['price_compensation'])) {
            $check = false;
            setFlashData('price_compensation','Giá thuê phải là 1 số');
        }
        if(!$check) {
            $msg = 'Thêm thiên bị thất bại';
            $type_msg = 'error';
        } else {
            $filterAll['device_image'] = $fileName;
            if ($this->model_home->addDevice($filterAll)) {
                $msg = 'Thêm thiết bị thành công';
                $type_msg = 'success';
            } else {
                $msg = 'Thêm thiên bị thất bại';
                $type_msg = 'error';
            }
        }
        setFlashData('msg', $msg);
        setFlashData('type_msg', $type_msg);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function getIdDevice()
    {
        $url = $_SERVER['PATH_INFO'];
        $arr = explode("/", $url);
        $arr =  $arr[count($arr) - 1];
        $id = explode("=", $arr)[1];
        return $id;
    }

    public function getEditDevices()
    {
        $id = getIdObject();
        $condition = " device_id = $id";
        $detailDevice = $this->model_home->getAllDevices($condition)[0];
        $this->data['sub_content']['detailDevice'] = $detailDevice;
        $this->data['title'] = 'Sửa thiết bị, dụng cụ cho thuê';
        $this->data['content'] = 'admin\services\rentDevices\edit';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function postEditDevice()
    {
        $id = getIdObject();
        $condition = " device_id = $id";
        $fileName = $this->handelImage();
        $filterAll = filter();
        $filterAll['device_image'] = $fileName;
        if ($this->model_home->updateDevice($filterAll, $condition)) {
            $msg = 'Sửa thiết bị thành công';
            $type_msg = 'success';
        } else {
            $msg = 'Sửa thiên bị thất bại';
            $type_msg = 'error';
        }
        setFlashData('msg', $msg);
        setFlashData('type_msg', $type_msg);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function handleDeleteDevice()
    {
        $id = getIdObject();
        if ($this->model_home->deleteDevice($id)) {
            $msg = 'Xóa thiết bị thành công';
            $type_msg = 'success';
        } else {
            $msg = 'Xóa thiết bị thất bại';
            $type_msg = 'error';
        }
        setFlashData('msg', $msg);
        setFlashData('type_msg', $type_msg);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
