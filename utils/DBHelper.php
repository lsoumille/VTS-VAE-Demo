<?php 
class DBHelper {
	//Create connection to MySQL Instance
	private function createConnection() {
		$mysqli = new mysqli("192.168.99.122", "admin", "admin", "vtsdemo");

		if ($mysqli->connect_errno) {
    		echo "Error during MySQL connection : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		} else {
			return $mysqli;
		}
	}

	private function closeConnection($connection) {
		$connection->close();

	}

	//Return all the tuples in an array
	public function getAllDatabase() {
		$connection = $this->createConnection();
		$query = "SELECT * FROM transformation order by id";
		$array = $connection->query($query) or die ("Query failed. Result: $result");
		$this->closeConnection($connection);
		$rows = [];
		while($row = mysqli_fetch_array($array))
		{
    		$rows[] = $row;
		}
		return $rows;
	}

	//Return all the tuples in an array
	public function getAllCustomers() {
		$connection = $this->createConnection();
		$query = "SELECT * FROM customer order by id";
		$array = $connection->query($query) or die ("Query failed. Result: $result");
		$this->closeConnection($connection);
		$rows = [];
		while($row = mysqli_fetch_array($array)) {
    		$rows[] = $row;
		}
		return $rows;
	}

	//Perform the query in param
	//Be careful the query must be sanitized 
	public function performQuery($connection, $query) {
		if(!isset($connection))
			$conn = $this->createConnection();
		else
			$conn = $connection;
		$result = $connection->query($query) or die ("Query failed. Result: $result");
		if(!isset($connection))
			$this->closeConnection($connection);
		return $connection->insert_id;
	}

	//Add transformation into the database
	public function addData($action, $beforeData, $afterData, $comments) {
		$connection = $this->createConnection();
		$query = "insert into transformation (action,input,output,comments) values('$action', '$beforeData', '$afterData', '$comments')";
		$this->performQuery($connection, $query);
		$this->closeConnection($connection);
		//return $result;
	}

	//Delete the row with the id inside the table defined in parameters
	public function deleteById($table, $id) {
		$connection = $this->createConnection();
		$query = "delete from $table where id='$id'";
		$this->performQuery($connection, $query);
		$this->closeConnection($connection);
	}

	//Add a new customer in the database
	public function addCustomer($tablename, $firstname, $lastname, $birthDate, $phone_number, $nationality, $ssn, $address, $city, $postcode, $country, $cardnumber, $expirationdate, $cvv) {
		$connection = $this->createConnection();
		$phone_number = ($phone_number === null ? "null" : "'".$phone_number."'");
		$nationality = ($nationality === null ? "null" : "'".$nationality."'");
		$ssn = ($ssn === null ? "null" : "'".$ssn."'");
		$address = ($address === null ? "null" : "'".$address."'");
		$city = ($city === null ? "null" : "'".$city."'");
		$postcode = ($postcode === null ? "null" : "'".$postcode."'");
		$country = ($country === null ? "null" : "'".$country."'");
		$cardnumber = ($cardnumber === null ? "null" : "'".$cardnumber."'");
		$expirationdate = ($expirationdate === null ? "null" : "'".$expirationdate."'");
		$cvv = ($cvv === null ? "null" : "'".$cvv."'");
		$query = "insert into ".$tablename." (firstname, lastname, birthDate, phoneNumber, nationality, ssn, address, city, postcode, country, cardNumber, expirationDate, cvv) values('$firstname', '$lastname', '$birthDate', $phone_number, $nationality, $ssn, $address, $city, $postcode, $country, $cardnumber, $expirationdate, $cvv)";
		//print $query.'\n';
		$result = $this->performQuery($connection, $query);
		$this->closeConnection($connection);
		return $result;
	}
}
?>