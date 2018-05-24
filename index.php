<?php

require_once __DIR__ . '/vendor/autoload.php';

$token = getenv('TOKEN');

$client = new \Github\Client();

$client->authenticate($token, null, \Github\Client::AUTH_URL_TOKEN);

$latestRelease = $client->api('repo')->releases()->latest('fclimited', 'booking-engine')['name'];
$releaseNames = json_decode($client->api('repo')->contents()->download('fclimited', 'booking-engine', 'release-names.json', 'roar'));
$nextRelease = $releaseNames[array_search($latestRelease, $releaseNames) + 1];
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>What is the next Prodigy release name?</title>
  <style>
html {
    height: 100%;
    width: 100%;
}
body {
    background-color: rgba(0,0,0,0.1);
    height: 100%;
    margin: 0;
}
.container::before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    width: 0px;
}
.container {
    display: block;
    height: 100%;
    width: 100%;
    display: inline-block;
    text-align: center;
}
p {
    color: #b22;
    display: inline-block;
    font-family: monospace;
    font-size: 150px;
}
  </style>

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
    <div class="container">
        <p><?= $nextRelease ?></p>
    </div>
</body>
</html>
