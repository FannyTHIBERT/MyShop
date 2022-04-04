<?php

function manage_php_session(): bool
{

    if (!isset($_SESSION['id'])) {
        session_start();
        $heurelog = date('Y-m-d H:i:s');
        $_SESSION['id'] = session_id();
        $message = "new session id : ";
        file_put_contents(JOURNAL_LOG_FILE, "session id " . $message . " session id : " . $_SESSION['id'] . " session user-id: " . $_SESSION['user_id'] . $heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
        return true;
    } else {
        $heurelog = date('Y-m-d H:i:s');
        $message = "session id : ";
        file_put_contents(JOURNAL_LOG_FILE, "php_session id " . $message . " " . $_SESSION['id'] . " session user-id: " . $_SESSION['user_id'] . " " . $heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
        return false;
    }
}


function clean_php_session()
{
    session_unset();
    session_destroy();
}

function is_logged(): bool
{
    if ( ($_SESSION['is_logged'])==1 || !empty($_SESSION['username'])) {
        file_put_contents(JOURNAL_LOG_FILE, "is_logged : " . ($_SESSION['is_logged']) . PHP_EOL, FILE_APPEND | LOCK_EX);  
        return true;
    
    }
    file_put_contents(JOURNAL_LOG_FILE, "is_not_logged : " . ($_SESSION['is_logged']) . PHP_EOL, FILE_APPEND | LOCK_EX);
    return false;
}

function is_admin(): bool
{
    if (is_logged()){
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            file_put_contents(JOURNAL_LOG_FILE, "is_admin " . ($_SESSION['is_admin']) . PHP_EOL, FILE_APPEND | LOCK_EX);
            return true;
            }
           else {
            file_put_contents(JOURNAL_LOG_FILE, "is_not_admin " . ($_SESSION['is_admin']) . PHP_EOL, FILE_APPEND | LOCK_EX);
            return false;}
         }
    else{     
        file_put_contents(JOURNAL_LOG_FILE, "non_loggé, donc non admin" . ($_SESSION['is_admin']) . PHP_EOL, FILE_APPEND | LOCK_EX);
        return false;
    }

}