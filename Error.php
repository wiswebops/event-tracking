<meta http-equiv="refresh" content="10;url=dashboard.php">

<p>Sorry we are unable to complete your request for the following reason:</p>
<p><b>
<?php



switch($_GET['error_code'])
{

 case 0:
    echo 'The conference you are trying to edit does not exist';
 break;
    
 case 1:
    echo 'SQL Error Occured while updating';
 break;
    
 case 2:
    echo 'This floor plan has already been used for this event group, please use a different image.';
 break;


}
?>
</b>
</p>
<p>You will be redirected in 10 seconds or click <a href="dashboard.php">here</a> to return to the dashboard page.</p>

