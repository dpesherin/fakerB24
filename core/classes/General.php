<?

class General{

    public function getToken(){
        $url = "https://oauth.bitrix.info/oauth/token/?grant_type=authorization_code&client_id=".CLIENT_ID."&client_secret=".CLIENT_SECRET."&code=".$_GET['code'];
        
        $headers = [];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true); 

        return json_decode(curl_exec($curl));
    }
    public function getCode(){
        $url = DOMAIN."/oauth/authorize/?client_id=".CLIENT_ID;
        header("Location: ".$url);
    }
}