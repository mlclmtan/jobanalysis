<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once './database.php';
  
// instantiate account object
include_once './data.php';
  
$database = new Database();
$db = $database->getConnection();
  
$newdata = new Data($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->Action)
){
  
    // set product property values
    $newdata->Action = $data->Action;
    // $account->created = date('Y-m-d H:i:s');
  
    // create the product
    if($newdata->datain()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("Code" => "0", "Message" => "", "Result" => array("IsOK" => true)));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("Code" => "0", "Message" => "Unable to create account.", "Result" => array("IsOK" => false)));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("Code" => "0", "Message" => "Unable to create account. Data is incomplete.", "Result" => array("IsOK" => false)));
}
?>