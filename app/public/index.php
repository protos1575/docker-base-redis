<?php
#phpinfo();
require __DIR__ . '/vendor/autoload.php';

// since we connect to default setting localhost
// and 6379 port there is no need for extra
// configuration. If not then you can specify the
// scheme, host and port to connect as an array
// to the constructor.
try {

    $redis = new Predis\Client(['host' => 'redis',
                                'port' => 6379,
                                'password' => 'pwd']);
    echo "Successfully connected to Redis";
}
catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
}

echo '<br>';
echo $redis->set("best_car_ever", "Tesla Model S").'<br>';
echo $redis->get("best_car_ever").'<br>';
echo $redis->del("best_car_ever").'<br>';
echo $redis->get("best_car_ever").'<br>';