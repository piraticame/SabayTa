<?php
include 'ascon.php';


?>
<form action="" method="post">
    <input type="text" name="name">
    <input type="submit" value="submit">

</form>

<?php
if(isset($_POST['name'])){
    $name = $_POST['name'];
   $name1 = Ascon::encryptToHex( $secretKey, $name , "additionalData", "Ascon-128");
    echo $name1;
    echo "<br>";
    
    echo "space";
    
    echo "<br>";
    
    $name2 = Ascon::decryptFromHex($secretKey, $name, "additionalData", "Ascon-128");
    echo $name2;
}
?>