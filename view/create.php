<?php 
// print("<pre>");
// print_r($_POST);
// print("</pre>");

// print("<pre>");
// print_r($_FILES);
// print("</pre>");

if(isset($_POST['createStudent']))
{

    if(empty($_POST['name'] && $_POST['email'] && $_POST['password'] && $_POST['gender'] && $_POST['age'] && $_POST['contact'] && $_POST['address']))
    {
       echo $message = "Fill All Data Field";
    }
    else
    {
        if(isset($_FILES) && !empty($_FILES['picture']['name']) && !empty($_FILES['video']['name']))
        {
//SAME HERE        
            // $p_ext = pathinfo($_FILES['picture']['name']);
            // $p_ext = strtolower($p_ext['extension']);

            $p_ext = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $v_ext = strtolower(pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION));

            $valid_image = ['jpg', 'png', 'jpeg', 'gif'];
            $valid_video = ['mp4', 'ogg', 'avi', 'wmv', 'flv', 'mov', 'webm'];
//check if not valid images
            // if($p_ext!="jpg" && $p_ext!="png" && $p_ext!="jpeg" && $p_ext!="gif")
            // {
            //     $p_ext = "";
            // }
            // else
            // {
            //     echo "valid Data";
            // }

            if(in_array($p_ext, $valid_image))
            {
               echo "valid Data" . "<br />"; 
            }

            if(in_array($v_ext, $valid_video))
            {
               echo "your Inserted Data type is " . $v_ext . "<br />";
               echo "All Valid Data type is";
               
               foreach($valid_video as $value)
                { 
                    echo $value . "<br />";
                }
            }

//check if not valid videos
            // if($v_ext!="mp4" && $v_ext!="ogg" && $v_ext!="avi" && $v_ext!="wmv" && $v_ext!="flv" && $v_ext!="mov" && $v_ext!="webm")
            // {
            //     $v_ext = "";
            // }
        }
        else
        {
            $p_ext = "";
            $v_ext = "";
        }

        $data = array(
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "gender" => $_POST['gender'],
            "age" => $_POST['age'],
            "contact" => $_POST['contact'],
            "address" => $_POST['address'],
            "picture" => $p_ext,
            "video" => $v_ext
        );
        
        $d = new Database();
        if($d->Insert("student", $data)){
            if($p_ext)
            {
                move_uploaded_file($_FILES['picture']['tmp_name'], "images/profile/profile_{$d->Id}.{$p_ext}");
            }

            if($v_ext)
            {
                move_uploaded_file($_FILES['video']['tmp_name'], "videos/video_{$d->Id}.{$v_ext}");
            }

            $fh = fopen("files/about_{$d->Id}.txt", "w"); 
            fwrite($fh, $_POST['about']);
            fclose($fh);

            echo $message = "Insert Successful";
        }   
        else
        {
            echo $message = "Server too busy"; 
        }    
    }
}


?>



<div class="container-fluid">
    <div class="row">
        <div class="body col-md-12">
            
            <div class="title">
                <h3>Create Date To Database</h3>
            </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
<!--For Name -->
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="tp_ext" name="name" placeholder="Name" class="form-control">
                                </div>
                            </div>
        <!--For Email -->
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon">&commat;</span>
                                    <input type="email" name="email" placeholder="email" class="form-control">
                                </div>
                            </div>
        <!--For Password -->
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" name="password" placeholder="password" class="form-control">
                                </div>
                            </div>
        <!--For Gender -->
                            <div class="form-group">
                                <label for="gender">Gender &nbsp;<i class="fa fa-transgender"></i> </label>
                                <div class="input-group">
                                    <label class="custom-control custom-radio">
                                      <input id="radio1" name="gender" value="male" type="radio" class="custom-control-input">
                                      <span class="custom-control-indicator"></span>
                                      <span class="custom-control-description"><i class="fa fa-male"></i> &nbsp; Male</span>
                                    </label>

                                    <label class="custom-control custom-radio">
                                      <input id="radio1" name="gender" value="female" type="radio" class="custom-control-input">
                                      <span class="custom-control-indicator"></span>
                                      <span class="custom-control-description"><i class="fa fa-female"></i> &nbsp; Female</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
        <!--For Age -->
                            <div class="form-group">
                                <label for="Age">Age</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="number" name="age" placeholder="age" class="form-control">
                                </div>
                            </div>
<!--For Contact -->
                            <div class="form-group">
                                <label for="Contact">Contact</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                    <input type="number" name="contact" placeholder="contact" class="form-control">
                                </div>
                            </div>
        <!--For Address -->
                           <div class="form-group">
                                <label for="Address">Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <textarea class="form-control" name="address" placeholder="Address" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
        <!--For Student -->
                            <div class="form-group">
                                <label for="About">About Student</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa  fa-info-circle "></i></span>
                                    <textarea class="form-control" name="about" placeholder="about" rows="3"></textarea>
                                </div>
                            </div>
<!--For Pictue -->
                            <div class="form-group">
                                <label for="Profile">Profile Pictue <i class="fa fa-file-picture-o"></i></label>
                                <div class="input-group">
                                    <input type="file" name="picture" class="form-control-file" >
                                </div>
                            </div>
        <!--For Video -->
                            <div class="form-group">
                                <label for="Video">Profile Video <i class="fa fa-file-video-o"></i></label>
                                <div class="input-group">
                                    <input type="file" name="video" class="form-control-file" >
                                </div>
                            </div>
                            <button type="submit" name="createStudent" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </div>
                    </div>
                </form>

        </div>
    </div>
</div>