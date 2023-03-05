<?php require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }
    else{
        $email=$_SESSION['email'];
        $sql_im='SELECT * FROM log_data WHERE email=:email';
        $statement=$connection->prepare($sql_im);
        $statement->execute([':email'=>$email]);
        $user=$statement->fetch(PDO::FETCH_ASSOC);
    }
?>
<?php require 'header.php' ?>
<div class="container-fluid bg-secondary-subtle ">
    <div class="container ">
        <div class="min-vh-100 row p-0 m-0 justify-content-center align-items-center">
            <div class="col-12 text-end"><a href="logout.php" class="text-black"> <i class="fa-solid fa-right-from-bracket fs-1"></i></a></div>
            <div class="col-12 row p-0 m-0 justify-content-center align-items-center">
                <div class="col-md-6 m-0 p-0">
                    <img src="uploads/<?=$user['image'] ?>" alt="" class="img-fluid">
                </div>
                <div class="col-md-6 m-0 p-0">
                    <p class="fs-1 fw-bold mb-5"><?=$user['fname'].' '.$user['lname']?></p>
                    <p class="fs-1 fw-bold mb-5"><?=$user['email'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>