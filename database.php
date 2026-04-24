<?php
$mysqli= new mysqli("localhost", "root", "", "signup");
// 1-server name :nhna mawjudin 3l localhost
// 2- l username lal database howe "root"
// 3- ma 3ena pass (fade)
// 4- esem l databse : signup(mnjiba mn l databse (localhost/myadmin))

// -----------------------------------test eza sar fih connection aw la2 
if($mysqli ->connect_errno){
    // -> y3ne eza 3emlet connection w shu btraje3lna
    // errn0 heye error number : return 0 eza ma fi error y3ne sar fih connection
    //                           return 1 eza fi error bl connection 3l database
    // eza toli3 fi error lezem etba3 die msg w etba3 shu howe naw3 l error

    die($mysqli->connect_error);
    // l function"connect_error btraje3le string li heye naw3 l error
}

return $mysqli;
    // hyk bisir lama n3ayet la saf7et l databse bt3mel connection 3l databse 
    // bidun el return $mysqli ma bt3mel connection (ma btraje3le connection)
?>