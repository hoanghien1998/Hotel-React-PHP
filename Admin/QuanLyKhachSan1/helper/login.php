<?php

//kiểm tra login chưa
function is_login() {
    if (isset($_SESSION['is_login']) && isset($_SESSION['time_login'])) {
        if (time() - $_SESSION['time_login'] < 3600)
            return TRUE;
    }
    return FALSE;
}

