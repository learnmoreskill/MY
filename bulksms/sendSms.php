<?php
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
        
        if( isset($_POST['numbers']) && isset($_POST['message']) && isset($_POST['sender']) ){
            $list = $_POST['numbers'];
            $msg = $_POST['message'];
            $from = $_POST['sender'];

            if ($from == 'thesmscentral') {

                function sendSMS($content)
                {
                        $ch = curl_init("http://beta.thesmscentral.com/api/v3/sms?" . $content);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $res = curl_exec($ch);
                        curl_close($ch);
                        return $res;
                }

                        $token = 'en9hH4jLrkVgLADj646opSqSOU4U5jW31DV';
                        $to = $list;
                        $sender    = '33234';
                        $message = $msg;

                        $content =
                        '&token='.rawurlencode($token).
                        '&to='.rawurlencode($to).
                        '&sender='.rawurlencode($sender).
                        '&message='.rawurlencode($message);

                        $thesmscentral_response = sendSMS($content);
                        
                        $json = json_decode($thesmscentral_response, true);
                        /*  foreach ($json as $key => $value){
                        echo "$key: $value\n";
                        };
                        echo $json['response_code'];    */
                        if($json['response_code']==200){
                        $response['error'] = false;
                        $response['message'] = "message sent successfully";
                        }else{
                        $response['error'] = true;
                        $response['message'] = $json['body'];
                        }   
            }else if($from == 'aakashsms') {

            	$url = 'http://aakashsms.com/admin/public/sms/v1/send';
		        $postData = array();
				$postData['auth_token'] = 'c39960695a34b6b69890c0123f412b7b18db45d28286df3eec030eb25d61a27d';
				$postData['from'] = '31001';
				$postData['to'] =$list;
				$postData['text'] =$msg;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
				$result = curl_exec($ch);
				curl_close($ch);
		        
		        $json = json_decode($result, true);

		        if($json['response_code']==201){

		        	$response['error'] = false;
                	$response['message'] = "message sent successfully";

		        }else{

		        	$response['error'] = true;
                	$response['message'] = $json['response'];

		        }

            }else if($from== 'bulksms1'){
					
					 $user="T2017050103"; //your username
					 $password="Gfp098Bgz"; //your password
					 $mobilenumbers = $list; //enter Mobile numbers comma seperated
					 $message = $msg; //enter Your Message 
					 $senderid="WPTCrm"; //Your senderid
					 $messagetype="N"; //Type Of Your Message
					 $url="http://info.bulksms-service.com/WebserviceSMS.aspx";
					 //domain name: Domain name Replace With Your Domain  
					 $message = urlencode($message);
					 $ch = curl_init(); 
					 if (!$ch){die("Couldn't initialize a cURL handle");}
					 $ret = curl_setopt($ch, CURLOPT_URL,$url);
					 curl_setopt ($ch, CURLOPT_POST, 1);
					 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
					 curl_setopt ($ch, CURLOPT_POSTFIELDS, 
					"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype");
					 $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
					// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
					 $curlresponse = curl_exec($ch); // execute
					 if(curl_errno($ch)){

						$response['error'] = true;
                        $response['message'] = 'curl error : '. curl_error($ch);

					 }
					 if (empty($ret)) {
					    // some kind of an error happened
					    die(curl_error($ch));
					    curl_close($ch); // close cURL handler
					    //return false;
					    $response['error'] = true;
                        $response['message'] .= "Failed to send sms";
					 } else {
					    $info = curl_getinfo($ch);
					    curl_close($ch); // close cURL handler
					    //return true;
					    $response['error'] = false;
                        $response['message'] .= "message sent successfully";
					 }
					

            }else{
            	$response['error'] = true;
                $response['message'] = "Sender is not match";
            }
        
        }else{
                $response['error'] = true;
                $response['message'] = "Required fields are missing";
        }

}else{
        $response['error'] = true;
        $response['message'] = "Invalid Request";
}
//echo $response;
echo json_encode($response);






?>
