<?php

    ob_start(); // Output buffering start

    session_start();

    if(isset($_SESSION['Username']))
    {
       $pageTitle = "Dashboard";
       include 'init.php';
    /*Start Dashboard page*/

    $latestUser     = 3 ; // Number of latest users
    $theLatestUsers = getLatest('*' , 'users' , 'UserID' , $latestUser); // Latest users array

    $latestitems    = 3 ; // Number of latest users
    $theLatestitems = getLatest('*' , 'items' , 'item_ID' , $latestitems); // Latest items array
    ?>
    <div class="container home-stats text-center">
         <h1>Dashboard</h1>
         <div class="row">
              <div class="col-md-3">
                    <div class="stat st-members">
                        <i class="fa fa-users"></i>
                        <div class="info">
                            Total Members
                            <span>
                                <a href="members.php"> <?php echo countItems('UserID' , 'users') ?> </a>
                            </span>
                        </div>
                    </div>
              </div>

              <div class="col-md-3">
                    <div class="stat st-pending">
                            <i class="fa fa-user-plus"></i>
                            <div class="info">
                            Panding Members
                            <span><a href="members.php?do=Manage&page=Pending">
                                    <?php echo  checkItem("RegStatus" , "users" , 0) ?></a>
                            </span>
                         </div>
                    </div>
              </div>

              <div class="col-md-3">
                    <div class="stat st-items">
                         <i class="fa fa-tag"></i>
                         <div class="info">
                            Total Items
                            <span>
                                <span> <a href="items.php"> <?php echo countItems('item_ID ' , 'items') ?> </a> </span>
                            </span>
                         </div>
                    </div>
              </div>

              <div class="col-md-3">
                    <div class="stat st-comments">
                        <i class="fa fa-comments"></i>
                        <div class="info">
                            Total Comments
                            <span><a href="comments.php"> <?php echo countItems('comment_id' , 'comments') ?> </a></span>
                        </div>
                    </div>
              </div>
         </div>
    </div>


    <div class="container latest">
         <div class="row">
              <div class="col-sm-6">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                           <i class="fa fa-users"></i>Latest <?php echo $latestUser ?> Registerd Users
                           <span class="pull-right toggle-info">
                               <i class="fa fa-plus fa-lg"></i>
                           </span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled latest-users">
                                <?php
                                    foreach($theLatestUsers as $user)
                                    {
                                        echo '<li>' . $user['Username'] .
                                                '<a href="members.php?do=Edit&userid='.$user['UserID'].'">
                                                <span class="btn btn-success pull-right">
                                                 <i class="fa fa-edit"></i> Edit </span> </a>

                                                 <a href="members.php?do=Delete&userid='.$user['UserID'].'">
                                                <span class="btn btn-danger pull-right">
                                                 <i class="fa fa-edit"></i> Delete </span> </a>';

                                                if($user['RegStatus'] == 0)
                                                    {
                                                        echo "<a href='members.php?do=Activate&userid=" . $user['UserID'] . "' class='btn btn-info pull-right activate'> <i class='fa fa-check'></i>  Activate </a>";
                                                    }
                                               '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                   </div>
              </div>

              <div class="col-sm-6">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                           <i class="fa fa-users"></i>Latest <?php echo $latestitems ?> Items
                            <span class="pull-right toggle-info">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled latest-users">
                                <?php
                                    foreach($theLatestitems as $item)
                                    {
                                        echo '<li>' . $item['Name'] .
                                                '<a href="items.php?do=Edit&itemid='.$item['item_ID'].'">
                                                <span class="btn btn-success pull-right">
                                                 <i class="fa fa-edit"></i> Edit </span> </a>

                                                 <a href="items.php?do=Delete&itemid='.$item['item_ID'].'">
                                                <span class="btn btn-danger pull-right">
                                                 <i class="fa fa-edit"></i> Delete </span> </a>';

                                                if($item['Approve'] == 0)
                                                    {
                                                        echo "<a href='items.php?do=Approve&itemid=" . $item['item_ID'] . "' class='btn btn-info pull-right activate'> <i class='fa fa-check'></i>  Approve </a>";
                                                    }
                                               '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                   </div>
              </div>
         </div>
    </div>
    <?php
    /*End Dashboard page*/
       include $tpl . "footer.php";
    }
    else
    {
        // echo 'You are not authorized to view this page';
        header('Location: index.php');
        exit();
    }
    ob_end_flush();

    ?>
