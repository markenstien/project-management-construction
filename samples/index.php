<<<<<<< HEAD
<?php   
require_once 'CALLAPI.php';
require_once 'Game.php';

$url = "https://api.opendota.com/api/matches/5415209967";

$data = CallAPI('GET' , $url);

$data = json_decode($data);


// echo '<pre>';

// var_dump($data->radiant_win);

// echo '</pre>';

$gameInfo = new Game($data);


echo $gameInfo->getPicksBans();
echo $gameInfo->getWinner();


echo $gameInfo->gameDetails->first_blood_time;
=======
<?php   
require_once 'CALLAPI.php';
require_once 'Game.php';

$url = "https://api.opendota.com/api/matches/5415209967";

$data = CallAPI('GET' , $url);

$data = json_decode($data);


// echo '<pre>';

// var_dump($data->radiant_win);

// echo '</pre>';

$gameInfo = new Game($data);


echo $gameInfo->getPicksBans();
echo $gameInfo->getWinner();


echo $gameInfo->gameDetails->first_blood_time;
>>>>>>> e27cf1a1d82a246777f96b9a4f1dee08173b37d0
