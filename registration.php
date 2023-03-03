<?php require 'connection.php' ?>
<?php require 'header.php' ?>
<div class="container-fluid bg-secondary bg-gradient min-vh-100">
    <div class="container ">
        <div class="min-vh-100 row p-0 m-0 justify-content-center align-items-center">
            
            <div class="col-sm-6"><img src="./image/register.png" alt=""></div>
            <div class="col-sm-6">
                <div class="fs-1 fw-bold text-center mb-3 fst-italic">Register</div>
                <form action="">
                    <div class="mb-4"><input type="text" class="form-control p-2" placeholder="First name" required></div>
                    <div class="mb-4"><input type="text" class="form-control p-2" placeholder="Last name" required></div>
                    <div class="mb-4"><input type="email" class="form-control p-2" placeholder="Email"  required></div>
                    <div class="mb-4"><input type="file" class="form-control p-2" placeholder="Choose" required></div>
                    <div class="mb-4"><input type="password" class="form-control p-2" placeholder="Password" required></div>
                    <div class="mb-4"><input type="password" class="form-control p-2" placeholder="Confirm password" required></div>
                    <div class="mb-4">
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>Choose one security question.</option>
                            <option value="1">Your nick name</option>
                            <option value="2">Your pet name</option>
                            <option value="3">Your favourite four digit number.</option>
                        </select>
                    </div>
                    <div class="mb-3"><input type="text" class="form-control p-2" placeholder="Your Answere" required></div>
                    <div class="mb-3 row p-0 m-0"><input type="submit" class="p-3 bg-primary border-0 text-white" placeholder="Submit"></div>
                </form>
            </div>
        </div>
    </div2>
</div>
<?php require 'footer.php' ?>