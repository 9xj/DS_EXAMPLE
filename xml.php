<?php
header("Content-type: application/xml");

//Get Data
$data = file_get_contents('php://input');

//Check for data
if(isset($data)) {
	
	//Write xml file
	$file = fopen('data/'.time().".xml", "w") or die("Unable to open file!");
	fwrite($file, $data);
	fclose($file);

	//Generate Response
	$string = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<SMSDirectoryData>
	<error>0</error>
	<result>OK</result>
	<service>Example</service>
	<version>1.0</version>
	<status>Ready</status>
</SMSDirectoryData>
XML;

	//Display Response
	$xml = new SimpleXMLElement($string);
	echo $xml->asXML();
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
