<?php
	require("navigation.html");
	require_once("functions.php");
	require_once("dropdown.php");
	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
		
	}
	
	$dropdown = new dropdown($mysqli, $_SESSION["logged_in_user_id"]);
	
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
	}
		$doctor_name = "";
		$procedure_name = "";
		$operation_name = "";
		$operation_date = "";
		$operation_difficulty = "";
		$d_animal_name = "";
		$doctor_name_error = "";
		$procedure_name_error = "";
		$operation_name_error = "";
		$operation_date_error = "";
		$operation_difficulty_error = "";
		$d_animal_name_error = "";
	
	
		if(isset($_POST["docto"])){


			if ( empty($_POST["doctor_name"]) ) {
					$owner_name_error = "See väli on kohustuslik";
				}else{
					$doctor_name = cleanInput($_POST["doctor_name"]);
				}
			if ( empty($_POST["procedure_name"]) ) {
					$animal_name_error = "See väli on kohustuslik";
				}else{
					$procedure_name = cleanInput($_POST["procedure_name"]);
				}
			if ( empty($_POST["operation_name"]) ) {
					$animal_kind_error = "See väli on kohustuslik";
				}else{
					$operation_name = cleanInput($_POST["operation_name"]);
				}
			if ( empty($_POST["operation_date"]) ) {
					$operation_date_error = "See väli on kohustuslik";
				}else{
					$operation_date = cleanInput($_POST["operation_date"]);
				}
			if ( empty($_POST["operation_difficulty"]) ) {
					$operation_difficulty_error = "See väli on kohustuslik";
				}else{
					$operation_difficulty = cleanInput($_POST["operation_difficulty"]);
				}
			if ( empty($_POST["d_animal_name"]) ) {
				$d_animal_name_error = "See väli on kohustuslik";
			}else{
				$d_animal_name = cleanInput($_POST["d_animal_name"]);
			}
			
			
			
		if($doctor_name_error  == "" && $operation_name_error  == "" && $operation_date_error  == "" && $operation_difficulty_error  == "" && $d_animal_name_error == "" && $procedure_name_error == ""){

				$message = doctorView($doctor_name, $procedure_name, $operation_name, $operation_date, $operation_difficulty, $d_animal_name);
				
				if($message != ""){
					// õnnestus, teeme inputi väljad tühjaks
					$doctor_name = "";
					$operation_date = "";
					$procedure_name = "";
					$operation_name = "";
					$operation_difficulty = "";
					$d_animal_name = "";
					
					echo $message;
					
				}
			}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
  <title>LOOMAKLIINIK - Log in</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="materialize.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
</html>

<p>
	Tere, <?=$_SESSION["logged_in_user_email"];?> 
	<a href="?logout=1"> Logi välja </a> 
</p>

<div class="doctor-view">
<h2 class="doctor-h2">Arsti vaade</h2>
<form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<div class="row">
	<div class="input-field col s4">
		<label for="doctor_name">Arsti nimi</label>
		<input id="doctor_name" name="doctor_name" type="text" value="<?php echo $doctor_name; ?>"> <?php echo $doctor_name_error; ?>
	</div>
	</div>
	<div class="row">
	<div class="input-field col s4">
		<label for="animal_name">Protseduuri nimetus</label>
		<input id="procedure_name" name="procedure_name" type="text" value="<?php echo $procedure_name; ?>"> <?php echo $procedure_name_error; ?>
	</div>
	</div>
	<div class="row">
	<div class="input-field col s4">
		<label for="operation_name" >Operatsiooni nimetus</label>
		<input id="operation_name" name="operation_name" type="text" value="<?php echo $operation_name; ?>"> <?php echo $operation_name_error; ?>
	</div>
	</div>
	<div class="row">
	<div class="input-field col s4">
		<label for="date">Operatsiooni kuupäev</label>
		<input type="date" class="datepicker" value="<?php echo $operation_date; ?>"> <?php echo $operation_date_error; ?>
	</div>
	</div>
	<form action="#">
	
	<label for="operation_difficulty">Operatsiooni raskustase</label>
	<p>
	<input name="tase1" type="radio" id="tase1" value="<?php echo $operation_difficulty; ?>"> <?php echo $operation_difficulty_error; ?>
	<label for="tase1">1</label>
	</p>
	<p>
	<input name="tase2" type="radio" id="tase2" value="<?php echo $operation_difficulty; ?>"> <?php echo $operation_difficulty_error; ?>
	<label for="tase2">2</label>
	</p>
	<p>
	<input name="tase3" type="radio" id="tase3" value="<?php echo $operation_difficulty; ?>"> <?php echo $operation_difficulty_error; ?>
	<label for="tase3">3</label>
	</p>
	<p>
	<input name="tase4" type="radio" id="tase4" value="<?php echo $operation_difficulty; ?>"> <?php echo $operation_difficulty_error; ?>
	<label for="tase4">4</label>
	</p>
	<p>
	<input name="tase5" type="radio" id="tase5" value="<?php echo $operation_difficulty; ?>"> <?php echo $operation_difficulty_error; ?>
	<label for="tase5">5</label>
	</p>
	</form>
	<label for="d_animal_name" >Looma nimi</label>
	<form id="d_animal_name" name="d_animal_name" type="text" value="<?php echo $d_animal_name; ?>"> <?php echo $d_animal_name_error; ?>
	<?=$dropdown->createDropdown();?>
	</form>
	<a class="waves-effect waves-light btn" type="submit" name="register">Salvesta</a>
</div>
</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="materialize.min.js"></script>

 <script>
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
  </script>

</body>
</html>
<?php
require("footer.html");
?>
