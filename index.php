<?php

	if ($_GET['city']) {

	$weather = "";

		//remove the spaces from the user input string so that all cities work
		$city = str_replace(' ', '', $_GET['city']);

		//get the contents of the page that we are scraping   
		$forecastPage = file_get_contents('http://www.weather-forecast.com/locations/'.$city.'/forecasts/latest');
		//create the first break point, use a unique string.
		$pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);

		//create a second break point, this is less picky than the first.
		$secondPageArray = explode ('</span></span></span>', $pageArray[1]);

		//stick the desired blurb in a variable to call later.
		$weather = $secondPageArray[0];
	}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Weather App</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<!-- MY LINKS -->
	<link rel="stylesheet" href="stylesheet.css"> 
	<script src="script.js"></script> 
</head>

<body>


	<div class="container-fluid text-center" id="box">
			
			<!-- PRIMARY FORM FOR THE WEATHER SITE -->
			<form>
			  <div class="form-group">
			  	<h1> What's The Weather? </h1>
			  	<p> Enter the name of a city </p>
			  	<br>

			    <input type="text" class="form-control" id="input" aria-describedby="input" name="city" placeholder="E.g. Paris, London" value="<?php echo $_GET['city']; ?>">
			  </div>

			  <button type="submit" class="button">Submit</button>
			</form>

			<!-- show the weather IF STRING IS NOT EMPTY -->
			<div id="weather"><?php

			if ($weather) {

				echo '<div class="alert alert-success" role="alert">'.$weather.
  '<strong></div>';

			} else {

				echo '<div class="alert alert-danger" role="alert"> We were unable to find this city.<strong></div>';

			}



			?>
			</div>
	</div>




</body>
</html>