<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<?php

$dbhost = 'localhost';
$dbuser = 'dbuser';
$dbpass = 'dbpass';
$dbname = 'dbname';

//connect to db
$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

$action = @$_REQUEST['action'];


switch($action)
{
	case "insertcompany":
		$co_name = $mysqli->real_escape_string($_REQUEST['co_name']);
		$co_address = $mysqli->real_escape_string($_REQUEST['co_address']);
		$co_city = $mysqli->real_escape_string($_REQUEST['co_city']);
		$co_state = $mysqli->real_escape_string($_REQUEST['co_state']);
		$co_zip = $mysqli->real_escape_string($_REQUEST['co_zip']);
		
		$query = "insert into test_companies (name, address, city, state, zip) values (\"$co_name\", \"$co_address\", \"$co_city\", \"$co_state\", \"$co_zip\")";
		$mysqli->query($query);
		echo "Company added";
		echo "<br><a href=\"".htmlentities($_SERVER['SCRIPT_URL'])."\">Back to Menu</a>";
		break;
		
	case "insertemployee";
		$empl_name = $mysqli->real_escape_string($_REQUEST['empl_name']);
		$empl_adddress = $mysqli->real_escape_string($_REQUEST['empl_address']);
		$empl_city = $mysqli->real_escape_string($_REQUEST['empl_city']);
		$empl_state = $mysqli->real_escape_string($_REQUEST['empl_state']);
		$empl_zip = $mysqli->real_escape_string($_REQUEST['empl_zip']);
		$company = $mysqli->real_escape_string($_REQUEST['empl_company']);
		
		$query = "insert into test_employees (name, address, city, state, zip, company) values (\"$empl_name\", \"$empl_adddress\", \"$empl_city\", \"$empl_state\", \"$empl_zip\", \"$company\")";
		$mysqli->query($query);
		echo "Employee added";
		echo "<br><a href=\"".htmlentities($_SERVER['SCRIPT_URL'])."\">Back to Menu</a>";
		break;
		
	case "entercompany":
		?>
		<form action="<?php echo htmlentities($_SERVER['SCRIPT_URL']); ?>?action=insertcompany" method="post">
			<table>
				<tr><td><label for="co_name">Company Name:</label></td> <td><input type="text" name="co_name" id="co_name"></td></tr>
				<tr><td><label for="co_address">Address:</label></td> <td><input type="text" name="co_address" id="co_address"></td></tr>
				<tr><td><label for="co_city">City:</label></td> <td><input type="text" name="co_city" id="co_city"></td></tr>
				<tr><td><label for="co_state">State:</label></td> <td><input type="text" name="co_state" id="co_state" maxlength="2"></td></tr>
				<tr><td><label for="co_zip">Zip Code:</label></td> <td><input type="number" name="co_zip" id="co_zip" min="0" max="99999"></td></tr>
				<tr><td colspan="2"><input type="submit" name="submit" id="submit" value="submit"></td></tr>
			</table>
		</form>
		<br><a href="<?php echo htmlentities($_SERVER['SCRIPT_URL']); ?>">Back to Menu</a>
		<?php
		break;
		
	case "enteremployee";
		?>
		<form action="<?php echo htmlentities($_SERVER['SCRIPT_URL']); ?>?action=insertemployee" method="post">
			<table>
				<tr><td><label for="empl_name">Employee Name:</label></td> <td><input type="text" name="empl_name" id="empl_name"></td></tr>
				<tr><td><label for="empl_address">Address:</label></td> <td><input type="text" name="empl_address" id="empl_address"></td></tr>
				<tr><td><label for="empl_city">City:</label></td> <td><input type="text" name="empl_city" id="empl_city"></td></tr>
				<tr><td><label for="empl_state">State:</label></td> <td><input type="text" name="empl_state" id="empl_state" maxlength="2"></td></tr>
				<tr><td><label for="empl_zip">Zip Code:</label></td> <td><input type="number" name="empl_zip" id="empl_zip" min="0" max="99999"></td></tr>
				<tr><td><label for="empl_company">Company:</label></td> 
					<td>
						<select name="empl_company" id="empl_company">
						<?php /*list companies*/ 
							$query = "select prikey,name from test_companies";
							$result = $mysqli->query($query);
							while($data = $result->fetch_array(MYSQLI_ASSOC)) 
							{
								echo "<option value=\"".$data['prikey']."\">".$data['name']."</option>\n";
							}
						?>
						</select>
					</td>
				</tr>
				<tr><td colspan="2"><input type="submit" name="submit" id="submit" value="submit"></td></tr>
			</table>
		</form>
		<br><a href="<?php echo htmlentities($_SERVER['SCRIPT_URL']); ?>">Back to Menu</a>
		<?php
		break;
		
	case "listcompanies";
		$query = "select c.*, count(1) as num_empl from test_employees e, test_companies c where e.company=c.prikey group by e.company";
		$result = $mysqli->query($query);
		echo "<table border=\"1\">\n";
		echo "<tr> <th>Company Name</th> <th>Address</th> <th>City</th> <th>State</th> <th>Zip Code</th> <th>Num. Employees</th> </tr>\n";
		while($data = $result->fetch_array(MYSQLI_ASSOC))
		{
			echo "<tr> ";
			echo "<td>".$data['name']."</td>";
			echo "<td>".$data['address']."</td>";
			echo "<td>".$data['city']."</td>";
			echo "<td>".$data['state']."</td>";
			echo "<td>".$data['zip']."</td>";
			echo "<td>".$data['num_empl']."</td>";			
			echo "</tr>\n";			
		}
		echo "</table>\n";
		echo "<br><a href=\"".htmlentities($_SERVER['SCRIPT_URL'])."\">Back to Menu</a>";
		break;
		
	case "listemployees";
		$query = "select e.*,c.name as coname from test_employees e, test_companies c where e.company=c.prikey";
		$result = $mysqli->query($query);
		echo "<table border=\"1\">\n";
		echo "<tr> <th>Employee Name</th> <th>Address</th> <th>City</th> <th>State</th> <th>Zip Code</th> <th>Company</th> </tr>\n";
		while($data = $result->fetch_array(MYSQLI_ASSOC)) 
		{
			echo "<tr> ";
			echo "<td>".$data['name']."</td>";
			echo "<td>".$data['address']."</td>";
			echo "<td>".$data['city']."</td>";
			echo "<td>".$data['state']."</td>";
			echo "<td>".$data['zip']."</td>";
			echo "<td>".$data['coname']."</td>";			
			echo "</tr>\n";			
		}
		echo "</table>\n";
		echo "<br><a href=\"".htmlentities($_SERVER['SCRIPT_URL'])."\">Back to Menu</a>";
		break;
		
	default:
	
	?>
	<ul style="margin-left:auto; margin-right:auto;">
		<li><a href="<?php echo htmlentities($_SERVER['SCRIPT_URL']); ?>?action=entercompany">Enter Company Info</a></li>
		<li><a href="<?php echo htmlentities($_SERVER['SCRIPT_URL']); ?>?action=enteremployee">Enter Employee Info</a></li>
		<li><a href="<?php echo htmlentities($_SERVER['SCRIPT_URL']); ?>?action=listcompanies">List Companies and number of employees</a></li>
		<li><a href="<?php echo htmlentities($_SERVER['SCRIPT_URL']); ?>?action=listemployees">List Employees and company</a></li>
	</ul>
	<?php
}
$mysqli->close();
?>
</body>
</html>
