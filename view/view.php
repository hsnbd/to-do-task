
<div class="container-fluid">
    <div class="row">
        <div class="body col-md-12">
            <div class="title">
                <h3>View Student</h3>
            </div>
            
 
<?php
/****************************************************************************************
*                         col-md-4 not working
***************************************************************************************/
if(isset($_GET['vid']))
{
$d = new Database();
$data = $d->View("student", array("id", $_GET['vid']));

while($dt = mysqli_fetch_object($data))
{
?>
           <div class="data">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="list-group">
                            <div class="row">

                                <div class="col-md-4" style="height: 300px; overflow: hidden">
                                    <img class="img-thumbnail" src="images/profile/profile_<?php echo $dt->id.'.'.$dt->picture; ?>" width="300" alt="Thumbnail image"><br /><br /><br />
                                    <a class="btn-danger btn-lg" href="index.php?v=home&did=<?php echo $dt->id; ?>">Delete Student <i class="fa fa-trash"></i></a>
                                </div>
                                <div class="col-md-8">
                                    <li class="list-group-item"><span class="font-weight-bold">Name: &nbsp;</span><?php echo $dt->name; ?></li>
                                    <li class="list-group-item"><span class="font-weight-bold">Email: &nbsp;</span><?php echo $dt->email; ?></li>
                                    <li class="list-group-item"><span class="font-weight-bold">Gender: &nbsp;</span><?php echo $dt->gender; ?></li>
                                    <li class="list-group-item"><span class="font-weight-bold">Age: &nbsp;</span><?php echo $dt->age; ?></li>
                                    <li class="list-group-item"><span class="font-weight-bold">Contact: &nbsp;</span><?php echo $dt->contact; ?></li>
                                    <li class="list-group-item"><span class="font-weight-bold">Address: &nbsp;</span><?php echo $dt->address; ?></li>
                                    <li class="list-group-item"><span class="font-weight-bold">About: &nbsp;</span><?php if(file_exists("files/about_{$_GET['vid']}.txt")) { $fh = fopen("files/about_{$_GET['vid']}.txt", "r");echo fread($fh, filesize("files/about_{$_GET['vid']}.txt"));fclose($fh);}?></li>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <video width="400" controls>
                          <source src="videos/video_<?php echo $dt->id.'.'.$dt->video; ?>" type="video/<?php echo $dt->video; ?>">
                          Your browser does not support HTML5 video.
                        </video>
                    </div>
                </div>
            </div>
<?php
}
}
?>

        </div>
    </div>
</div>