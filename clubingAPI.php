<?php

function displayYoutubeVideos()
{
	if (isset($_GET['q']) && isset($_GET['maxResults'])) {
	
		require_once 'google/src/Client.php';
		require_once 'google/src/Config.php';
		require_once 'google/src/Utils.php';
		require_once 'google/src/Cache/Abstract.php';
		require_once 'google/src/Cache/File.php';
		require_once 'google/src/Http/CacheParser.php';
		require_once 'google/src/IO/Abstract.php';
		require_once 'google/src/IO/Curl.php';
		require_once 'google/src/Auth/Abstract.php';
		require_once 'google/src/Auth/OAuth2.php';
		require_once 'google/src/Service.php';
		require_once 'google/src/Service/Resource.php';
		require_once 'google/src/Http/Request.php';
		require_once 'google/src/Http/REST.php';
		require_once 'google/src/Logger/Abstract.php';
		require_once 'google/src/Logger/Null.php';
		require_once 'google/src/Model.php';
		require_once 'google/src/Collection.php';
		require_once 'google/src/Service/YouTube.php';

	  /*
	   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
	   * Google Developers Console <https://console.developers.google.com/>
	   * Please ensure that you have enabled the YouTube Data API for your project.
	   */
	  
	  $DEVELOPER_KEY = 'AIzaSyBnGgcRBluHpDYzzQHVr6N3YjuTDlfV8hs';

	  $client = new Google_Client();
	  $client->setDeveloperKey($DEVELOPER_KEY);

	  // Define an object that will be used to make all API requests.
	  $youtube = new Google_Service_YouTube($client);

	  try {
		$searchResponse = $youtube->search->listSearch('id,snippet', array(
		  'q' => $_GET['q'],
		  'maxResults' => $_GET['maxResults'],
		));

		$query = $_GET['q'];		
		$videos = '';
		$channels = '';
		$playlists = '';
		// Add each result to the appropriate list, and then display the lists of
		// matching videos, channels, and playlists.
		
		foreach ($searchResponse['items'] as $searchResult) {
		  switch ($searchResult['id']['kind']) {
			case 'youtube#video':
			  $videos .= sprintf('<li>%s (%s)</li>',
				  $searchResult['snippet']['title'], $searchResult['id']['videoId']);
			  break;
			case 'youtube#channel':
			  $channels .= sprintf('<li>%s (%s)</li>',
				  $searchResult['snippet']['title'], $searchResult['id']['channelId']);
			  break;
			
		  }
		}
		echo <<<END
	<div class="row">
		<h3>Videos</h3>
		<ul>$videos</ul>
		<h3>Channels</h3>
		<ul>$channels</ul>
       </div>
END;
		
	  } catch (Google_ServiceException $e) {
		$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
		  htmlspecialchars($e->getMessage()));
	  } catch (Google_Exception $e) {
		$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
		  htmlspecialchars($e->getMessage()));
	  }
	}
}

function displayFlickrPhotos()
{

	if (isset($_GET['q']) && isset($_GET['maxResults'])) {

		$flickrKey = 'b1a69066d658530df604321f514b72d0';
		$flickrSecret = '9e0e977d109675fa';
		require_once('phpFlickr.php');
		
		$f = new phpFlickr($flickrKey);
		$recent = $f->photos_search(array("tags"=>$_GET['q'], "tag_mode"=>"any", "per_page" => $_GET['maxResults'], "extras" => "url_sq"));
		$url = array();
		$urls = array();
		if(count($recent['photo']) < 1)
		{
		   echo '<h5>There are no Results Found</h5>';
		}
		else
		{
		foreach ($recent['photo'] as $photo) {
			$urls[] = $f->buildPhotoURL($photo, "Medium");
		}
		
		foreach ($urls as $url) {
			echo '<img src="'. $url .'">';
		}
		}
	}
}

?>