<!DOCTYPE html>
<html>
<head>
	<title>Spam Protector</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<style type="text/css">
		.heading{
			margin: 30px; 
			border-bottom: 1px solid #ddd; 
			padding-bottom: 10px
		}
	</style>
</head>
<body>
<?php
	if (isset($_POST['submit_url']) && isset($_POST['myURL'])) {
		
		$msg = [];
		try {
		    $url = $_POST['myURL'];

		    if (empty($url)) {
		        throw new Exception('Please provide the URL', 1);
		    }
		    
		    //now get the file
			header("Content-Type: application/mp4");
		    
	    	curl_setopt($ch=curl_init(), CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($ch);
			curl_close($ch);

			// now save file
			$fileName = uniqid();
			$direcoty = getcwd();
			$pathToSave = $direcoty."/temporary-videos/";
			
			header("Content-Type: Application/mp4");
			file_put_contents($pathToSave.$fileName.".mp4", $response);

			
			//after save file then show message
			header("Location: success.php");

		} catch (Exception $e) {
		    $msg['success'] = false;
		    $msg['message'] = $e->getMessage();
		}

    }
?>


	<div class="container">
		<h3 class="text-center heading">Get Files From URL & Save to Database Without Downloading</h3>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			  <form id="myForm" action="" method="POST">
			  	<div class="form-group">
			  		<label><b>Enter URL</b></label>
			  		<input class="form-control" type="url" name="myURL" placeholder="Your url...">
			  	</div>
			  	<input type="submit" name="submit_url" value="Submit" class="btn btn-primary">
			  </form>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</body>
</html>