<?php
include_once("UserClass.php");

if(isset($_GET['edit_id'])){
    $UserObject = new User($_GET['edit_id']) ;
}

if(isset($_POST["submit"])){
    $Fname=$_POST["FName"];
    $Lname=$_POST["LName"];
    $Email=$_POST["Email"];
    
    $UserObject=User::editinfoinadmin($Fname,$Lname,$Email,$_GET['edit_id']);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditUser</title>
   
   
   <style>
             
    body {

        color: black;
        background: #D3D3D3;
        font-family: 'Lato', sans-serif;
        font-size: 15px;
        line-height: 1.42857;
        margin-left: 300px; /* Increase the margin to shift the content further right */
    }


    .container {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
        text-align: center;
    }

    .container label {
        font-weight: bold;
    }

    .container input {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .container button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: auto; /* Push the button to the bottom of the container */
    align-self: center; /* Center the button horizontally */
}

    .container button:hover {
        background-color: #0056b3;
    }


.navbar {
            width: 250px;
            height: 100%;
            background-color: white;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar a {
            display: block;
            width: 60%;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
            color: white;
            font-weight: bold;
            margin: 10px 0;
            border-radius: 5px;
            background-color: gray;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar a:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 0;
            padding: 20px;
        }

        /* Media query for smaller screens */
        @@media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .navbar {
                width: 200px;
                height: 100%;
                background-color: #333;
                position: fixed;
                left: 0;
                top: 0;
                color: white;
                padding: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .content {
                margin-left: 0;
            }
        }

        .logo {
            width: 150px;
            height: auto;
            margin: 20px 0;
        }
        @media (max-width: 768px) {
            .navbar {
                width: 100%;
                background-color: #007BFF;
                padding: 10px;
                align-items: flex-start;
            }

            .navbar a {
                padding: 10px 20px;
                margin: 10px 0;
            }

            .logo {
                width: 100px;
                margin: 10px 0;
            }
        }


    </style>
</head>
<body>
   
    <div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
   
    </div>
    <form method="post">
    <div class="container">        
        <h2>Edit User</h2>

            <label for="">First Name <span>*</span></label>
            <input type="text" name = "FName" value="<?=$UserObject->FName?>" >
        
        
            <label for="">Last Name <span>*</span></label>
            <input type="text"   name = "LName" value="<?=$UserObject->LName?>" >
        
            <label for="">Email <span>*</span></label>
            <input type="email" name = "Email" value="<?=$UserObject->Email?>">
        						
        
        <button type="submit"name="submit" class="btn btn-default login-btn">Submit</button>
</div>
    </form>						
</body>
</html>