<?php

require_once __DIR__."/../bootstrap.php";

use Codinari\Cardforge\Review;
use Codinari\Cardforge\Db;

if(!empty($_POST)){
    try{
        $anonymous = filter_var($_POST['anonymous'], FILTER_VALIDATE_BOOLEAN);

        $review = new Review();
        $review->setRating(intval($_POST['rating']));
        $review->setText($_POST['reviewText']);
        $review->setAnonymous(intval($anonymous));
        $review->save( $_POST['user'], $_POST['productAlias']);
    }catch(\Throwable $th){
        $error = $th->getMessage();
    }


    ob_start();

    $response = [
        "status" => "success",
        "message" => "Review saved successfully",
        "error" => $error,
     ];

    ob_end_clean();

    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}else{
    ob_start();

    $response = [
        "status" => "error",
        "message" => "No data received"
    ];

    ob_end_clean();

    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}