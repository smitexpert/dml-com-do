<?php 

require __DIR__."/classes/Corporateclients.php";
require __DIR__."/classes/Accounts.php";
$Corpoclients = new Corporateclients();
$Accounts = new Accounts();



// TARGET INSERT CODE

if ($_REQUEST['action'] == 'stufftargetinsert') {
 $stuffID = $_REQUEST['stuffID'];
 $targetamount = $_REQUEST['targetamount'];
 $dateFrom = $_REQUEST['dateFrom'];
 $dateTo = $_REQUEST['dateTo'];

 $Corpoclients->insertStuffTarget($stuffID,$targetamount,$dateFrom,$dateTo);

// if ($Corpoclients) {
//         echo $Corpoclients;
//     }


}else{

}
