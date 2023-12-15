<?php

require_once(__ROOT__ . "controller/Controller.php");
class UserController extends Controller
{
    public $FnameErr = ''; 
    public $LnameErr = ''; 
    public $EmailErr = ''; 
    public $passwordErr = ''; 
    public $confirmErr = ''; 
    public $emailTaken = false;

    // Getter and Setter for FnameErr
    public function getFnameErr() {
        return $this->FnameErr;
    }

    public function setFnameErr($FnameErr) {
        $this->FnameErr = $FnameErr;
    }

    // Getter and Setter for LnameErr
    public function getLnameErr() {
        return $this->LnameErr;
    }

    public function setLnameErr($LnameErr) {
        $this->LnameErr = $LnameErr;
    }

    // Getter and Setter for EmailErr
    public function getEmailErr() {
        return $this->EmailErr;
    }

    public function setEmailErr($EmailErr) {
        $this->EmailErr = $EmailErr;
    }

    // Getter and Setter for passwordErr
    public function getPasswordErr() {
        return $this->passwordErr;
    }

    public function setPasswordErr($passwordErr) {
        $this->passwordErr = $passwordErr;
    }

    // Getter and Setter for confirmErr
    public function getConfirmErr() {
        return $this->confirmErr;
    }

    public function setConfirmErr($confirmErr) {
        $this->confirmErr = $confirmErr;
    }

    // Getter and Setter for emailTaken
    public function getEmailTaken() {
        return $this->emailTaken;
    }

    public function setEmailTaken($emailTaken) {
        $this->emailTaken = $emailTaken;
    }

    public function insert() {
        $Fname = $_REQUEST['FName'];
        $Lname = $_REQUEST['LName'];
        $password = $_REQUEST['Password'];
        $Conpass = $_REQUEST['conPass'];
        $email = $_REQUEST['Email'];

        function isStrongPassword($password) {
            // Password requirements: at least 8 characters, one uppercase letter, one lowercase letter, one number, and one special character
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/';
            return preg_match($pattern, $password);
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Validate the first name field
        if (empty($Fname)) {
            $this->setFnameErr("First Name is required");
        } else {
            $name = test_input($Fname);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $this->setFnameErr("Only letters and white space allowed");
            }
        }

        // Validate the last name field
        if (empty($Lname)) {
            $this->setLnameErr("Last Name is required");
        } else {
            $name = test_input($Lname);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $this->setLnameErr("Only letters and white space allowed");
            }
        }

        // Validate the email field
        if (empty($email)) {
            $this->setEmailErr("Email is required");
        } else {
            $email = test_input($email);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->setEmailErr("Invalid Email format");
            }
        }
        //trying to adding validation on Email to check if this email are token or no 
        // hint lsa m3mltosh momken al7ta deh a3mlha f file msh f controller lw email msh mta5ed yb2a y call function mn alawl b2a 
		// $sql = "SELECT * FROM users WHERE Email = '$email'";
        // $result = $this->$db->query($sql);

        
        $check = $this->model->EmailCheck ($email);
    
        if ($check) {
            $this->setEmailErr("Email is already taken. Please, login.");
            $this->setEmailTaken(true);
        }
        

        // Validate the password field
        if (empty($password)) {
            $this->setPasswordErr("Password is required");
        } elseif (!isStrongPassword($password)) {
            $this->setPasswordErr("Password must be at least 8 characters long and contain one uppercase letter, one lowercase letter, one number, and one special character");
        }

        // Validate the confirm password field
        if (empty($Conpass)) {
            $this->setConfirmErr("Confirm is required");
        } else {
            $confirm = test_input($Conpass);

            if ($password !== $Conpass) {
                $this->setConfirmErr("Passwords don't match");
            }
        }

        //validate the confirm is equal pass and hashing password
        if($password === $Conpass){
			$hashedPW = password_hash($password, PASSWORD_DEFAULT , ["cost" => 12] );
        }else{
            $this->setConfirmErr("Confirm should be equal Password");
        }


        if (empty($this->getFnameErr()) && empty($this->getLnameErr()) && empty($this->getEmailErr()) && empty($this->getPasswordErr()) && empty($this->getConfirmErr()) && empty($birthErr) && !$this->getEmailTaken()) {
            $this->model->InsertinDB_Static($Fname, $Lname, $email, $hashedPW);
        } 
    }

    public function Login(){

        $Email = $_REQUEST['Email'];
		$password = $_REQUEST['Password'];

        $this->model->login($Email, $password);
    }

    public function Edit(){
        $Fname = $_REQUEST['FName'];
        $Lname = $_REQUEST['LName'];
        $Email = $_REQUEST['Email'];
        //we need validation on this tirms 
        
        $this->model->editinfo ($Fname,$Lname,$Email,$_SESSION['UserID']); 
    }

    public function EditPW(){
        $oldPass = $_REQUEST['old_Password'];
        $Password = $_REQUEST['Password'];
        
        //we need validation on this tirms 
        
        $this->model-> editPW($oldPass,$Password,$_SESSION['UserID']);
    }

    public function getUsers(){

       $Users = $this->model-> SelectAllUsersInDB();
        return $Users;
    }
    
    public function deleteUser($Userobj){
        $check = $this->model-> deleteUser($Userobj);
        return $check;
    }
    
}
