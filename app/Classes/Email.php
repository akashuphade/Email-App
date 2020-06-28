<?php 

namespace App\Classes;

require_once(dirname(__FILE__, 3) . "/public/ini/ini.php");

class Email 
{
    // imap server connection
	public $conn;

	// To store the credentials
	private $server;
	private $user;
    private $pass;
    private $folder;
    
    //Initialize the variables
    public function __construct()
    {   
        $this->server = SERVER;
        $this->user = USER;
        $this->pass = PASSWORD;
        $this->folder = FOLDER;
    }
    
    //Connect with the server
    public function init()
    {
        //Check if imap is enabled 
        if (! function_exists('imap_open')) {
            echo "IMAP is not configured.";
            exit();
        }

        /* Connecting Gmail server with IMAP */
        try {
            
             $connection = imap_open($this->server . $this->folder, $this->user, $this->pass);
            
        } catch (\Throwable $th) {
            echo "Error while connecting to server : " . imap_last_error();
            exit();
        }
         
        $this->conn = $connection;
    }

    /**
     * @Brief: It will give list of all emails
     * 
     * @Param : $fromEmail -> Filter for from emails
     *          $isRead -> Filter to return read/unread emails
     */
    public function getEmails($fromEmail, $isRead)
    {

        if($isRead) {
            $mailStatus  = 'SEEN';
        } else {
            $mailStatus = 'UNSEEN';
        }

        $emailIds = imap_search($this->conn, 'FROM "' . $fromEmail . '" '.$mailStatus);
        $emailData = [];

        //If no emails then return empty array
        if (!$emailIds) {
            return $emailData;
        }

        //Get the data for all emails
        foreach ($emailIds as $index => $email) {
                
            $overview = imap_fetch_overview($this->conn, $email, 0);
            $emailData[$index]["msgno"] = $overview[0]->msgno;
            $emailData[$index]["message"] = quoted_printable_decode(imap_fetchbody($this->conn,$email, 1, FT_PEEK));
        }

        return $emailData;
    }

    /**
     * It will return the fomatted data required to show
     */
    public function getFormattedData(string $emailMessage)
    {
        $fieldNames = ["name", "email", "phone no", "address"];
        $finalData = [];

        //First get the fields array
        $fieldsArr = explode(PHP_EOL, $emailMessage);

        //Get only 4 fields so that it will not add other extra
        //signature text
        $fieldsArr = array_slice($fieldsArr, 0, 4);

        foreach($fieldsArr as $fieldData) {

            $arr = explode(':', $fieldData);
            $fieldName = strtolower($arr[0]);
            if (!in_array($fieldName, $fieldNames)) {
                continue;
            }
            
            $fieldValue = $arr[1];

            $finalData[$fieldName] = $fieldValue;
        }

        return $finalData;
    }

    /**
     * It will set the mails as read 
     */
    public function markAsRead(string $msgNumbers) {
        
        // Unset desired flag
        imap_setflag_full($this->conn, $msgNumbers, "\\Seen");
        
        // Confirm the deletion
        imap_expunge($this->conn);
        
    }

    /**
     * It will set mails as unread
     */
    public function markAsUnread($msgNumbers)
    {
        // Unset desired flag
        imap_clearflag_full($this->conn, $msgNumbers, "\\Seen");
        
        // Confirm the deletion
        imap_expunge($this->conn);

    }

    /**
     * It will move the mails to trash folder
     */
    public function deleteMails($msgNumbers)
    {
        imap_mail_move($this->conn, $msgNumbers, TRASH_FOLDER);

        // Confirm the deletion
        imap_expunge($this->conn);
    }
}
