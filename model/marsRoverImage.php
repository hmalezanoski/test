<?php
include 'api/nasa.php';

function getMarsRoverImages($date)
{

    try {

        $apiData['earth_date'] =$date;

        // Create API Call
        $returnData= apiCallCuriosityRoverImage($apiData);

        $data['returnData'] = [];
        $data['message'] = [];

        // Check if response is empty and error message
        if(isset($returnData['response']) && !empty($returnData['response'])){
            $data['message'] = [];
            $data['returnData'] = json_decode($returnData['response']);
        }else{
            throw new Exception('No Data Found');
        };

    } catch (Exception $e) {
        $data['message'] =   $e->getMessage();

    }

    return $data;


}