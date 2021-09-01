<?php
    include APPPATH . "third_party/ImageResize.php";
    include APPPATH . "third_party/php-barcode-generator/src/BarcodeGenerator.php";
    include APPPATH . "third_party/php-barcode-generator/src/BarcodeGeneratorHTML.php";
    require __DIR__ . '\..\..\autoload.php';
    use \Eventviva\ImageResize;
    use Mike42\Escpos\Printer;
    use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

function cnull($value)
{
    return (empty($value))?'':$value;
}

function enable_code39()
{
    $connector = new WindowsPrintConnector("POS-58");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    // Set Header Invoice
    $printer -> barcode('{A00221', Printer::BARCODE_CODE128);
    $printer -> text("Enable code39\n");
    $printer -> cut();
        
    /* Close printer */
    $printer -> close();
}

function shop_version()
{
    return "Rina Accessories Store - V1.0.01";
}

function user_level($user_level)
{
    switch ($user_level) {
        case 1:
            return "Kasir";
            break;
            
        default:
            return "Admin";
            break;
    }
}
    
function is_logged_in()
{
    $CI =& get_instance();
    $unique_code = $CI->session->userdata('username');
        
    if (!isset($unique_code) || empty($unique_code)) {
        return false;
    } else {
        return true;
    }
}

function email_api()
{
    $CI = get_instance();
    $CI->load->model('settings_model');
    $email_api = $CI->settings_model->getSettings('email_api');
    return $email_api;
}
    
function get_session($sDataSession, $with_unset = false)
{
    $CI =& get_instance();
    $sess = isset($CI->session->userdata['ses_'.$sDataSession])?$CI->session->userdata['ses_'.$sDataSession]:false;
    if ($with_unset) {
        unset_session($sDataSession);
    }
    return $sess;
}

function send_email($to, $subject, $html_content)
{
    $email_api = email_api();
    if ($email_api->enabled) {
        send_mail_mailgun($to, $subject, $html_content);
    } else {
        php_mail($to, $subject, $html_content);
    }
}

function do_barcode_print($dataBarcode)
{
    try {
        // Enter the share name for your USB printer here
        // $connector = null;
        $connector = new WindowsPrintConnector("POS-58");

        /* Print a "Hello world" receipt" */
        $printer = new Printer($connector);
        // Set Header Invoice
        for ($i=0; $i < $dataBarcode['qty']; $i++) { 
            $printer -> setJustification(Printer::JUSTIFY_RIGHT);
            $printer -> text("Harga @ ". $dataBarcode['harga'] ."\n");
            $printer -> setBarcodeHeight(110);
            $printer -> setBarcodeWidth(2);
            $printer -> setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
            $printer -> barcode($dataBarcode['barcode'], Printer::BARCODE_CODE39);
            $printer -> text($dataBarcode['nama_barang']." \n");
            $printer -> feed(2);
        }

        $printer -> cut();
            
        /* Close printer */
        $printer -> close();
        return true;
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        return false;
    }
}

function do_print($dataNota)
{
    try {
        // Enter the share name for your USB printer here
        // $connector = null;
        $connector = new WindowsPrintConnector("POS-58");

        /* Print a "Hello world" receipt" */
        $printer = new Printer($connector);
        // Set Header Invoice
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("DHERISA GROSIR\n");
        $printer -> text("DESA PUNTANG BLOK SARBAN RT 11 / RW 03 KECAMATAN LOSARANG\n");
        $printer -> text("KABUPATEN INDRAMAYU\n");
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> text("NO NOTA : " . $dataNota['no_nota'] . "\n");
        $printer -> text("TGL : " . $dataNota['tanggal'] . "\n");
        $printer -> text("KASIR : " . $dataNota['kasir'] . "\n");
        $printer -> text("********************************\n");
        foreach ($dataNota['orders'] as $order) {
            $printer -> text($order->nama_brg . "\n");
            $printer -> text($order->qty . " X " . idr_format($order->harga) . " = " . idr_format($order->sub_total) . "\n");
        }
        $printer -> text("********************************\n");
        $printer -> setJustification(Printer::JUSTIFY_RIGHT);
        // Set Summary order
        $printer -> text("TOTAL " . idr_format($dataNota['total']) . "\n");
        $printer -> text("DISC " . "0%\n");
        $printer -> text("BAYAR " . idr_format($dataNota['bayar']) . "\n");
        $printer -> text("KEMBALI " . idr_format($dataNota['kembali']) . "\n");
        // Set Contact Person
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("** TERIMAKASIH **\n");
        $printer -> text("SUDAH BERBELANJA\n");
        $printer -> text("DI TOKO DHERISA GROSIR\n");
        $printer -> text("** CONTACT PERSON **\n");
        $printer -> text("WA : 08972162264\n");
        $printer -> text("FB : DHERISA GROSIR\n");
        $printer -> text("\n\n\n");
        $printer -> pulse();
        $printer -> cut();
            
        /* Close printer */
        $printer -> close();
        return true;
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        return false;
    }
}

function php_mail($to, $subject, $html_content)
{

    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = 'Reply-To: info@jafra.co.id';
    $headers[] = 'From: Face of Jafra <info@jafra.co.id>';
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $html_content, implode("\r\n", $headers));
}

function set_session($sDataSession, $sValueSession)
{
    $CI =& get_instance();
    return $CI->session->set_userdata($sDataSession, $sValueSession);
}
function unset_session($sDataSession)
{
    $CI =& get_instance();
    return $CI->session->unset_userdata('ses_'.$sDataSession);
}
    
function paginate($total, $per_page = 20, $uri_key = 'page', $link_suffix = '')
{
    $CI =& get_instance();
    $per_page = intval($per_page);
    if ($per_page <= 0) {
        $per_page = 20;
    }

    $uri_segment = null;
    $uri_array = $CI->uri->segment_array();


    foreach ($uri_array as $i => $segment_name) {
        if ($uri_key == $segment_name) {
            $uri_segment = $i;
            break;
        }
    }

    $is_odd = (!empty($uri_segment) and $uri_segment % 2 == 0);

    $uri = $CI->uri->uri_to_assoc((!$is_odd ? 1 : 2));

    unset($uri[$uri_key]);



    if (count($uri) == 1 and reset($uri) === false) {
        $key = reset(array_keys($uri));
        $uri[ $key ] = '';
    }
        
    $CI->config->load('pagination');

    $config = $CI->config->item('pagination');
        

    $base_url = $CI->uri->assoc_to_uri($uri) . $uri_key;


    if ($is_odd) {
        $base_url = $CI->uri->segment(1) . '/' . $base_url;
    }
    // var_dump($is_odd);exit();
    // echo $base_url;exit();

    $config['base_url'] = site_url($base_url);
    $config['per_page'] = $per_page;
    $config['total_rows'] = $total;
    $config['uri_segment'] = $uri_segment + 1;

    $CI->load->library('pagination', $config);

    $links = $CI->pagination->create_links();

    if (!empty($link_suffix)) {
        $links = preg_replace('/'.$uri_key.'\/([0-9]+)?/', '${0}'.$link_suffix, $links);
    }

    return $links;
}
function debug_pre($data = '')
{
    echo "<pre>";
    var_dump($data);
    echo "<pre>";
}
function random_string($length = 0)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

function is_strong_password($password = '')
{
    $strong_regex = "/^(?=^.{8,}$)(?=(.*\\d){2})(?=(.*[A-Za-z]){2})(?=(.*[!@#$%^&*?]){2})(?!.*[\\s])^.*/";
    $sequence = "/^(?=(.*(0123|1234|2345|3456|4567|5678|6789|7890)))|(?=(.*(abcd|bcde|cdef|defg|efgh|fghi|ghij|hijk|ijkl|jklm|klmn|lmno|mnop|nopq|opqr|pqrs|qrst|rstu|stuv|tuvw|uvwx|vwxy|wxyz)))/";
    if (preg_match($strong_regex, $password)) {
        if (preg_match($sequence, $password)) {
            return false;
        } else {
            return true;
        }
    } else {
        if (preg_match($sequence, $password)) {
            return false;
        } else {
            return false;
        }
    }
}

function send_mail_mailgun($to, $subject, $html_content)
{
    $email_api = email_api();
    // $key = "key-54a3fafb596d89d4ace965997c00e031";
    // $url = "https://api.mailgun.net/v3/mg.redcomm.co.id/messages";
    $key = $email_api->api_key;
    $url = $email_api->api_url;

    $config = [
    'api_key'   => $key,
    'api_url'   => $url
    ];

    $message = [
    'from'          => 'Face of Jafra <info@jafra.co.id>',
    'to'            => $to,
    'h:Reply-To'    => 'info@jafra.co.id',
    'subject'       => $subject,
    'html'          => $html_content,
    'text'          => ''
    ];

    // $message = $args;
    // echo $html_content;exit();
    $ch = curl_init();
     
    curl_setopt($ch, CURLOPT_URL, $config['api_url']);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    $result = curl_exec($ch);
}

function idr_format($currency)
{
    return 'Rp ' . strrev(implode(',', str_split(strrev(strval($currency)), 3))) . '-,';
}

function nominal_format($currency)
{
    return strrev(implode(',', str_split(strrev(strval($currency)), 3))) . '-,';
}

function dateToSql($day, $month, $years)
{
    return $years . '-' . $month . '-' . $day;
}

function stringToPartDate($date, $format)
{
    switch ($format) {
        case 'dd':
            return (int)date('d', strtotime($date));
            break;
        case 'mm':
            return (int)date('m', strtotime($date));
            break;
        case 'YYYY':
            return (int)date('Y', strtotime($date));
            break;
    }
}

function idTimeFormat($dateTime)
{
    return date('d M Y', strtotime($dateTime));
}

function idrToString($subject = null)
{
    $search = [
    'Rp ',
    ',',
    '.',
    '-,',
    '-'
    ];

    $replace = [
    ''
    ];

    return str_ireplace($search, $replace, $subject);
}
function phoneToString($subject = null)
{
    $search = [
    '+62(8',
    ')',
    '-'
    ];

    $replace = [
    ''
    ];

    return str_ireplace($search, $replace, $subject);
}

function uploadOriginalImage($file = null)
{
    $image = ImageResize::createFromString($file);
    return $image;
}

function uploadThumbImage($file = null)
{
    $image = ImageResize::createFromString($file);
    $image->crop(200, 200);
    return $image;
}
