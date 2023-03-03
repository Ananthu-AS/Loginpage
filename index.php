<?php require 'connection.php'; 
    $divshow=false;
    if(isset($_GET['email'])&&isset($_GET['passcode'])){        
        $email=$_GET['email'];
        $passcode=$_GET['passcode'];
        $passcode=hash('sha3-512',$passcode);
        $sql='SELECT * FROM log_data WHERE email=:email';
        $statement=$connection->prepare($sql);
        $statement->execute([':email'=>$email]);
        $user=$statement->fetch(PDO::FETCH_ASSOC);
        $email_check=$user['email'];
        $passcode_check=$user['passcode'];
        if($email==$email_check && $passcode==$passcode_check){
            echo '<a href="dashbord.php" target="_blank"></a>';
        } else{
            $divshow=true;
        }
    }
?>
<?php require 'header.php' ?>
<div class="container-fluid bg-secondary">
    <div class="container ">
        <div class="min-vh-100 row p-0 m-0 justify-content-center align-items-center">
            
            <div class="col-sm-6"><img src="./image/loginpic1.png" alt=""></div>
            <div class="col-sm-6">
                <div class="fs-1 fw-bold text-center mb-5 fst-italic">Login</div>
                <div class="alert alert-danger" role="alert" style= display:<?php if ($divshow==false){echo "none";} ?>>
                    incorrect email or password.
                </div>
                <form action="" method="POST">
                    <div class="mb-3"><input type="email" class="form-control p-3" placeholder="Email" name="email" required></div>
                    <div class="mb-3"><input type="password" class="form-control p-3" placeholder="Enter your password" name="password" required></div>
                    <div class="mb-3 row p-0 m-0"><input type="submit" class="p-3 bg-primary border-0 text-white" value="Login"></div>
                    <div class="mb-3 row p-0 m-0"><a href="registration.php" class="btn btn-success p-3" target="_blank">Create new Account</a></div>
                    <a href="" class="text-black">forgot password</a>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>