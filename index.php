<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('clubingAPI.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="search">
   
    <title>FlickrTube</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 <link href="bootstrap/css/main.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container-fluid">
		<div class="row">
			<div class="search-header col-lg-12">
				<div class="block">
					<div class="masthead">                          	
						<h2 class="text-muted"><span style="color: #084B8A">f</span>lickr<span style="color: Red">Tube</h2>
						<form method="GET">
							<div class="col-lg-6">
								<input type="search" class="form-control" id="q" name="q" placeholder="Enter Search Term" Required>
									</div> 
											<div class="col-lg-3">
												Max Results: <input style="padding-top:8px;"type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="10">
											</div>
										<button type="submit" class="btn btn-default btn-lg" style="width:150px;">Search</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
      <div class="row">
        <div class="youtube col-lg-6">
			<div class="block">
			  <h2>Youtube</h2>
			  <?php displayYoutubeVideos() ?>
			</div>
		</div>
		<div class="flickr col-lg-6">
			<div class="block">
				<h2>Flickr</h2>
				<?php displayFlickrPhotos() ?>
			</div>
        </div>
      </div>
    </div> <!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
