<!DOCTYPE html> 
<html> 

<head> 
	<link rel="stylesheet" href= 
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="style.css"> 

	
</head> 

<body> 
	<h2>List Emails from Gmail using PHP and IMAP</h2> 

	
	<br> 
	
	<div id="dataDivID" class="form-container" > 

<?php set_time_limit(4000);


// Connect to gmail
//$imapPath = '{imap.gmail.com:993/imap/ssl}INBOX';
$imapPath = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$username = 'angharingml@gmail.com';
$password = '81497layla';

// try to connect
$inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
   /* ALL - return all messages matching the rest of the criteria
    ANSWERED - match messages with the \\ANSWERED flag set
    BCC "string" - match messages with "string" in the Bcc: field
    BEFORE "date" - match messages with Date: before "date"
    BODY "string" - match messages with "string" in the body of the message
    CC "string" - match messages with "string" in the Cc: field
    DELETED - match deleted messages
    FLAGGED - match messages with the \\FLAGGED (sometimes referred to as Important or Urgent) flag set
    FROM "string" - match messages with "string" in the From: field
    KEYWORD "string" - match messages with "string" as a keyword
    NEW - match new messages
    OLD - match old messages
    ON "date" - match messages with Date: matching "date"
    RECENT - match messages with the \\RECENT flag set
    SEEN - match messages that have been read (the \\SEEN flag is set)
    SINCE "date" - match messages with Date: after "date"
    SUBJECT "string" - match messages with "string" in the Subject:
    TEXT "string" - match messages with text "string"
    TO "string" - match messages with "string" in the To:
    UNANSWERED - match messages that have not been answered
    UNDELETED - match messages that are not deleted
    UNFLAGGED - match messages that are not flagged
    UNKEYWORD "string" - match messages that do not have the keyword "string"
    UNSEEN - match messages which have not been read yet*/

// search and get unseen emails, function will return email ids
$emails = imap_search($inbox,'UNSEEN');

$output = '';

foreach($emails as $mail) {

    $headerInfo = imap_headerinfo($inbox,$mail);
	$structure = imap_fetchstructure($inbox, $mail);

    $output .= $headerInfo->subject.'<br/>';
	$output .= $headerInfo->toaddress.'<br/>';
    $output .= $headerInfo->date.'<br/>';
    $output .= $headerInfo->fromaddress.'<br/>';
    $output .= $headerInfo->reply_toaddress.'<br/>';
	echo '<hr/>';

    $emailStructure = imap_fetchstructure($inbox,$mail);
	$attachments = array();
    //var_dump($emailStructure->parts);
   /*  if(isset($emailStructure->parts)) {
        $output .= imap_body($inbox, $mail, FT_PEEK);
		
    } else {
        //    
    } */

   echo '<div>' .$output . '</div>';
   $output = '';
}

// colse the connection
imap_expunge($inbox);
imap_close($inbox);

?>
	</div> 
</body> 

</html>