<?php



$allSessions = [];
$sessionNames = scandir(session_save_path());
$ctr = 0;
foreach($sessionNames as $sessionName) {
    $sessionName = str_replace("sess_","",$sessionName);
    if(strpos($sessionName,".") === false) { //This skips temp files that aren't sessions
        session_id($sessionName);
		 session_start();
        $allSessions[$sessionName] = $_SESSION;
        session_abort();
		
		$ctr++;
    }
}

//echo json_encode($allSessions);
print_r ($allSessions);

?>
