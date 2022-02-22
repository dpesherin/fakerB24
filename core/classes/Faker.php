<?
class Faker{
    public function fakeUser(string $count){
        $params = [
            "count"=>$count,
            "unescaped"=>"false",
            "params"=>"LastName,FirstName,FatherName,DateOfBirth,Phone,Email"
        ];
        $queryData = http_build_query($params);
        $url = 'https://api.randomdatatools.ru/';

        $curl = curl_init();

        curl_setopt_array($curl,[
            CURLOPT_SSL_VERIFYHOST=>0,
            CURLOPT_SSL_VERIFYPEER=>0,
            CURLOPT_POST=>0,
            CURLOPT_HEADER=>0,
            CURLOPT_RETURNTRANSFER=>1,
            CURLOPT_URL=>$url,
            CURLOPT_POSTFIELDS=>$queryData,
        ]);

        return json_decode(curl_exec($curl), true);

    }

    public function fakeCompany($count){
        for($i = 1; $i<=$count; $i++){
            $rq = new Requests;
            $arParams = [
                "fields"=>[
                "TITLE"=>"FakeCompany#".$i,
                "COMPANY_TYPE"=>"CUSTOMER"],
                "params"=>["REGISTER_SONET_EVENT"=> "N"]
                ];
            $company = $rq->makeRq($arParams, 'crm.company.add.json');

            $newCompanyID = $company->result;
            
            $params = [
                "unescaped"=>"false",
                "params"=>"LastName,FirstName,Phone"
            ];
            $queryData = http_build_query($params);
            $url = 'https://api.randomdatatools.ru/';
    
            $curl = curl_init();
    
            curl_setopt_array($curl,[
                CURLOPT_SSL_VERIFYHOST=>0,
                CURLOPT_SSL_VERIFYPEER=>0,
                CURLOPT_POST=>0,
                CURLOPT_HEADER=>0,
                CURLOPT_RETURNTRANSFER=>1,
                CURLOPT_URL=>$url,
                CURLOPT_POSTFIELDS=>$queryData,
            ]);
    
            $fakeContact = json_decode(curl_exec($curl), true);

            $rq = new Requests;
            $arParams = [
                "fields"=>[
                    "NAME"=> $fakeContact["FirstName"], 
                    "LAST_NAME"=>$fakeContact["LastName"],  
                    "OPENED"=> "Y",  
                    "TYPE_ID"=> "CLIENT",
                    "SOURCE_ID"=> "SELF",
                    "PHONE"=> [ ["VALUE"=> $fakeContact["Phone"], "VALUE_TYPE"=> "WORK"] ]],
                "params"=>["REGISTER_SONET_EVENT"=> "N"]
                ];
            $contact = $rq->makeRq($arParams, 'crm.contact.add.json');
            $newContactID = $contact->result;

            $rq = new Requests;
            $arParams = [
                "id"=>$newCompanyID,
                "fields"=>[
                    "CONTACT_ID"=>$newContactID,
                    "IS_PRIMARY"=>"Y"
                    ]
                ];
            $contact = $rq->makeRq($arParams, 'crm.company.contact.add.json');

        }
    }

}