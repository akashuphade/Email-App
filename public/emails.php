<?php

//Set execution time to max
ini_set("max_execution_time", 0);

use App\Classes\Email;

require_once(dirname(__FILE__) . "/ini/ini.php");
require_once(dirname(__FILE__, 2) . "/vendor/autoload.php");
require_once BASE_PATH . "/inc/navbar.php";


//Initialise the variables
$readEmail = false;
$action = 'unseen';

//Check the action specified
if (isset($_GET['action'])) {

    $action = $_GET['action'];

    if ($action === 'seen') {
        $readEmail = true;
    }

}


//Initialize the email object
$emailObj = new Email();
$emailObj->init();

//On Submit check the action and perform it
if (isset($_POST['mark_read']) || isset($_POST['mark_unread']) || isset($_POST['delete'])) {

    //Get the modified values
    $checkedFields = array_filter($_POST, function($value){
        return $value > 0;
    });

    $msgNumbers = implode(',', $checkedFields);

    //check the action and call function based on it
    if (isset($_POST['mark_read'])) {
        $emailObj->markAsRead($msgNumbers);
    } else if (isset($_POST['mark_unread'])) {
        $emailObj->markAsUnread($msgNumbers);
    } else {
        $emailObj->deleteMails($msgNumbers);
    }

} 

//Get the email data
$emailData = $emailObj->getEmails(EMAIL_TO_FILTER_FROM, $readEmail);
    
?>
    <div class="container mt-4 ml-4 mr-4">

        <div id="error" class="card card-body mb-4 mt-4 border border-danger d-none">
            <span class="invalid-feedback  d-inline-block" role="alert">
                <strong><ul><li><?php echo "Please select at least one email record" ?></li></ul></strong>
            </span>
        </div>
        
        <div class="card">
            <div class="card-header text-center"><h1><?php echo $action==='unseen' ? 'Unread Email List' : 'Read Email List' ?></h1></div>
     
            <div class="card-body">
                <form action="#" method="POST" onsubmit="return formValidation();">

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="10%">
                                <div class="form-check text-center mb-4">    
                                    <input type="checkbox" class="form-check-input" id="checkAll" name="checkAll"> 
                                </div>
                            </th>
                            <th width="20%">Name</th>
                            <th width="30%">Email</th>
                            <th width="20%">Mobile</th>
                            <th width="30%">Address</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 

foreach($emailData as $email) {
    $senderData = $emailObj->getFormattedData($email["message"]);
    $uid = $email["msgno"];

?>
                <tr>
                    <td>
                        <div class="form-check text-center mb-4">    
                            <input type="checkbox" class="form-check-input" id="<?php echo $uid ?>" name="<?php echo $uid ?>" value="<?php echo $uid ?>"> 
                        </div>
                    </td>
                    <td><?php echo $senderData["name"] ?? 'Not available' ?></td>
                    <td><?php echo $senderData["email"] ?? 'Not available' ?></td>
                    <td><?php echo $senderData["phone no"] ?? 'Not available' ?></td>
                    <td><?php echo $senderData["address"] ?? 'Not available' ?></td>
                </tr>
<?php } ?>

                </tbody>
            </table>
                <div class="mt-4 row justify-content-center">
                    <button type="submit" name="<?php echo $action==='unseen' ? 'mark_read' : 'mark_unread' ?>" class="btn btn-primary btn-sm"><?php echo $action==='unseen' ? 'Mark as Read' : 'Mark as Unread' ?></button>
                    <button type="submit" name="delete" class="btn btn-danger btn-sm ml-2">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
    
        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    });

    //VAlidate the form before action
    function formValidation() {
     
        var len = document.querySelectorAll('.checkbox input[type="checkbox"]:checked').length;
        if (len <= 0) {
            $("#error").removeClass("d-none");
            return false;
        }
    }
</script>