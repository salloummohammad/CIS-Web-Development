<?php
 $valid = true;
//  $usercheck = false;
// hyde eza bdna n3ml check 3l email la7al wel pass la7al

//  hayde 3arafneha krmel b3den n3mel test 3l validation 
// y3ne mn3mel test eza saret false bikun bdna n3mel shi m3ayan (masalan n3te die msg...)

if($_SERVER["REQUEST_METHOD"]=="POST"){
    // hayde y3ne eza lama nekbo 3a kabset l log in a5adna method post shu r7 ysir:
    // lezem nfta7 connection
    $mysqli = require __DIR__ ."/database.php";
    // 5ala2na variable esma mysqli (fina nsamiha ghyr esem)

    $sql = sprintf("SELECT * FROM users WHERE email = '%s'" , $_POST["email"]);
    // l email howe string 
    // bdna njib l ma3lumet 7asab l email li da5alneh nhna bl form lama 3melna login w n3mel sprintf (y3ne printf lal string)

    $result = $mysqli->query($sql);
    // hyk nafazna l query

    $user = $result->fetch_assoc();

    // assoc y3ne association
    // hayde btraje3le l result 3a shakel record (array) b albo fi kl l ma3lumet 3n hayda l user
    // 3melna fetch_assoc l2n 3ena kaza ma3lume
    // ejbare lama a3ml query "select" a3ml mn ba3da fetch_assoc

    // var_dump($user);

    // hyk bs nekbos 3l log in bytba3lna kl l ma3lumet 3l sheshe 3ena (3a nafs l saf7a mn fo2) 3a shakel array (name, email, password_hash)
    // l var_dump hon mesh matloub ntale3a lal user, bs 3m net3alam kif mnef7as eza she8lna sah (rje3na 3melneha comment)

    // ------------------------tetsting email: eza el email li da5alneh mawjud bl data base (eza l $user a3tetne natije :ya3ne eza l $user li fo2 b albo ma3lumet mn domna l email bikun l email li da5alneh mawjud bl db):

    // $usercheck=false;
    if($user){
        // $usercheck = true;
        
        // y3ne l query select li 7atayneha bl $user a3tet natije w ma3lumet mn domna el email ya3ne bikun l email li da5alneh bl form mawjud bl db

        // ------------------tetsing password (eza l email metwefe2 m3 l pass lid a5alneh)
        // hon bdna nfek l hash 3an l pass w nkarnoh bl pass l mawjud bl db la hayda l email
        if(password_verify($_POST["password"],$user["password_hash"])){
            // die("Login Seccessful!");

            // el function "password_verify" heye betfek l hash 3n l password w betkaren eza l pass li da5alo l user howe zeto l pass l mawjud bl db la hayda l email
            // rje3na 3melna l die msg. ana bade bs yenja7 l login : yefta7le session w yfawetne 3l home page (li heye index.php) 

            session_start();

            // hl2 sar 3ena session id mn l php. bs 7ata nsir secure aktar ana bade ana 7aded l session id w 5alih ykun sebet ma ytghayar --> ra7 a3tih session id ykun howe zeto l id li bl data base (li howe l primary key w auto increment)
        //    hon 3melna session start fata7na session b saf7et l login w bdna hl session tkammel b saf7et l index(home page) lahyk kamen 7atayna session start bl index.php
           
            $_SESSION["user_id"] = $user["id"];
          // session id        = l id li mn l data base (jebneha mn l variable user li fiha query select)

          // bade rou7 3l home page w edhar mn saf7et l log in:
          header("Location: index.php");
          exit;

        }
    }

    $valid = false;
    // hayde metl l else bs mo5tasara aktar l2n eza ma meshe 7al l login ma bade yeh y3tine die msg (l2n bhl 7ale ma bi3ud fini a3ml mo7awale tenye l2n bytl3 mn l script) lahyk sta3malna $valid = false mesh else
    // hayde y3ne ata3 mn awal if w nezel la ta7t (la hon) y3ne l login mesh successful (ma la2a l email bl db aw l pass mesh metwefe2 m3 l email li da5alneh):

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>
<body>
    <h1>Log in</h1> 

<!-- l line 64 hon katabneh mn b3d ma khalasna php fo2 (line 44 ($valid = false;)) -->
 <!-- hon bdna no5lot php m3 html lahyk mn7ot ":" b3d l if y3ne l if bl php b3na maftou7a w bdna ntabe3la code html ("P") -->

    <?php if(!$valid): ?>
         <em>Invalid Login </em>
    <?php endif; ?>
    <!-- hon kamen sakarna bi php (l2n 3m no5lot php m3 html) w 3melna endif la nsakker l sharet -->
     <!-- if(!$valid) : hayde y3ne eza fi error bl login ($valid = false) by3tina msg mn 5ilel em (error msg) : invalid login -->

     <!-- eza bdna n3mel check lal email la7alo:
       -->
     <!-- <php if(!$valid): ?>
         <em>Invalid Login </em>
    <php endif; ?> -->
        <!-- w b3te <em> Email doesn't exist -->

    <form action="" method="post">
        <!-- hon mesh bi7aje lal action l2n ma bade efta7 saf7a jdide bs bi7aje lal method -->
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $_POST["email"] ??"" ?>">
            <!-- el id bl input lezem tkun heye zeta l for li bl label -->
             <!-- 7atayna value lal email betsewe l email li da5alneh w 7atayneha b tari2et php bs badal kelmet php 7atayna = -->
              <!-- 7atayna value kermel eza l pass ghalat yem7e bas l pass bs y5ale l email ma yem7ih 7ata ma ettar erj3 ektbo mn jdid -->
               <!-- e5er shi 7atayna ??"" y3ne awal ma yenzal l form ykun l email fade -->
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="password" name="password" id="pass">
        </div>
              <input type="submit" name="submit" value="Log in">
    </form>
    <!-- 3melna l form hl2 bdna nektob code php mn fo2 abl l html (abl DOCTYPE) -->
     <!-- b3d ma nekbos 3a kabset l Log In bado yfout 3l database: 1- ykaren eza l password mazbout w eza l eamil metwefe2 ma3 l password
      hl2 bdna ne5od mn l database 7ata nkaren mn 5ilel code katabneh fo2 b osm l php 
      
     hl2 la7ata nefham re7na 3a alb l databse (satabase w mnkbos 3l sql w mnektob l query) w 3melna query select --> 
      <!-- r7 nektob hayda l code fo2 bl php  -->


</body>
</html>