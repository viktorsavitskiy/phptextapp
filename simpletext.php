<!DOCTYPE HTML>

<html>
<head>
    <html lang ="en">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>SimpleText</title>
	<link rel="stylesheet" href="bootstrap-3.3.4-dist/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="custom.css">
</head>
<body>

<div id="wrapper">
	<div id="candy">
<h1 class="bg-primary">Text App</h1>
<p class="bg-info"><small>This is a Simple text messaging app</small></p>
<p class="bg-info"><small>Please enter a eleven-digit number to get started</small></p>


<form method="post" id="pnform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<p class="info">valid format: 12622345678</p>
<input type="text" name="phonenumber" placeholder=" Enter a Number"/> 
<input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
</form>
<br/>
<p class="info">(Optional) Message</p>
<textarea rows="6" cols="40" form="pnform" name="message"></textarea>

<br/>
<br/>
<?php
$errors =[];
$pn =" ";
$msg = " ";
if (isset($_POST["submit"])){
	if(empty($_POST["phonenumber"])){
		$errors[] = "Please Enter a Phone Number";
		
	} if (!empty($_POST["phonenumber"])){
		$pn = $_POST["phonenumber"];
		
	} if (preg_match("/^[0-9]{11}$/", $pn)){
		trim($pn, " ");
		
	}if(!preg_match("/^[0-9]{11}$/", $pn)) {
		$errors[] ="Phone number is in a invalid format";
	}
		if(empty($_POST["message"])){
			$msg ="Default Message: Hello from the text app";
		}if(!empty($_POST["message"])) {
			$msg = $_POST["message"];
			trim($msg, " ");
		}
		if($errors){
			foreach($errors as $err){
				echo "<p class='label label-danger'>$err</p><br/><br/>";
			}
		}
		else{
			//api info is here
			

			// send message
			
			 require('twilio-php-master/Services/Twilio.php');
			
			//$account_sid ='add sid here';
			//$auth_token = 'add token_id here';
			
			$client= new Services_Twilio($account_sid, $auth_token);
		
				$client->account->messages->create(array( 
					'To' => "$pn", 
					'From' => "+12629474413", //<- add your twilio number here 
					'Body' => "$msg",   
				));
	
	
			 echo "<p class='label label-success'>Sent Message to: $pn</p>";
			 //print $message->sid;
			 //}
			
		}
	
}  

	
		
?>

<br/><br/>
<p class="bg-primary" id="footer">Created by Viktor S.</p>
</div>
</div>

</body>
</html>
