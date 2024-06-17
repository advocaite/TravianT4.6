<?php
    use Core\Database\DB;
    $db = DB::getInstance();
    $queryVariable = $vars['hero']['uid'];
    $beard = $_POST['beard'];
    $headProfile = $_POST['headProfile'];
    $hairColor=$_POST['hairColor'];
    $hairStyle=$_POST['hairStyle'];
    $ears=$_POST['ears'];
    $eyebrow=$_POST['eyebrow'];
    $eyes=$_POST['eyes'];
    $nose=$_POST['nose'];
    $mouth=$_POST['mouth'];
    $gender=$_POST['gender'];

    $TempArray = $db->query("UPDATE face SET beard=$beard, headProfile=$headProfile, hairColor=$hairColor, hairStyle=$hairStyle, ears=$ears, eyebrow=$eyebrow, eyes=$eyes, nose=$nose, mouth=$mouth, gender=$gender WHERE uid=$queryVariable");

?>