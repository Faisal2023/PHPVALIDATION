<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Action</title>
</head>
<body>

	<h1>Registration Action</h1>

	<?php 
		if ($_SERVER['REQUEST_METHOD'] === "POST") {

			function test($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);

				return $data;
			}

			$firstname = test($_POST['fname']);
			$lastname = test($_POST['lname']);
			$gender= test($_POST['gender']);
			$religion= test($_POST['Religion']);
			$birthday= test($_POST['birthday']);
			$email= test($_POST['email']);
			$phone= test($_POST['phone']);



			if (empty($firstname) or empty($lastname)
				or empty($gender) or empty($religion) or empty($birthday) or empty($email) or empty($phone))  {
				echo "Please fill up the form properly";
			}
			else {
				define("FILENAME", "data.json");
				$handle = fopen(FILENAME, "r");
				$fr = fread($handle, filesize(FILENAME));
				$arr1 = json_decode($fr);
				$fc = fclose($handle);

				$handle = fopen(FILENAME, "w");
				if ($arr1 === NULL) {
					$id = 2;
					$data = array('id' => $id, 'fname' => $firstname, 'lname' => $lastname, 'gender'=> $gender);
					$data = array($data);
					$data = json_encode($data);
					$fw = fwrite($handle, $data);
				}
				else {
					$id = $arr1[count($arr1) - 1]->id;
					$data = array('id' => $id + 1, 'fname' => $firstname, 'lname' => $lastname);
					$arr1[] = $data;
					$data = json_encode($arr1);
					$fw = fwrite($handle, $data);
				}
				$fc = fclose($handle);

				if ($fw) {
					echo "<h3>Data Insertion Successful</h3>";
				}

			}

		}
	?>
	
	<a href="registration.html">Signup</a>

</body>
</html>