<?php
require "../library/pull_data.class.php";

$pullData = new PullData("UNBN","SD",1,"http://tryoutunonline.com/soal-86-prediksi_soal_usbn.html");
$pullData->setToDB();
