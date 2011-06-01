<?php

session_start();
require_once('instapaperxauth.php');
require_once('config.php');

// Create an Instapaper OAuth object with consumer key and consumer secret.
$connection = new InstapaperXAuth(CONSUMER_KEY, CONSUMER_SECRET);

// Make XAuth Request
$xcontent = $connection->getXAuthToken(XOAUTH_USERNAME,XOAUTH_PASSWORD);
echo $xcontent . "<br />";

// Pull Bookmarks
$limit = 10;
$folder_id = "";
$have = "";
$Bookmark_List = $connection->getBookmarks($limit,$folder_id,$have);

$Bookmarks = json_decode($Bookmark_List,true);

foreach($Bookmarks as $Bookmark) 
	{
	if( $Bookmark['type']=='bookmark')
		{
		echo "type:" . $Bookmark['type'] . "<br />";
		echo "bookmark_id:" . $Bookmark['bookmark_id'] . "<br />";
		echo "title:" . $Bookmark['title'] . "<br />";
		echo "url:" . $Bookmark['url'] . "<br />";
		echo "<br />";
		
		$Bookmark_Text = $connection->getBookmarkText($Bookmark['bookmark_id']);
		echo $Bookmark_Text . "<br />";
		
		echo "<br />";
		}
	}

?>


