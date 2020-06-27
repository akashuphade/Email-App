<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

//Set execution time to max
ini_set("max_execution_time", 0);

use App\Classes\Email;

require_once realpath("../vendor/autoload.php");
require_once realpath("./inc/navbar.php");

$error = false;

//On Submit check the action and perform it
if (isset($_POST['mark_unread']) || isset($_POST['delete'])) {
    
    if (count($_POST) === 1) {
        $error = true;
    }

    //Get the modified values
    $checkedFields = array_filter($_POST, function($value){
        return $value > 0;
    });

    $msgNumbers = implode(',', $checkedFields);

    $emailObj = new Email();
    $emailObj->init();

    if (isset($_POST['mark_unread'])) {
        $emailObj->markAsUnread($msgNumbers);
    }
} 

$emailObj = new Email();
$emailObj->init();
$emailData = $emailObj->getEmails('uphade.akash25@gmail.com', true);
    
?>
    <div class="container mt-4 ml-4 mr-4">
<?php 
if ($error) { 
?>
        <div class="card card-body mb-4 mt-4 border border-danger">
            <span class="invalid-feedback  d-inline-block" role="alert">
                <strong><ul><li><?php echo "Please select at least one email record" ?></li></ul></strong>
            </span>
        </div>
<?php 
        }
?>
    
    
        <div class="card">
            <div class="card-header text-center"><h1>Unread Email List</h1></div>
     
            <div class="card-body">
                <form action="#" method="POST">

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
                    <button type="submit" name="mark_unread" class="btn btn-primary btn-sm">Mark as Unread</button>
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
</script>