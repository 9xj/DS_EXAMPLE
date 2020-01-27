<?php
header("Content-type: application/json");

//Get Data
$data = file_get_contents('php://input');

//Check for data
if(isset($data)) {
	
	//Write xml file
	$file = fopen('data/'.time().".json", "w") or die("Unable to open file!");
	fwrite($file, $data);
	fclose($file);

	//Generate Response
	$string = <<<JSON
{"SMSDirectoryData": {
	"error": 0,
	"result": "OK",
	"service": "Example",
	"version": 1.0,
	"status": "Ready"
}}
JSON;

	//Display Response
	echo $string;
}
else {
	
	//Generate Response
	$string = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<SMSDirectoryData>
	<error>401</error>
	<result>No Data</result>
	<service>Example</service>
	<version>1.0</version>
	<status>Ready</status>
</SMSDirectoryData>
XML;

	//Display Response
	$xml = new SimpleXMLElement($string);
	echo $xml->asXML();
}
?>
