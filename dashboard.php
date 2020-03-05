<?php
$item = filter_input(INPUT_GET, 'item', FILTER_VALIDATE_INT, null);
if (($item > 5) || ($item < 0)) {
    session_start();
    $_SESSION['ErrorMsg'] = "page not found";
    header("Location: error.php");
    exit();
}
include "header.php";
include "connect.php";
include "Dashboard_Navbar.php";

$details = array();
$username = $_SESSION['username'];
$q = "SELECT * FROM tblusers WHERE username=:username";
$result = $conn->prepare($q);
$result->bindParam(':username', $username);
$result->execute();

$row = $result->fetch(PDO::FETCH_ASSOC);

$details = array(
    "firstname" => $row['firstname'],
    "lastname" => $row['lastname'],
    "username" => $row['username'],
    "email" => $row['email'],
    "photo" => $row['photo'],
    "birthday" => $row['birthday'],
    "bio" => $row['bio'],
    "registertime" => $row['registertime'],
    "score" => $row['score'],
    "languages" => $row['languages'],
    "namechangecount" => $row['namechangecount'],
    "privacy" => $row['privacy']
);


switch ($item) {
    case 1:
        include "edit_profile.php";
        break;
    case 2:
        include "groups.php";
        break;
    case 3:
        include "submissions.php";
        break;
    case 4:
        include "contests.php";
        break;
    case 5:
        include "friend.php";
        break;

}

if ($item == 0) {
    ?>
    <div class="dash-main">
        <div class="row">
            <div class="col-6">
                <div class="dash-left shadow p-4">
                    <h3><i class="fa fa-info"></i> Your details</h3>
                    <hr>
                    <ul>
                        <li>
                            <span><i class="fa fa-user-circle"></i> Full Name: </span>
                            <span><?php echo $details['firstname'] ?><?php echo $details['lastname'] ?></span>
                        </li>
                        <li>
                            <span><i class="fa fa-user"></i> Username: </span>
                            <span><?php echo $details['username']; ?></span>
                        </li>
                        <li>
                            <span><i class="fa fa-envelope"></i> Email: </span>
                            <span><?php echo $details['email']; ?></span>
                        </li>
                        <li>
                            <span><i class="fa fa-birthday-cake"></i> Birthday: </span>
                            <span><?php echo $details['birthday']; ?></span>
                        </li>
                        <li>
                            <span><i class="fa fa-calendar-check"></i> Register time: </span>
                            <span><?php echo date('Y-m-d', strtotime(str_replace('-', '/', $details['registertime']))); ?></span>
                        </li>
                        <li>
                            <span><i class="fa fa-star"></i> Score: </span>
                            <span><?php echo $details['score']; ?></span>
                        </li>
                        <li>
                            <span><i class="fa fa-code"></i> Languages: </span>
                            <span><?php echo $details["languages"]; ?></span>
                        </li>
                        <li>
                            <span><i class="fa fa-user-lock"></i></span>
                            <div class="checkbox disabled d-inline-block">
                                <label><input type="checkbox" value="" disabled checked> Option 3</label>
                                <label><input type="checkbox" value="" disabled checked> Option 3</label>
                            </div>

                                <?php
                                $No=$details["privacy"];
                                // privacy options : int32
                                // bit 0:
                                //if ()
                                ?>

                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-6">
                <div class="dash-right">
                    <ul>
                        <li>
                            <span></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php
}
include "footer.php";