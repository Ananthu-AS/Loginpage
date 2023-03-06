<?php require 'connection.php';
    $val=false;
    if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])&&isset($_POST['passcode'])&&isset($_POST['con_passcode'])&&isset($_POST['question'])
        &&isset($_POST['answere'])){
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $email=$_POST['email'];
            $passcode=md5($_POST['passcode']);
            $con_passcode=md5($_POST['con_passcode']);
            $question=$_POST['question'];
            $answere=$_POST['answere'];
            // image
            $image=$_FILES['image']['name'];
            $temp=$_FILES['image']['tmp_name'];
            $target="uploads/".basename($image);

            $sql='SELECT email FROM log_data WHERE email=:email';
            $statement=$connection->prepare($sql);
            $statement->execute([':email'=>$email]);
            $data=$statement->fetch(PDO::FETCH_ASSOC);
            if($data){
                $val=true;
            }
            elseif($passcode!=$con_passcode){
                $_SESSION["message"]="password does not match.";
                $_SESSION["session_code"]="warning";
                $_SESSION["page"]="registration.php";
            }
            else{
                $sql='INSERT INTO log_data (fname,lname,passcode,question, answere, email, image) VALUES(:fname, :lname, :passcode, :question, :answere, :email, :image)';
                $statement=$connection->prepare($sql);
                $statement->execute([':fname'=>$fname, ':lname'=>$lname, ':passcode'=>$passcode, ':question'=>$question, ':answere'=>$answere, ':email'=>$email, ':image'=>$image]);
                $_SESSION["message"]="Data updated successfully.";
                $_SESSION["session_code"]="success";
                $_SESSION["page"]="index.php";
                $move_pic=move_uploaded_file($temp,$target);
            } 
        }
?>
<?php require 'header.php' ?>
<div class="container-fluid bg-secondary-subtle bg-gradient min-vh-100">
    <div class="container ">
        <div class="min-vh-100 row p-0 m-0 justify-content-center align-items-center">
            
            <div class="col-sm-6"><img src="./image/register.png" alt=""></div>
            <div class="col-sm-6">
                <div class="fs-1 fw-bold text-center mb-3 fst-italic">Register</div>
                <?php if($val){
                    echo "<div class='alert alert-danger' role='alert'>
                    Email alredy exists.
                  </div>";
                }  ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-4"><input type="text" class="form-control p-2" placeholder="First name" name="fname" required></div>
                    <div class="mb-4"><input type="text" class="form-control p-2" placeholder="Last name" name="lname" required></div>
                    <div class="mb-4"><input type="email" class="form-control p-2" placeholder="Email" name="email" required></div>
                    <div class="mb-4"><input type="file" class="form-control p-2" placeholder="Choose" name="image"></div>
                    <div class="mb-4"><input type="password" class="form-control p-2" placeholder="Password" name="passcode" required></div>
                    <div class="mb-4"><input type="password" class="form-control p-2" placeholder="Confirm password" name="con_passcode" required></div>
                    <div class="mb-4">
                        <select class="form-select" aria-label="Default select example" name="question" required>
                            <option selected>Choose one security question.</option>
                            <option value="Your nick name">Your nick name</option>
                            <option value="Your pet name">Your pet name</option>
                            <option value="Your favourite four digit number.">Your favourite four digit number.</option>
                        </select>
                    </div>
                    <div class="mb-3"><input type="text" class="form-control p-2" placeholder="Your Answere" name="answere" required></div>
                    <div class="mb-3 row p-0 m-0"><input type="submit" class="p-3 bg-primary border-0 text-white" placeholder="Submit" name="submit"></div>
                    <div class="mb-3 row p-0 m-0"><a href="index.php" class="btn btn-info p-3" target="_blank">Already have an Account?</a></div>
                </form>
            </div>
        </div>
    </div2>
</div>
<?php require 'footer.php' ?>