<?php
// Database
class Model {
  private $host = 'localhost';
  private $user = 'root';
  private $password = '';
  private $dbname = 'crud_db';
  private $conn;

  function __construct()
  {
    $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
    if ($this->conn->connect_error) {
      echo 'Connection Failed';
    } else {
      return $this->conn;
    }
  } // constructor close

  // function for INSERT record
  public function insertRecord($post) {
    $name = $post['name'];
    $email = $post['email'];
    $sql = "INSERT INTO users(name, email) VALUES('$name', '$email')";
    $result = $this->conn->query($sql);
    if ($result) {
      header('Location: index.php?msg=ins');
    } else {
      echo "Error " .$sql. "<br>".$this->conn->error;
    }
  } // insertRecord function close

  // function for DISPLAY records
  public function displayRecord() {
    $sql = "SELECT * FROM users";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $data[] = $row;
      } // while close
      return $data;
    } // if close
  } // dipslayRecord function close

  // function for display record by ID
  public function displayRecordById($editid) {
    $sql = "SELECT * FROM users WHERE id = $editid";
    $result = $this->conn->query($sql);
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      return $row;
    } // if close
  } // function displayRecordById close

  // function for UPDATE record
  public function updateRecord($post) {
    $name = $post['name'];
    $email = $post['email'];
    $editid = $post['hid'];
    $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id='$editid'";
    $result = $this->conn->query($sql);
    if ($result) {
      header('Location: index.php?msg=ups');
    } else {
      echo "Error " .$sql. "<br>".$this->conn->error;
    }
  } // insertRecord function close

  // function for DELETE record
  public function deleteRecord($delid) {
    $sql = "DELETE FROM users WHERE id='$delid'";
    $result = $this->conn->query($sql);
    if ($result) {
      header('Location: index.php?msg=del');
    } else {
      echo "Error ".$sql. "<br>".$this->conn->error;
    }
  }
} // class close

?>