                <!-- fondawsome -->
                <script
                        src="https://kit.fontawesome.com/046d649ff2.js"
                        crossorigin="anonymous"
                ></script>
                <!-- bootstrap js -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js
                        "></script>
                <!-- swal js -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <?php if(isset($_SESSION["message"])&& $_SESSION["message"] != ""): 
                        ?>
                <script>
                        Swal.fire({
                        icon: '<?=$_SESSION["session_code"] ?>',
                        text: '<?=$_SESSION["message"] ?>',
                        title:'<?=$_SESSION["session_code"] ?>',
                        })
                        .then(function(){
                                window.location = "<?=$_SESSION["page"]?>";
                        })
                </script>
                <?php 
                // unset($_SESSION["message"]);
                    session_unset();    
                    session_destroy();
                ?>
                <?php endif ?>

        <!-- jqery cdn -->
        <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"
        ></script>
        <script>
            $(document).ready(() => {
                $("#femail").keyup(() => {
                    let email_search = $("#femail").val();
                    console.log(email_search);
                    $.ajax({
                        url: "forgotpassword.php",
                        method: "POST",
                        data: { email:email_search },
                        success:function(data) {
                            
                            console.log(data);
                            if (data!=0) {
                                $('#test').html('<i class="fa-solid fa-check text-success"></i>');
                                var json = JSON.parse(data);
                                $('#question').html(json.question);
                                $('#ans').html('<input type="text" name="answer" id="answer" placeholder="Your Answer" class="form-control" required>');
                                $('#answer').keyup(()=>{
                                    let user_answer = $('#answer').val();
                                    if(user_answer == json.answere){
                                        console.log("answer match");
                                        $('#answr').html(' <i class="fa-solid fa-check text-success"></i>')
                                        $('#newpass').html('<input type="password" name="newpass" id="newpass" placeholder="New Password" class="form-control" required>')
                                        $('#re_newpass').html('<input type="password" name="re_newpass" id="re_newpass" placeholder="Confirm Password" class="form-control" required>')
                                    }else{
                                        $('#answr').html('<i class="fa-solid fa-circle-xmark text-danger"></i>')
                                    }
                                })
                            } else {
                                $('#test').html('<i class="fa-solid fa-circle-xmark text-danger"></i>');
                            }
                        },
                    });

                });
            });

        </script>

                <!-- own js -->
                <script src="./js/script.js"></script>
        </body>
</html>