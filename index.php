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
                $_SESSION['email']=$email;      
                header('location:dashbord.php');                     
            } else{
                $divshow=true;
            }
        }
        else{
            $divshow=true;
        }                
    }
    if(isset($_POST['resetpass'])){
        $_email=$_POST['femail'];
        $_passcode=md5($_POST['re_newpass']);
        $_newpass=md5($_POST['newpass']);
        if($_newpass != $_passcode){
            $_SESSION['message']="password doesnot match.";
            $_SESSION["session_code"]="error";
            $_SESSION["page"]="index.php";
        }else{
            $sql='UPDATE log_data SET passcode=:passcode WHERE email=:email';
            $statement=$connection->prepare($sql);
            $statement->execute([':passcode'=>$_passcode,':email'=>$_email]);
            $_SESSION['message']="password changed successfully";
            $_SESSION["session_code"]="success";
            $_SESSION["page"]="index.php";
        }
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
                </form>
                <div class="text-end">
                    <a href="" class="text-black" data-bs-toggle="modal" data-bs-target="#modal">forgot password</a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Change password</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="POST">
                            <div class="modal-body" >
                                <p class="fs-5 text-primary fw-medium">Enter Your email Id.</p>
                                <input type="text" class="form-control mb-4" id="femail" name="femail" aria-describedby="emailHelp" required>
                                <p id="test" class="mb-4"></p>
                                <p class="fs-5 text-primary fw-medium">Security Question?</p>
                                <p class="mb-4" id="question"></p>
                                <div class="mb-4" id="ans"></div>
                                <div class="mb-4" id="answr"></div>
                                <div class="mb-4" id="newpass" ></div>
                                <div class="mb-4" id="re_newpass" ></div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="resetpass">Save changes</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>