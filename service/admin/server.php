<?php
    session_start();
    $username = "";
    $email = "";
    $password_1 = "";
    $password1 = "";
    $for = "";
    $name = "";
    $surname = "";
    $address = "";
    $phone = "";
    $regisdate = "";
    $birth = "";
    $errors = array();
    $web = "";
    $facebook = "";
    $db = mysqli_connect("localhost","root","","webtech1");

    if(isset($_POST["next"])){
        $for = $_POST['position'];
        if($for =='O'){
            header("Location: organizeRegis.php");
        }
        else{
            header("Location: attendantRegis.php");
        }
    }
    
    if(isset($_POST["registerAttendant"])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $surname = mysqli_real_escape_string($db, $_POST['surname']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);

        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($password_1)){
            array_push($errors, "Password is required");
        }
        
        if($password_1 != $password_2){
            array_push($errors, "The two password do not match");
        }

        if(empty($name)){
            array_push($errors, "Name is required");
        }

        if(empty($surname)){
            array_push($errors, "Surname is required");
        }

        // if(empty($birth)){
        //     array_push($errors, "Birthday is required");
        // }

        if(empty($address)){
            array_push($errors, "Address is required");
        }

        if(empty($phone)){
            array_push($errors, "Phone is required");
        }

        //if not error ,save user to database
        if (count($errors)==0) {
            $queryUser = "SELECT * FROM account WHERE user_name = '$username' ";
            $resU = mysqli_query($db,$queryUser) or die(mysqli_error($db));
            //if username already take
            if (mysqli_num_rows($resU)> 0) {
                array_push($errors, "This username is already taken");
            }else{
                $gender = $_POST['gender'];
                $password = password_hash($password_1, PASSWORD_BCRYPT); //encrypt passqword before save in 
        
                $query = "INSERT INTO account (user_name, password, role_id, status)  VALUES('$username', '$password', 'A','Active')";
                mysqli_query($db, $query);
                $queryAttendant = "INSERT INTO attendants (id, user_name, first_name, last_name,gender,email,phone,address,birth_date,regis_date)
                        VALUES(NULL, '$username', '$name', '$surname','$gender','$email','$phone','$address','$birth',CURRENT_TIMESTAMP)";
                mysqli_query($db, $queryAttendant);
                $_SESSION['success'] = "You are now logged in";
                $_SESSION["current_username"] = $username;
                header("Location: profile.php"); //direct to profile
                }

            }
            
        }
        
    if(isset($_POST["registerAttendant"])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $surname = mysqli_real_escape_string($db, $_POST['surname']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);

        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($password_1)){
            array_push($errors, "Password is required");
        }
        
        if($password_1 != $password_2){
            array_push($errors, "The two password do not match");
        }

        if(empty($name)){
            array_push($errors, "Name is required");
        }

        if(empty($surname)){
            array_push($errors, "Surname is required");
        }

        // if(empty($birth)){
        //     array_push($errors, "Birthday is required");
        // }

        if(empty($address)){
            array_push($errors, "Address is required");
        }

        if(empty($phone)){
            array_push($errors, "Phone is required");
        }

        //if not error ,save user to database
        if (count($errors)==0) {
            $queryUser = "SELECT * FROM account WHERE user_name = '$username' ";
            $resU = mysqli_query($db,$queryUser) or die(mysqli_error($db));
            //if username already take
            if (mysqli_num_rows($resU)> 0) {
                array_push($errors, "This username is already taken");
            }else{
                $gender = $_POST['gender'];
                $password = password_hash($password_1, PASSWORD_BCRYPT); //encrypt passqword before save in 
        
                $query = "INSERT INTO account (user_name, password, role_id, status)  VALUES('$username', '$password', 'A','Active')";
                mysqli_query($db, $query);
                $queryAttendant = "INSERT INTO attendants (id, user_name, first_name, last_name,gender,email,phone,address,birth_date,regis_date)
                        VALUES(NULL, '$username', '$name', '$surname','$gender','$email','$phone','$address','$birth',CURRENT_TIMESTAMP)";
                mysqli_query($db, $queryAttendant);
                $_SESSION['success'] = "You are now logged in";
                $_SESSION["current_username"] = $username;
                header("Location: profile.php"); //direct to profile
                }

            }
            
        }

        if(isset($_POST["registerOrganize"])){
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $email = mysqli_real_escape_string($db,$_POST['email']);
            $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
            $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
            $name = mysqli_real_escape_string($db, $_POST['name']);
            $phone = mysqli_real_escape_string($db, $_POST['phone']);
            $web= mysqli_real_escape_string($db, $_POST['web']);
            $facebook = mysqli_real_escape_string($db, $_POST['facebook']);
        
            if(empty($username)){
                array_push($errors, "Username is required");
            }

            if(empty($password_1)){
                array_push($errors, "Password is required");
            }
                
            if($password_1 != $password_2){
                array_push($errors, "The two password do not match");
            }
        
            if(empty($name)){
                array_push($errors, "Company's Name is required");
            }
        
            if(empty($email)){
                array_push($errors, "Email is required");
            }

            if(empty($phone)){
                array_push($errors, "Phone is required");
            }

            if(empty($website)){
                array_push($website, "website is required");
            }

            if(empty($facebook)){
                array_push($facebook, "facebook is required");
            }
        
            //if not error ,save user to database
            if (count($errors)==0) {
                $queryUser = "SELECT * FROM account WHERE user_name = '$username' ";
                $resU = mysqli_query($db,$queryUser) or die(mysqli_error($db));
                //if username already take
                if (mysqli_num_rows($resU)> 0) {
                    array_push($errors, "This username is already taken");
                }else{
                    $gender = $_POST['gender'];
                    $password = password_hash($password_1, PASSWORD_BCRYPT); //encrypt passqword before save in 
                
                    $query = "INSERT INTO account (user_name, password, role_id, status)  VALUES('$username', '$password', 'O','Active')";
                    mysqli_query($db, $query);
                    $queryOrganize = "INSERT INTO organizer (id, user_name, name,email,phone,website,facebook)
                            VALUES(NULL, '$username', '$name','$email','$phone','$web','$facebook')";
                    mysqli_query($db, $queryOrganize);
                    $_SESSION['success'] = "You are now logged in";
                    $_SESSION["current_username"] = $username;
                    header("Location: profile.php"); //direct to profile
                    }
        
                }
                    
            }
        //login
        if(isset($_POST["login"])){
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);
            if(empty($username)){
                array_push($errors, "Username is required");
            }
            if(empty($password)){
                array_push($errors, "Password is required");
            }
    
            if (count($errors)==0) {
                $query = "SELECT * FROM account WHERE user_name = '$username'";
                $results = mysqli_query($db, $query);
                $row = mysqli_fetch_array($results);
                
                if ($row['user_name'] == $username and password_verify($password, $row['password'])) {
                    if($row['status']== 'Active'){
                        $_SESSION["current_username"] = $username;
                        $_SESSION['success'] = "You are now logged in";
                        header("Location: profile.php"); //direct to profile
                    }else{
                        array_push($errors,"Your account has been disabled, please contact admin.");
                    } 
                }else{
                    array_push($errors, "The username or password is wrong!");
                }
    
                
            }
        }
    
        //logout
        if (isset($_GET['logout'])){
            session_destroy();
            unset($_SESSION['username']);
            header('Location: index.php');
        }
    
    


  


?>