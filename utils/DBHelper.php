<?php 
class DBHelper {
	//Create connection to MySQL Instance
	private function createConnection() {
		$mysqli = new mysqli("192.168.99.122", "admin", "admin", "vtsdemo");

		if ($mysqli->connect_errno) {
    		echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
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
		return $result;
	}

	public function deleteById($id) {
		$connection = $this->createConnection();
		$query = "delete from transformation where id='$id'";
		$this->performQuery($connection, $query);
		$this->closeConnection($connection);
	}

	public function addCustomer($tablename, $firstname, $lastname, $birthDate, $phoneNumber, $nationality, $ssn, $address, $city, $postcode, $country, $cardnumber, $expirationdate, $cvv) {
		$connection = $this->createConnection();
		$query = "insert into ".$tablename." (firstname, lastname, birthDate, phoneNumber, nationality, ssn, address, city, postcode, country, cardNumber, expirationDate, cvv) values('$firstname', '$lastname', '$birthDate', '$phoneNumber', '$nationality', '$ssn', '$address', '$city', '$postcode', '$country', '$cardnumber', '$expirationdate', '$cvv')";
		$result = $this->performQuery($connection, $query);
		$this->closeConnection($connection);
		return $result;
	}
}
?>