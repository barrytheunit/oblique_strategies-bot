<?php
/*-----------------------------------------*/
//Configure
$file = 'ron.txt';
$delimiter = '#image:';

// Slack parameters
$command = $_POST['command'];
$text    = $_POST['text'];
$token   = $_POST['token'];
/*-----------------------------------------*/

//Read the contents of the file
$file  = explode("\n", file_get_contents($file));
$total = count($file);

//Get random line or specified one from parameters...
if ($text!='') {
	$lineNumber = $text;
} else {
	$lineNumber= rand(0, $total-1);
}

//Parse line for text and images
$line = explode($delimiter,$file[$lineNumber]);

//text to reply with...
$reply = $line[0];

//image to reply with...
if (count($line)>1) {
	$image = $line[1];
} else {
	$image = '';
}

//Build response to send back to Slack
header('Content-type: application/json');
					   
$attachment = array('fallback'=>'OOPS. Sorry Brian Eno, this bot sucks... We failed you!!!!',
					'title'=>'',
					'image_url'=>$image);

echo json_encode(array('response_type'=>'in_channel',
			   'text'=>$reply,
					   'attachments'=> array($attachment)));

?>