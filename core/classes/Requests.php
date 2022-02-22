<?

class Requests{
    public function makeRq(array $params, string $method){
        $queryData = http_build_query(array_merge($params, ["auth"=>$_COOKIE["access_token"]]));
        $url = DOMAIN."/rest/".$method;

        $curl = curl_init();

        curl_setopt_array($curl,[
            CURLOPT_SSL_VERIFYHOST=>0,
            CURLOPT_SSL_VERIFYPEER=>0,
            CURLOPT_POST=>1,
            CURLOPT_HEADER=>0,
            CURLOPT_RETURNTRANSFER=>1,
            CURLOPT_URL=>$url,
            CURLOPT_POSTFIELDS=>$queryData,
        ]);

        $result = curl_exec($curl);
        return json_decode($result);
    }

}