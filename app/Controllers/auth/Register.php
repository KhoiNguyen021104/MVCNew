 <?php
    class Register extends Controller
    {
        public $data = [];
        public $model_home;
        public function __construct()
        {
            $this->model_home = $this->model('RegisterModel');
            $this->data['sub_content'][''] = "";
        }
        public function index()
        {
            $this->data['content'] = 'Auth\register';
            $this->data['title'] = 'Đăng kí';
            $this->render('layouts/auth_layout', $this->data);
        }
        public function postRegister()
        {
            $check = true;
            $accountModel = $this->model('AccountModel');
            if (!($accountModel->checkExistAccount(filter()['username']))) {
                $check = false;
                setFlashData('usernameRegisErr', 'Tên đăng nhập đã tồn tại');
            }
            if (filter()['password'] != filter()['confirmPassword']) {
                $check = false;
                setFlashData('password', 'Mật khẩu xác nhận không trùng khớp');
            }
            if (empty(filter()['country'])) {
                setFlashData('country', 'Vui lòng chọn quốc tịch!');
                $check = false;
            }
            if (!isPhone(filter()['phone'])) {
                setFlashData('phone', 'Số điện thoại phải đủ 10 chữ số và bắt đầu bằng 0');
                $check = false;
            }

            if (!isIdentifyNumber(filter()['id_number'])) {
                setFlashData('id_number', 'Số CCCD phải đủ 12 chữ số và bắt đầu bằng 0');
                $check = false;
            }

            $userModel = $this->model('UserModel');
            if (!$userModel->checkExistEmail(filter()['email'])) {
                setFlashData('email', 'Email đã được đăng ký');
                $check = false;
            }
            
            if (!$check) {
                $msg = 'Đắng ký tài khoản thất bại';
                $type_msg = 'error';
                setFlashData('old', filter());
            } else {
                $userModel = $this->model('UserModel');
                $userData = [
                    'name' => filter()['display_name'],
                    'email' => filter()['email'],
                    'phone' => filter()['phone'],
                    'address' => filter()['address'],
                    'country' => filter()['country'],
                    'id_number' => filter()['id_number'],
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                if ($userModel->addUser($userData)) {
                    $id = $userModel->getIdUser();

                    $accountData = [
                        'username' => filter()['username'],
                        'password' => password_hash(filter()['password'], PASSWORD_DEFAULT),
                        'pass_real' => filter()['password'],
                        'role' => filter()['role'],
                        'user_id' => $id,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    if ($this->model_home->addAccount($accountData)) {
                        $msg = 'Đắng ký tài khoản thành công';
                        $type_msg = 'success';
                    } else {
                        $msg = 'Đắng ký tài khoản thất bại';
                        $type_msg = 'error';
                    }

                    $customerData = [
                        'user_id' => $id
                    ];
                    $customerModel = $this->model('CustomerModel');
                    if ($customerModel->addCustomer($customerData)) {
                        $msg = 'Đắng ký tài khoản thành công';
                        $type_msg = 'success';
                    } else {
                        $msg = 'Đắng ký tài khoản thất bại';
                        $type_msg = 'error';
                    }
                }
            }
            setFlashData('msg', $msg);
            setFlashData('type_msg', $type_msg);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
