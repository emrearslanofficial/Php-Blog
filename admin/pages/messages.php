<?php 
include("../../database/db.class.php");
include("../../database/blogs.class.php");

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

$messages = new Messages();
$message = $messages->getMessages();

?>

<script src="../../editor/build/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-LgV+8OIvaNDJ4qaVRr8p6mBtYXdzXan9/PMz8axkJvVqznY5CxV+q4wYwAIi/kyS" crossorigin="anonymous"></script>

<?php include('../partials/header.php')?>
<?php include('../partials/sidebar.php')?>
<?php include('../partials/main.php')?>

                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Merhaba, <?php echo $_SESSION["name"]?></h4>
                            <span class="ml-1">Email</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Email</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Gelen</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <div class="card-body">
                                        <div class="email-left-box px-0 mb-5">
                                            <div class="p-0">
                                                <a href="#" class="btn btn-primary btn-block">Yanıtla</a>
                                            </div>
                                            <div class="mail-list mt-4">
                                                <a href="#" class="list-group-item active"><i
                                                        class="fa fa-inbox font-18 align-middle mr-2"></i> Gelen <span
                                                        class="badge badge-danger badge-sm float-right">
                                                            <?php echo count($message)?>
                                                    </span> </a>
                                                <a href="javascript:void()" class="list-group-item"><i
                                                        class="fa fa-paper-plane font-18 align-middle mr-2"></i>Giden</a>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="email-right-box">
                                            <div class="email-list mt-4">
                                                <?php foreach($message as $msg):?>
                                                <div class="message mb-1" style="border: 1px solid rgba(192,192,192, 0.5); border-radius:5px;">
                                                    <div>
                                                        <div class="d-flex message-single">
                                                            <div class="ml-5 my-3 mx-2">
                                                                <i class="icon-envelope menu-icon"></i>                                                        
                                                            </div>
                                                        </div>
                                                        <a href="read-message.php?id=<?php echo $msg->id; ?>" class="col-mail col-mail-2">
                                                            <div class="subject"><?php echo $msg->title;?></div>
                                                            <div class="date"><?php echo date("H:i", strtotime($msg->time)); ?></div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php endforeach?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>



<?php include('../partials/main-end.php')?>
<?php include('../partials/footer.php')?>