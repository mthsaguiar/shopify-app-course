<?php

class Shopify {
    public $shop_url;
    public $access_token;

    public function set_url($url) {
        $this -> shop_url = $url;
    }

    public function set_token($token){
        $this->access_token = $token;
    }

    public function get_url(){
        return $this -> shop_url;
    }
    public function get_token(){
        return $this -> access_token;
    }
    // /admin/api/2022-01/products.json
    public function rest_api($api_endpoint, $query = array(), $method = "GET"){
        $url = 'https://' . $this->shop_url . $api_endpoint;

        if(in_array($method, array('GET', 'DELETE')) && !is_null($query)){
            $url = $url . '?' . http_build_query($query);
        }

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        
    }
}