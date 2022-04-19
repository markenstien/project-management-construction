<<<<<<< HEAD
<?php   
    require_once 'CALLAPI.php';

    $url = 'https://api.opendota.com/api/proPlayers';


    $data = CallAPI('GET' , $url);

    $data = json_decode($data);

    die(print_r($data));
=======
<?php   
    require_once 'CALLAPI.php';

    $url = 'https://api.opendota.com/api/proPlayers';


    $data = CallAPI('GET' , $url);

    $data = json_decode($data);

    die(print_r($data));
>>>>>>> e27cf1a1d82a246777f96b9a4f1dee08173b37d0
