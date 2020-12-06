<?php

session_start();

$pageTitle = "Profile";

include 'init.php';
if(isset($_SESSION['user']))
{

    $user     = getUsers($sessionUser);

    $items    = getItem('User_ID' , $user['UserID']);

    $comments = getComment($user['UserID']);
?>

    <h1 class="text-center"> <?php echo ucfirst($sessionUser) ?> Profile</h1>
    <div class="information block">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">My information</div>
                <div class="panel-body">
                Name      : <?php echo ucfirst($user['Username']) ?> <br>
                Email     : <?php echo $user['Email'] ?><br>
                Full Name : <?php echo $user['FullName'] ?><br>
                Date      : <?php echo $user['Date'] ?><br>
                </div>
            </div>
        </div>
    </div>

    <div class="my-ads block">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">My Advertisements</div>
                <div class="panel-body">
                <?php
                    if(!empty($items))
                    {
                        foreach($items as $item)
                        {
                            echo '<div class="col-sm-6 col-md-3">' ;
                                echo '<div class="thumbnail item-box">';
                                        echo '<small class="price-tag">$'. $item['Price'] .'</small>';
                                        echo '<img class="img-responsive" src="default.png" alt="" srcset="" width="200" height="300">';
                                        echo '<div class="caption">';
                                            echo '<h3>'. $item['Name'] .'</h3>';
                                            echo '<p>'. $item['Des'] .'</p>';
                                        echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    else
                    {
                        echo 'No Items';
                    }
                ?>
                </div>
            </div>
        </div>
    </div>

    <div class="my-comments block">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">Latest Comments</div>
                <div class="panel-body">
                <?php
                 if(!empty($comments))
                 {
                    foreach($comments as $comment)
                    {
                        echo '<p>' . $comment['comment'] . '</p>';
                    }
                 }
                 else
                 {
                     echo ' There\'s Comments To Show ' ;
                 }
                ?>
                </div>
            </div>
        </div>
    </div>

<?php
}
else
{
    header('Location: login.php');
    exit();
}
include $tpl . "footer.php";
