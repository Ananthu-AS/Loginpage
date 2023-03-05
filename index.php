<?php require 'connection.php'; 
    $divshow=false;
    if(isset($_POST['email'])&&isset($_POST['passcode'])){        
        $email=$_POST['email'];
        $passcode=md5($_POST['passcode']);
        $sql='SELECT email,passcode FROM log_data WHERE email=:email';
        $statement=$connection->prepare($sql);
        $statement->execute([':email'=>$email]);
        $user=$statement->fetch(PDO::FETCH_ASSOC);
        if($user){
            $email_check=$user['email'];
            $passcode_check=$user['passcode'];
            if($email==$email_check && $passcode==$passcode_check){             
                $_SESSION["message"]="Login successfull.";
                $_SESSION["session_code"]="success";               
                $_SESSION['email']=$email;   
                $_SESSION["page"]="dashbord.php";             
            } else{
                $divshow=true;
            }
        }
        else{
            $divshow=true;
        }                
    }
    if(isset($_SESSION['logout'])){
        $_SESSION['message']="logout successfully";
        $_SESSION["session_code"]="success";
        $_SESSION["page"]="index.php";
        unset($_SESSION["logout"]);
        session_destroy();
    }
    
?>
<?php require 'header.php' ?>
<div class="container-fluid bg-secondary-subtle">
    <div class="container ">
        <div class="min-vh-100 row p-0 m-0 justify-content-center align-items-center">
            
            <div class="col-lg-6"><img src="./image/loginpic1.png" alt="" class="img-fluid"></div>
            <div class="col-lg-6">
                <div class="fs-1 fw-bold text-center mb-5 fst-italic">Login</div>
                <div class="alert alert-danger" role="alert" style= display:<?php if ($divshow==false){echo "none";}else{echo "block";} ?>>
                    incorrect email or password.
                </div>
                <form action="" method="POST">
                    <div class="mb-3"><input type="email" class="form-control p-3" placeholder="Email" name="email" required></div>
                    <div class="mb-3"><input type="password" class="form-control p-3" placeholder="Enter your password" name="passcode" required></div>
                    <div class="mb-3 row p-0 m-0"><input type="submit" class="p-3 bg-primary border-0 text-white" value="Login"></div>
                    <div class="mb-3 row p-0 m-0"><a href="registration.php" class="btn btn-success p-3" target="_blank">Create new Account</a></div>
                    <a href="" class="text-black">forgot password</a>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>