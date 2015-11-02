<?php
class user {
	//terve kood peab olema selle class user sees
	
	private $connection;
	
	//see funktsioon käivitub, kui tekitame uue instantsi
	//new user()
	function __construct($mysqli){
		
		//$this on see klass ehk user
		//-> connection on klassi muutuja
		$this->connection = $mysqli;
	
	}
	
	function logInUser($email, $hash){
                
        $stmt = $this->connection->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
        $stmt->bind_param("ss", $email, $hash);
        $stmt->bind_result($id_from_db, $email_from_db);
        $stmt->execute();
        if($stmt->fetch()){
            echo "Kasutaja logis sisse id=".$id_from_db;
            
            // sessioon, salvestatakse serveris
            $_SESSION['logged_in_user_id'] = $id_from_db;
            $_SESSION['logged_in_user_email'] = $email_from_db;
            
            //suuname kasutaja teisele lehel
            header("Location: data.php");
            
        }else{
            echo "Wrong credentials!";
        }
		
        $stmt->close();
        
    }
	
	function createUser($create_email, $hash){

        $stmt = $this->connection->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
        $stmt->bind_param("ss", $create_email, $hash);
        $stmt->execute();
        $stmt->close();
		
    }
	
}
?>