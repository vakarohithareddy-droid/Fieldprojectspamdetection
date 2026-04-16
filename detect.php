<!DOCTYPE html>
<html>
<head>

<title>Spam Detection</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f2f2f2;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.card{
width:500px;
border-radius:15px;
}

</style>

</head>

<body>

<div class="card shadow p-4">

<h3 class="text-center">Spam Detection</h3>

<form method="post">

<textarea class="form-control mb-3" name="message" rows="5"
placeholder="Enter your email message..." required></textarea>

<div class="d-grid">
<button class="btn btn-success">Check Message</button>
</div>

</form>

<?php

if(isset($_POST['message'])){

$message = $_POST['message'];

$url = "http://127.0.0.1:5000/predict";

$data = array('message'=>$message);

$options = array(
'http'=>array(
'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
'method'=>'POST',
'content'=>http_build_query($data)
)
);

$context = stream_context_create($options);
$result = file_get_contents($url,false,$context);
$response = json_decode($result,true);

if($response['result']=="SPAM"){
echo "<div class='alert alert-danger mt-3 text-center'>🚫 SPAM MESSAGE</div>";
}
else{
echo "<div class='alert alert-success mt-3 text-center'>✅ NOT SPAM</div>";
}

}

?>

</div>

</body>
</html>