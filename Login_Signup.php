<?php




//if session exists redirect to respective dashboard
$pageuser = 'login-signup';
include './pagePartials/Session_Validator.php';

// include alert if type of alert is set 
if (isset($_GET['m'])) {
    $myData = json_decode(base64_decode($_GET['m']), true);
    if (isset($myData['type']) && isset($myData['message'])) {
        $type = $myData['type'];
        $message = $myData['message'];
        include './pagePartials/alert.php';
        header("refresh:1;url=/deanacadproj/Login_Signup.php");
    }
}

// include html header with title given
$title = "Login-Signup";
include './pagePartials/header.php';





//read form data from the POST request and redirect to respective dashboard
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user']) && isset($_POST['uid_no'])) {
        $user = $_POST['user'];
        $uid_no = $_POST['uid_no'];

        //connection module is included
        include './config/config.php';

        //set sql statement and redirect acc to user type
        if ($user === 'Student') {
            $sql = "SELECT * 
                    FROM `student_view` WHERE reg_no='$uid_no'";
            $result = $conn->query($sql);
            //if user exist then show dashboad else redirect to login page
            if ($result->num_rows > 0) {
                //get students details from student table
                $row = $result->fetch_assoc();
                $_SESSION['user'] = $user;
                $_SESSION['student'] = $row;
                $conn->close();
                header("Location: /deanacadproj/Student_Dashboard.php");
                die();
            } else {
                $myData = array('type' => 'warning', 'message' => 'wrong registration no. ' . $uid_no);
                $arg = base64_encode(json_encode($myData));
                header('Location: /deanacadproj/Login_Signup.php?m=' . $arg);
                die();
            }
        } else {
            if ($user === 'Professor') {
                $sql = "SELECT * FROM `professors` WHERE prof_id='$uid_no' ";


                //if user exist then show dashboad else redirect to login page
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $conn->close();
                    $_SESSION['user'] = $user;
                    $_SESSION['professor'] = $row;
                    header("Location: /deanacadproj/Professor_Dashboard.php");
                    die();
                } else {
                    $myData = array('type' => 'warning', 'message' => 'wrong Employee id. ' . $uid_no);
                    $arg = base64_encode(json_encode($myData));
                    header('Location: /deanacadproj/Login_Signup.php?m=' . $arg);
                    die();
                }
            } else {
                $sql = "SELECT * FROM `professors` WHERE prof_id in (SELECT `prof_id` FROM `admin` WHERE id='$uid_no')";

                //if user exist then show dashboad else redirect to login page
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $conn->close();
                    $_SESSION['user'] = $user;
                    $_SESSION['professor'] = $row;
                    header("Location: /deanacadproj/Admin_Dashboard.php");
                    die();
                } else {
                    $myData = array('type' => 'warning', 'message' => 'wrong admin id. ' . $uid_no);
                    $arg = base64_encode(json_encode($myData));
                    header('Location: /deanacadproj/Login_Signup.php?m=' . $arg);
                    die();
                }
            }
        }
    }
}

?>

<body>
    <div class="container text-center">

        <div class="row gy-5" style="border: 1px solid red;">
            <h1>Welcome to MNNIT result portal.</h1>
        </div>

        <div class="row gx-5" style="border: 1px solid red;">
        
            <div class="col d-flex flex-column justify-content-center align-items-center " style="border: 1px solid red;">
            <img class="img-fluid" src="./img/MNNIT.png" alt="">
            </div>

            <div class="col-9 d-flex flex-column justify-content-center align-items-center" style="height:90vh; border: 1px solid red;">
               
            <form name="myform" class="p-3" style="width:22vw; border: 1px solid red;" method="POST">
                    <h2>Login</h2>
                    <div class="d-flex flex-row justify-content-around">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="user" id="user0" value="Student" checked>
                            <label class="form-check-label" for="user0">
                                Student
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="user" id="user1" value="Professor">
                            <label class="form-check-label" for="user1">
                                Professor
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="user" id="user2" value="Admin">
                            <label class="form-check-label" for="user2">
                                Admin
                            </label>
                        </div>

                    </div>

                    <div class="form-group">
                        <input required name="uid_no" type="text" class="form-control" placeholder="Registeration no. or Employee no.">
                        <small class="form-text text-muted">Enter your unique identification no.</small>
                    </div>
                    <button type="submit" class="btn btn-danger">Login</button>
                </form>
                <a href="Admission.php"><button class="btn btn-outline-danger w-100">Admission Portal</button></a>    
             
            </div>

        </div>
    </div>
</body>

</html>