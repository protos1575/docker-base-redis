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

##simple example
echo '<br>';
echo $redis->set("best_car_ever", "Tesla Model S").'<br>';
echo $redis->get("best_car_ever").'<br>';
echo $redis->del("best_car_ever").'<br>';
echo $redis->get("best_car_ever").'<br>';

##extend

// Really simple way to set a key/value pair
$redis->set('foo', 'bar');
$value = $redis->get('foo');
echo $value . "\n";

// There's no UPDATE commands where we're going! Just set it again.
$redis->set('foo', 'baz');
$value = $redis->get('foo');
echo $value . "\n";
// Here we go incrementing unset values. No need to run messy UPSERT stuff.
echo "You've run this script " . $redis->incr('counter') . " times btw.\n";

// Tom is a simple associative array
$tom = array(
        'name' => 'Thomas Hunter',
        'age' => 27,
        'height' => 165,
);
// The predis library makes setting hashes easy
$redis->hmset('tom', $tom);
// Now lets load that hash
$tom = $redis->hgetall('tom');
// As you can see, the object is exactly the same
var_dump($tom); echo "\n";

// We can get a single field from our hash if we want
$tomsage = $redis->hget('tom', 'age');
echo "Tom is $tomsage years old.\n";
// We can increment a single field from the hash as well
$redis->hincrby('tom', 'age', '10');
$tom = $redis->hgetall('tom');
var_dump($tom); echo "\n";

// Here's another simple associative array
$jessica = array(
        'name' => 'Jessica Rabbit',
        'age' => 30,
        'height' => 140
);
// Lets convert it into a JSON string
$jessica_json = json_encode($jessica);
// I'm just going to set it like any other string
$redis->set('jessica', $jessica_json);

// Now, lets load it, and JSON decode it (as an array not an stdClass, thanks to the second argument)
$new_jessica = json_decode($redis->get('jessica'), TRUE);
var_dump($new_jessica); echo "\n";