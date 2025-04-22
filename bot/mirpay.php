<?php


class MirPay {

    public function __construct($shop,$key){
        $this->shop_id = $shop;
        $this->api_key = $key;
    }

    public function auth(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mirpay.uz/api/connect?kassaid=".$this->shop_id."&api_key=".$this->api_key."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));

        $response = curl_exec($curl);
        if($response!=false){
            $data = json_decode($response, true);
            $token = $data['token'];
            $this->token = $token;
        }
    }

  public function create($summa, $message){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mirpay.uz/api/create-pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('summa' => $summa, 'info_pay' => $message),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->token
            ),
        ));

        $response = curl_exec($curl);
        return $response;
    }


public function status($check){
	
	$pay_id = urlencode($check);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://mirpay.uz/api/pay/invoice/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
  "Authorization: Bearer ".$this->token
  ),
  CURLOPT_POSTFIELDS => array('payid' => $pay_id),
));

$response = curl_exec($curl);
	return $response;
	}
	
	
}
