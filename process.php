<?php

if(empty($_POST["name"])){
     die("Name is required!");
// die msg bttba3 msg 3l sheshe w kamen zyede btwa2ef kl l code li ba3da w ma bt3mel submit lal form 
    
}


// validating Email
if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("valid Email is required!");
    // l filter_var bt3mel filter la email w btshuf eza valid
}

// validating password
// password must be at least 8 caracters
if(strlen($_POST["password"])<8){
die("password must be at least 8 caracters");
}

// password must at least contain 1 uppercase character
if(!preg_match("@[A-Z]@", $_POST["password"])){
    die("password must at least contain 1 uppercase character");
}

//password must at least contain 1 number
if(!preg_match("@[0-9]@", $_POST["password"])){
    die("password must at least contain 1 number");
}

// password must at least contain a special character
if(!preg_match("@[^\w]@", $_POST["password"])){
    die("password must at least contain a special character");
}

//validating password confirmation = password
if($_POST["password"]!=$_POST["password_confirmation"]){
    die("password must match");
}

// Hashing the password (encryption)
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
// el PASSWORD_DEFAULT heye a2wa wehde fihon bt3mel security aktar shi

// hl2 bdna netba3 kl shi 3l sheshe jeye mn l form including l password hash
// hl shi ma mn3mlo bl 3ade l2n ma bdna ybayen 3l sheshe l pass bs hl2 3m njareb la nshuf shu r7 ytba3

// -----------------------------------------Print

// print_r($_POST);

// bttba3 kl shi jeye mn l form
// rje3na 3melneha commentl2n ma bdna yeha tezhar (bs ken bdna nt3alam kif netba3)

// ---------------------------------print sturcture of password

// var_dump(($password_hash));

// el var_dump bt3tina tafasil 3n l password_hush kif howe w shu l structure la elo(lenght...)
// rje3na 3melneha comment l2n ma bdna yeha hl2 (bs ken bdna nt3alam kif mn3mela)


// nhna bdna n3mel connection 3l data base kaza marra (sign up , login (7ata nkaren eza l email m3 l pass mawjudin b account bl data base) , logout, lama bdna nrou7 3l home page bs nfout 3l website)
// mesh kl marra bdna nektob l code li by3ml connection 3l databse lahyk mn3mel saf7a jdide esma database.php bisir kl ma bade a3ml connection mn3mel appel la hayde l saf7a

$mysqli = require __DIR__ . "/database.php";
// $mysqli heye variable nhna hl2 5ala2neha la n3mel fiha connection 3l databse
// DIR heye l directory 7ata ndalih mn wen bdna njib l saf7a li bdna n3mel connection mn 5ilela
// hyk mnkun 3melna connection 3l databade
// hl2 bdna n3abe b alb l table:

$sql = "INSERT INTO users(name, email, password_hash) VALUES(?, ?, ?)";
// 7atayna ? b alb l values l2n lezem n3mel to7dir lal query abl ma nda5el values 7ata ykun fih aktar efficiency bted5il l ma3lumet w ykun she8l sahl w mratab
// l2n eza l website 3ley ktir clients(mtl facebook) w l query 3m tetnafaz b 3adad ktir kbir b nafs l w2t(fi ktiiiir clients 3m y3mlo ligin masalan b nafs l w2t) bvisir fi  احتقان lahyk lezem n7ader l query (prep) 

$stmt = $mysqli->prepare($sql);
//3melna prepare lal query mn 5ilel variable jdide stmt (statemenet)
//  el function "prepare" btraje3le false eza ma fih error w btraje3le true eza fih error

if(!$stmt){
     die($mysqli->error);
    //  masalan eza 7atayna esem l table "user" badal users (line73) by3tina error eno table "user" not excist l2n esem l table ghalat
}

// hl2 bdna n3mel binding lal stmt y3ne bdna nousel l parametres "?" li 7ataynehon bl values lal $sql (line 73) bl valus li jayin mn l form (y3ne badna n7ot imet kl ? mn l values lal form (name,email,password_hash)):

    $stmt->bind_param("sss" ,$_POST["name"] ,$_POST["email"] ,$password_hash);
    // awal value 7atayneha "sss" l2n el 3 "?" hene string 
    // y3ne 3m borbot kl ? bl value taba3a li jeye mn l form lama da5alna l ma3lumet
    // e5er value mn7ota password_hash mesh l password kermel el security

    // 3melna bindding byeb2a bdna nnafez l query:
    if($stmt->execute()){
        // echo ("Signup Successfull!");
        header("Location: signup-success.html");
        // bye5edne 3a saf7a jdide li heye signup-success.html w bisaker saf7et l signup (li heye process.php) l2n ma ba2a bade yeha
        exit;
    }
    else{
        die($mysqli->error);
    }

    // hl2 mn b3d ma tele3 l signup successfull lezem yefta7lna saf7a jdide la n3mel menna login: 3melna saf7a jdide signup-sucess.html: lahyk rje3na 3melna line 95 comment (echo("Signup Successfull!");)) l2n ana ma bade y3tine msg 3l sheshe (bs kena 3m nt3alam)
    // ana bade lama ykun l signup seccessfull ye5edne 3a saf7a jdide li heye login

?>