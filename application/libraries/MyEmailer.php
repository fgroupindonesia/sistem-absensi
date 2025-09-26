<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MyEmailer
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance(); // akses ke instance CI

        
    }

    public function send_html_email($toEmail, $subject, $viewName, $dataRender)
    {
        $url = 'http://apps.fgroupindonesia.com/test/send_email.php';
        $sender = 'no-reply@fgroupindonesia.com';
        $timSupport = 'support@fgroupindonesia.com';

        // load view dan render jadi HTML string
        $htmlContent = $this->ci->load->view($viewName, $dataRender, true);

        // siapkan data POST
        $data = array(
            'destination' => $toEmail,
            'subject'     => $subject,
            'sender'      => $sender,
            'html'        => $htmlContent,
            'replyto'      => $timSupport
        );

        // proses CURL
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            log_message('error', 'Email sending failed: ' . $err);
            return false;
        } else {
            log_message('info', 'Email sent: ' . $response);
            return true;
        }
    }
}
