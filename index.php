<!-- hayde heye l Home Page -->
<?php
// lama n3mel login byfta7le session bayne w byn l server w bikun 3enda session id
// 3adatan l session id bytghayar fa bikun mesh secure. nhna bdna na3mlo secure 3n tari2 eno ykun l id sebet ma ytghayar

session_start();
// hayde y3ne ykamel l session li fata7a b saf7et l login

print_r($_SESSION);

// la7ad hon btkun b3da l session fadye. bt3tine ARRAY() l2n b3dna ma 3melna login
//  hl2 eza 3melna login mazbut by3tine 3l sheshe Array ([user_id] ==> ra2m) l ra2m howe l id li bl data base l tebe3 la hayda l email 
// ex : email: rayan@hotmail.com
    //  pass: Rayan@123

    // result: Array([user_id] ==> 4)

?>