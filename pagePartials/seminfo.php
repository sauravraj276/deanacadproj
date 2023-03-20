<?php 
//if course is open to professors registration show unregistered courses

if($progress==5){
echo '
<div class="col-4 d-flex flex-column justify-content-around" style="height:70vh; border: 1px solid red;">
                        <h4 class="border-bottom border-danger">Courses yet to be registered by prof</h4>
                        <div class="justify-content-center allign-self-center overflow-auto">

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">course code</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                include './config/config.php';
                                $sem_id=$sem['sem_id'];
                                $sql = "SELECT * FROM `course_sem` WHERE prof_id is NULL and sem_id=$sem_id";
                                $result = $conn->query($sql);
                                if($result->num_rows>0){
                                $row=$result->fetch_all();

                                foreach ($row as $r) {
                                        echo '<tr>
                                        <th scope="row">' . $r[1] . '</th>
                                    </tr>';
                                    }}
                                else echo 'All Courses are selected';    
                                    echo '
                                </tbody>
                            </table>
                        </div>
                    </div>';
                                }
if($progress==7){
echo '
<div class="col-4 d-flex flex-column justify-content-around" style="height:70vh; border: 1px solid red;">
                        <h4 class="border-bottom border-danger">prof yet to submit marks</h4>
                        <div class="justify-content-center allign-self-center overflow-auto">

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">prof_id</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                include './config/config.php';
                                $sem_id=$sem['sem_id'];
                                $sql = "SELECT DISTINCT prof_id FROM `courses_students`,`course_sem` WHERE cs_id=course_sem.id AND courses_students.marks is null AND course_sem.sem_id=$sem_id";
                                $result = $conn->query($sql);
                                if($result->num_rows>0){
                                $row=$result->fetch_all();

                                foreach ($row as $r) {
                                        echo '<tr>
                                        <th scope="row">' . $r[0] . '</th>
                                    </tr>';
                                    }}
                                else echo 'All Marks are entered';    
                                    echo '
                                </tbody>
                            </table>
                        </div>
                    </div>';
                                }



?>