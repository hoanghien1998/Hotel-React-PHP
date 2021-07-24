<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

function echo_alert($data) {
    echo "<script language='javascript'>";
    echo "alert({$data})";  //not showing an alert box.
    echo "</script>";
}
