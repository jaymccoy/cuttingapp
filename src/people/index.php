<?php
include("../bootstrap.php");
$log->log("Test: console_log()");
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

#echo ("uri: "); var_dump($uri);
#$gets[] = split($_GET);
#echo ("gets: "); var_dump($_GET);


$return=[];

if (!$conn) {
	die("Connect failed: %s\n". $conn->error);
} else {
	$people=[];
	if ($personQuery = $conn->query("SELECT * FROM people")) {
		#var_dump($personQuery);
		while ($person = $personQuery->fetch_assoc()) {
			$people[$person['id']] = $person['name_first'] . ' ' . $person['name_last'];
		} //end while
	} //end if


	foreach($people as $id=>$person) {
		$return[] = (object) [
			'id' => $id,
			'person' => $person
		];
	} //end foreach

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	echo json_encode($return);

	$conn->close();
} //end if
