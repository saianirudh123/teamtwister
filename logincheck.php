<?php 
	include_once("includer.php");
?>
<?php //here i will compare the login values with the database
	if(isset($_POST['submit'])){

		//check whether the username and password fields are empty: will be done through javascript
		if((trim($_POST['username'])!='') && (trim($_POST['password'])!='')){

			//initialize $username and $password
			$username=trim(mysqlPrep($_POST['username'])); 
			$password=trim(mysqlPrep($_POST['password']));
		
			//check the length of user name and password: in javascript: required??

			$hash_password = sha1($password);
			
			//start the comparision process
			$query = "SELECT * FROM teamtwisterusers WHERE username='{$username}' AND hash_password='{$hash_password}' LIMIT 1";
		
			$set = mysql_query($query);

			//to confirm the query
			confirmQuery($set);
		
			$num = mysql_num_rows($set);
		
			if($num){
				$_SESSION['username'] = $username;	
			}
			else{
				$error_message = "Username/Password Incorrect. Please try again";
			}
		}
		else{
			$error_message = "Username/Password field left empty.Try again";
		}
	}
	if($error_message){
			header("Location: index.php?login=0");
		} else {
			header("Location: index.php?login=1");
		}
?>