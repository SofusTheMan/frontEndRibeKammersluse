<?php
$url = "localhost:8888/walkBridge";
$options = array(
    CURLOPT_URL => $url,
    CURLOPT_TIMEOUT => 1, // Set timeout to 1 second
    CURLOPT_RETURNTRANSFER => true // Don't return response
    );

$curl = curl_init();
curl_setopt_array($curl, $options);
curl_exec($curl);
curl_close($curl);
?>
<!DOCTYPE html>
<html lang="dk">
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
	<title>Ribe Kammersluse</title>
</head>
	<style type="text/css">
		body {
			background-color: #f2f2f2;
		}

		h1 {
			margin-top: 10%;
		}

		button {
			margin-top: 2%;
		}
	</style>
	<script type="text/javascript">
		function goBack() {
			window.location.href = "https://ribekammersluse.com/"
		}
	</script>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col text-center">
				<h1>Gangbroen er nu åben</h1>
			</div>
		</div>
		<div class="row">
			<div class="col text-center">
				<button type="button" class="btn btn-danger btn-lg" onclick="goBack()">Gå tilbage</button>
			</div>
		</div>
	</div>
</body>
</html>