<?php
//if session exists redirect to respective dashboard
$pageuser = 'login-signup';
include './pagePartials/Session_Validator.php';

// include html header with title given
$title = "Admission";
include './pagePartials/header.php';

//Add student to db
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (isset($_POST['name']) && isset($_POST['reg_no']) && isset($_POST['sem_id'])) {
        $name=$_POST['name'];
        $reg_no=$_POST['reg_no'];
        $sem_id=$_POST['sem_id'];
        
        //Retrive semester having sem_id
        include './config/config.php';
        $sql = "SELECT * FROM `semester`,`programs` WHERE sem_id=$sem_id AND program=id" ;
        $result = $conn->query($sql);
        $semester=$result->fetch_row();
        $department=$semester[12];
        $add_year=$semester[5];
        $program_id=$semester[3];

        $sql = "INSERT INTO `students`(`reg_no`, `name`, `department`, `admission_year`, `program_id`, `curr_sem_id`, `active`)
         VALUES ('$reg_no','$name','$department','$add_year','$program_id','$sem_id','1')";   
        
        if($result = $conn->query($sql) != NULL){
            include './pagePartials/functions.php';
            reg_student($reg_no,$sem_id);
            $myData = array('type' => 'Success', 'message' => 'Student Admitted' . $reg_no);
                $arg = base64_encode(json_encode($myData));
                header('Location: /deanacadproj/Login_Signup.php?m=' . $arg);
                die();
        }
        else print_r("Something Went Wrong");
    }
}

// drop menu to select program and take admission
// sem no etc is automatically selected from the db
//connection module is included
include './config/config.php';
$sql = "SELECT * FROM `semester`,`programs` WHERE program=id AND progress=1" ;
$result = $conn->query($sql);
$semesters = $result->fetch_all();
?>



<body>
    <div class="container text-center">

        <div class="row gy-5" style="border: 1px solid red;">
            <h1>Welcome to MNNIT Admission portal.</h1>
        </div>

        <div class="row gx-5" style="border: 1px solid red;">
            <div class="col d-flex flex-column justify-content-center align-items-center " style="border: 1px solid red;">
                <img class="img-fluid" src="./img/MNNIT.png" alt="">
            </div>


            <div class="col-9 d-flex flex-column justify-content-center align-items-center" style="height:90vh; border: 1px solid red;">
                <form name="myform" class="p-3" style="width:22vw; border: 1px solid red;" method="POST">
                    <h2>Admission</h2>
                    <div class="form-group">
                        <input required name="name" type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input required name="reg_no" type="number" class="form-control" placeholder="Registeration no.">
                    </div>
                    <select class="form-control form-control-sm" name="sem_id" id="semester" required>
                        <?php
                        foreach ($semesters as $semester) {
                            echo '<option value=' . $semester[0] . '>' . $semester[5] . '-' . $semester[7] .'-' . $semester[10] . '</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-danger">Take admission</button>
                </form>
                <a href="Login_Signup.php"><button class="btn btn-outline-danger w-100">Login_Signup</button></a>    
             
            </div>

        </div>
    </div>
</body>

</html>