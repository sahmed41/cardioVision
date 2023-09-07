<?php
// $api_url = 'http://127.0.0.1:8000/';
// $json_data = file_get_contents($api_url);
// $response_data = json_decode($json_data);
// Process the response data as needed


$url = 'http://127.0.0.1:8000/ecgInterpret';
$data = ['name' => 'Donn-qCTu.jpg'];

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($data),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === false) {
    /* Handle error */
}



// var_dump($result);
$data = json_decode($result, true);

$class = $data['className'];
$confidence = $data['confidence'];

echo $class;
echo "<br>";
echo $confidence;
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL,"http://127.0.0.1:8000/file");
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, array("name"=>"value1"));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $server_output = curl_exec($ch);
// curl_close($ch);

// echo json_encode($server_output);




// print_r($response_data);
// echo '<br>';
// echo $response_data->message;
// echo $response_data->Status;
?>

<!-- <form action="http://127.0.0.1:8000/file" method="post">
    <input type="text" name="name" id="name" value="name">
    <input type="submit" value="Submint">
</form> -->
<img src="<?php echo $location ?>" alt="image">