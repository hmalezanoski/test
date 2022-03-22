<?php
include 'model/marsRoverImage.php';

$dateTime = new DateTime();
$date = date_format($dateTime, 'YYYY-mm-dd');

//// Get date Parameter Overwrite
//$date= '2022-03-21'  ;

//Get data from api
$apiData = getMarsRoverImages($date);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nasa Photos</title>
    <link rel="stylesheet" href="/assets/css/main.css"/>

</head>
<body>

<h1>Nasa Images Rover Images for </h1>


<div>
    <?php
        if(empty($apiData['returnData'])){?>
          <div>
              No Images for today!!!
          </div>
    <?php }// end if?>
    <?php foreach ($apiData['returnData']->photos as $photo){?>
        <img src="<?php echo $photo->img_src?>" alt="nasa Rover images" width="300" height="300"/>
    <?php }//end foreach  ?>

</body>
<script src="assets/js/main.js"></script>
</html>






