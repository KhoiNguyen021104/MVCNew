<?php
// Admin
class Statistics extends Controller
{
    public $data = [];
    public $model_home;
    public function __construct()
    {
        $this->model_home = $this->model('StatisticsModel');
        $navItem = [
            'Hóa đơn',
            "Thống kê"
        ];
        $navLink = [
            'BookTicketInfo',
            'Statistics'
        ];
        $this->data['navItem'] = $navItem;
        $this->data['navLink'] = $navLink;
        $this->data['sub_content'][''] = "";
        $this->data['activeStatistics'] = true;
    }
    public function index()
    {
        $condition = '';
        $conditionYear = '';
        $conditionDevice = '';
        $timeSearch = '';
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                if (empty($value))
                    continue;
                if (is_string($value)) {
                    if($key == 'dateStart') {
                        $condition .= 'date_of_use' . ">=" . "CAST('$value' AS DATE)" . " AND ";
                        $conditionDevice .= 'time_rent' . ">=" . "CAST('$value' AS DATE)" . " AND ";
                        $timeSearch .= "từ $value";
                    } else if($key == 'dateEnd'){
                        $condition .= 'date_of_use' . "<=" . "CAST('$value' AS DATE)" . " AND ";
                        $conditionDevice .= 'time_rent' . "<=" . "CAST('$value' AS DATE)" . " AND ";
                        $timeSearch .= " đến $value";
                    }
                    if($key == 'yearSta') {
                        $yearStart = "$value-01-01";
                        $yearEnd = "$value-12-31";
                        $conditionYear .= ' date_of_use >= ' .  "CAST('$yearStart' AS DATE)";
                        $conditionYear .= ' AND date_of_use <= ' . "CAST('$yearEnd' AS DATE)";
                    }
                } else if (is_numeric($value)) {
                    $condition .= $key . "<=" . $value . " AND ";
                }
            }
        }
        $condition = rtrim($condition, ' AND ');
        $condition = rtrim($condition, ' and ');
        $conditionDevice = rtrim($conditionDevice, ' AND ');
        $conditionDevice = rtrim($conditionDevice, ' and ');
        if(!empty($condition)) {
            setFlashData('old',$_POST);
        }
        $revenue = $this->model_home->getAllRevenue($condition);
        $this->data['sub_content']['revenue'] = $revenue;

        $this->data['sub_content']['timeSearch'] = $timeSearch;

        $typeTicketChar = $this->model_home->getTypeBill($condition);
        $this->data['sub_content']['typeTicketChar'] = $typeTicketChar;

        $revenueYear = $this->model_home->statisticByYear($conditionYear);
        $this->data['sub_content']['revenueYear'] = $revenueYear;

        // Doanh thu thuê đồ

        $revenueRent = $this->model_home->getBillRent($conditionDevice);
        $this->data['sub_content']['revenueRent'] = $revenueRent;

        $typeDevices = $this->model_home->getTypeDevice($conditionDevice);
        $this->data['sub_content']['typeDevices'] = $typeDevices;
        // Doanh thu thuê đồ
        

        $this->data['content'] = 'admin\financial\statistic\list';
        $this->data['title'] = 'Báo cáo, thống kê';
        $this->render('layouts/admin_layout', $this->data);
    }
}