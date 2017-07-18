<?php

if(isset($_POST['updateStudent']))
{
// print "<pre>";
// print_r($_POST);
// print "</pre>";

    if(!empty($_POST['name'] && $_POST['email'] && $_POST['password'] && $_POST['gender'] && $_POST['age'] && $_POST['contact'] && $_POST['address']) && isset($_FILES) && !empty($_FILES['picture']['name']) && !empty($_FILES['video']['name']))
    {
//SAME HERE 
            $d = new Database();
            $data = $d->Edit("student", array("id", $_GET['eid']));
            $dt = mysqli_fetch_object($data);
            $p_old_ext = $dt->picture;
            $v_old_ext = $dt->video;

            $p_ext = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $v_ext = strtolower(pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION));
//check if not valid images
            if($p_ext!="jpg" && $p_ext!="png" && $p_ext!="jpeg" && $p_ext!="gif")
            {
                $p_ext = $p_old_ext;
            }
            else
            {
                if($p_old_ext)
                {
                    unlink("images/profile/profile_{$_GET['eid']}.{$dt->picture}");
                }
                move_uploaded_file($_FILES['picture']['tmp_name'], "images/profile/profile_{$_GET['eid']}.{$p_ext}");
            }
//check if not valid videos
            if($v_ext!="mp4" && $v_ext!="ogg" && $v_ext!="avi" && $v_ext!="wmv" && $v_ext!="flv" && $v_ext!="mov")
            {
                $v_ext = $v_old_ext;
            }
            else
            {
                if($v_old_ext)
                {
                    unlink("videos/video_{$_GET['eid']}.{$dt->video}");
                }
                move_uploaded_file($_FILES['video']['tmp_name'], "videos/video_{$_GET['eid']}.{$v_ext}");
            }

            if(file_exists("files/about_{$_GET['eid']}.txt"))
            {
                unlink("files/about_{$_GET['eid']}.txt");
            }
            $fh = fopen("files/about_{$_GET['eid']}.txt", "w"); 
            fwrite($fh, $_POST['about']);
            fclose($fh);


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



        if($d->Update("student", $data, array("id", $_GET['eid']))){
        header("Location: index.php?v=home&message=Update Successful");
        }   
        else{
            echo $message = "Server too busy"; 
        }    
    }
    else
    {
        echo $message = "Fill All Data Field";
    }
}


?>



<div class="container-fluid">
    <div class="row">
        <div class="body col-md-12">
            
            <div class="title">
                <h3>Create Date To Database</h3>
            </div>

<?php 

if(isset($_GET['eid']))
{
    $d = new Database();
    $data = $d->Edit("student", array("id", $_GET['eid']));
    $dt = mysqli_fetch_object($data);

/****************************************************************************************
*                                                HOW THEY WORK WITHOUT WHILE LOOP
***************************************************************************************/
?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
        <!--For Name -->
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="tp_ext" name="name" value="<?php echo $dt->name; ?>" placeholder="Name" class="form-control">
                                </div>
                            </div>
        <!--For Email -->
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon">&commat;</span>
                                    <input type="email" name="email" value="<?php echo $dt->email; ?>" placeholder="email" class="form-control">
                                </div>
                            </div>
        <!--For Password -->
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" name="password" value="<?php echo $dt->password; ?>" placeholder="password" class="form-control">
                                </div>
                            </div>
        <!--For Gender -->
                            <div class="form-group">
                                <label for="gender">Gender &nbsp;<i class="fa fa-transgender"></i> </label>
                                <div class="input-group">
                                    <label class="custom-control custom-radio">
                                      <input id="radio1" name="gender" value="male" type="radio" class="custom-control-input" <?php if($dt->gender == 'male'){echo "checked"; } ?> >
                                      <span class="custom-control-indicator"></span>
                                      <span class="custom-control-description"><i class="fa fa-male"></i> &nbsp; Male</span>
                                    </label>

                                    <label class="custom-control custom-radio">
                                      <input id="radio1" name="gender" value="female" type="radio" class="custom-control-input" <?php if($dt->gender == 'female'){echo "checked"; } ?> >
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
                                    <input type="number" name="age" value="<?php echo $dt->age; ?>" placeholder="age" class="form-control">
                                </div>
                            </div>
        <!--For Contact -->
                            <div class="form-group">
                                <label for="Contact">Contact</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                    <input type="number" name="contact" value="<?php echo $dt->contact; ?>" placeholder="contact" class="form-control">
                                </div>
                            </div>
        <!--For Address -->
                           <div class="form-group">
                                <label for="Address">Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <textarea class="form-control" name="address" placeholder="Address" rows="3"><?php echo $dt->address; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
        <!--For Student -->
                            <div class="form-group">
                                <label for="About">About Student</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa  fa-info-circle "></i></span>
                                    <textarea class="form-control" name="about" value="<?php echo $dt->name; ?>" placeholder="about" rows="3"><?php if(file_exists("files/about_{$_GET['eid']}.txt")) { $fh = fopen("files/about_{$_GET['eid']}.txt", "r");echo fread($fh, filesize("files/about_{$_GET['eid']}.txt"));fclose($fh);}?></textarea>
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
                            <button type="submit" name="updateStudent" class="btn btn-primary btn-lg btn-block">Update Student</button>
                        </div>
                    </div>
                </form>
<?php
}
?>

        </div>
    </div>
</div>