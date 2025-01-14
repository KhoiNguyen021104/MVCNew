<?php
function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') return true;
    return false;
}

function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') return true;
    return false;
}

function filter()
{
    $filterArr = [];
    if (isGet()) {
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                if (is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    if (isPost()) {
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                if (is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    return $filterArr;
}

function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

function isPhone($phone)
{
    if ($phone[0] != '0') return false;
    if(strlen(filter()['phone']) != 10) return false;
    $phone = substr($phone, 1);
    if (!isInt($phone)) return false;
    if (strlen(trim($phone)) != 9) return false;
    return true;
}

function isInt($number)
{
    $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    return $checkNumber;
}

function isFloat($number)
{
    if (isInt($number)) return isInt($number);
    $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    return $checkNumber;
}

function isIdentifyNumber($number)
{
    if ($number[0] != 0)  return false;
    if (strlen($number) != 12) return false;
    $number = substr($number, 1);
    if (!isInt($number)) return false;
    return true;
}

function isImg($extend)
{
    if ($extend == 'png' || $extend == 'jpg' || $extend == 'jpeg') return true;
    return false;
}

function getSmg()
{
    $msg = getFlashData('msg');
    $type_msg = getFlashData('type_msg');
    $x = getFlashData('title');
    $text = '';
    if ($type_msg == 'error') $text = 'Vui lòng kiểm tra lại!';
    // $text = '';
    if (!empty($x)) $text = $x;

    if (!empty($msg)) {
        echo '
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal({
                    title: "' . $msg . '",
                    text: "' . $text . '",
                    icon: "' . $type_msg . '",
                    button: "Đóng",
                    });
            </script>
        ';
    }
}

function redirect($path = 'index.php')
{
    header("Location: $path");
    exit;
}

function back()
{
    return $_SERVER['HTTP_REFERER'];
}

function loadError($error = '404')
{
    require_once 'app/Errors/' . $error . '.php';
}


function getAlert($alert)
{
    echo '
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("' . $alert . '", "", "error");
    </script>
    ';
}

function getErr($key)
{
    $err = getFlashData($key);
    if (!empty($err)) {
        echo '<div class="text-left w-100 m-auto mb-3 text-danger">' . $err . '</div>';
    }
}

function old($key)
{
    $old = getFlashData('old');
    if (isset($old[$key])) {
        echo $old[$key];
    }
}

function getOld($key)
{
    $old =  getFlashData('old');
    if (isset($old[$key])) {
        setFlashData('old', $old);
        return $old[$key];
    }
    return '';
}

function getIdObject()
{
    $url = $_SERVER['PATH_INFO'];
    $arr = explode("/", $url);
    $arr =  $arr[count($arr) - 1];
    $id = explode("=", $arr)[1];
    return $id;
}



// tạo qrcode ticket

require 'vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;

function createQrCode($data)
{
    try {
        $result = Builder::create()
            ->writer(new \Endroid\QrCode\Writer\PngWriter())
            ->data($data)
            ->build();
        $file = 'C:\xampp\htdocs\MVCNew\public\assets\admin\images\qrcodeTicket\qrcode_' . $data . '.png';
        $result->saveToFile($file);
        $fileAdd = 'qrcode_' . $data . '.png';
        return  $fileAdd;
    } catch (Exception $e) {
        echo 'Có lỗi xảy ra: ' . $e->getMessage();
    }
}

// send mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendMail($toMail, $subject, $content)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'khoindt10a4@gmail.com';
        $mail->Password   = 'shti evih htkd yiwy';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('khoindt10a4@gmail.com', 'khoi');
        $mail->addAddress($toMail);
        $mail->addAddress('ellen@gmail.com');
        $mail->addReplyTo('info@gmail.com', 'Information');
        $mail->addCC('cc@gmail.com');
        $mail->addBCC('bcc@gmail.com');

        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $content;

        $mail->SMTPOptions = array(
            'ssl' => [
                'verify_peer' => true,
                'verify_depth' => 3,
                'allow_self_signed' => true
            ],
        );

        $sendMail = $mail->send();
        if ($sendMail) {
            return $sendMail;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
