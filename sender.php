<?php 
require_once 'twilio-php-main/src/Twilio/autoload.php';
use Twilio\Rest\Client;  
$api_key = "cfcade31d0f35fa2d1db13ad675f5746";
$city_name=  "Karachi";
$api_url = 'https://api.openweathermap.org/data/2.5/weather?q='.$city_name.'&units=metric&appid='.$api_key;
$weather_data = json_decode(file_get_contents($api_url),true);
$temp = $weather_data['main']['temp'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "select name,phone from entry";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
        try{              
            $sid    = "AC9323637f191977101de229df824c528b"; 
            $token  = "99e23138f6bcdd2eec0850ffc510c805"; 
            $twilio = new Client($sid, $token);
            $phone =  $row["phone"]; 
            $name = $row["name"];
            $message = $twilio->messages 
                              ->create("whatsapp:".$phone,
                                       array( 
                                           "from" => "whatsapp:+14155238886",       
                                           "body" => "Hello ".$name." the temperature today is ".$temp."C" 
                                       ) 
                              );  
                              header("Location: " . $_SERVER['PHP_SELF']);   
        }catch(Exception $e){
            echo("");
        }
    }
}
$conn->close();