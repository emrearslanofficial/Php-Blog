<?php 
include("../../database/db.class.php");
include("../../database/blogs.class.php");

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if($id !== null && is_numeric($id)){
        $messages = new Messages();
        $message = $messages->getMessages();
        $msgId = $id;
        $nowMessage = $messages->getMessagesById($id);
    }


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
                                                <a href="messages.php" class="list-group-item active"><i
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
                                        <div class="row">
                                        <div class="col-12">
                                            <div class="right-box-padding">
                                                
                                                <div class="read-content">
                                                    <div class="media pt-3">
                                                        <img class="mr-4 rounded-circle" alt="image" src="../images/avatar/1.jpg">
                                                        <div class="media-body">
                                                            <h5 class="text-primary"><?php echo $nowMessage[0]->name_surname; ?></h5>
                                                            <p class="mb-0"><?php echo date("Y-m-d", strtotime($nowMessage[0]->time)); ?></p>
                                                        </div>
                                                        <a href="javascript:void()" class="text-muted "><i
                                                                class="fa fa-reply"></i> </a>
                                                        <a href="javascript:void()" class="text-muted ml-3"><i
                                                                class="fa fa-long-arrow-right"></i> </a>
                                                        <a href="javascript:void()" class="text-muted ml-3"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>
                                                    <hr>
                                                    <div class="media mb-4 mt-5">
                                                        <div class="media-body"><span class="pull-right"><?php echo date("H:i", strtotime($nowMessage[0]->time)); ?></span>
                                                            <h5 class="my-1 text-primary"><?php echo $nowMessage[0]->title; ?></h5>
                                                            <p class="read-content-email">
                                                            <?php echo $nowMessage[0]->mail; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="read-content-body">
                                                        <p>
                                                        <?php echo $nowMessage[0]->message; ?>
                                                        </p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group pt-3">
                                                        <textarea class="w-100 form-control" name="write-email" id="write-email" cols="30" rows="5" placeholder="Yanıtla"></textarea>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button class="btn btn-primary btn-sl-sm mb-5" type="button">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>



<?php include('../partials/main-end.php')?>
<?php include('../partials/footer.php')?>