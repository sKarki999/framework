<?php

class Redirect {

    // method to redirect request
    // takes path as a parameter and redirects to that path
    public static function goTo($path) {

        header("location:" . baseUrl . '/'. $path);

    }
}
?>