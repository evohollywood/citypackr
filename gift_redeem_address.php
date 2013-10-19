<?php

session_start();
require_once ('includes/mysql_connect.php');
include ('includes/functions.inc');

$page_title = 'CityPackr - The Best of Your City at Your Doorstep';

if (isset($_POST['code'])):

	if (check_gift_subscription($_POST['code'])):
	
		include ('includes/head_new.inc');
	
?>
<div class="container">
    <div id="box_login">
        <div class="container">
            <div class="span12 box_wrapper">
                <div class="span12 box">
                    <div>
                        <div class="head">
                            <h4>Enter Your Info</h4>
                        </div>
                        <div class="form">
                            <form method="post" action="gift_redeem_address.php">
                                <input type="text" name="name" id="inputName" placeholder="Name"/>
                                <input type="text" name="email" id="inputEmail" placeholder="E-mail Address"/>
                                <input type="text" name="address" id="inputAddress" placeholder="Delivery Address"/>
                                <input type="text" name="zip" id="inputZip" placeholder="Delivery Zip Code"/>
								<input type="hidden" name="submitted" value="TRUE" />
                                <input type="submit" class="btn" value="Finish"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

include ('includes/foot_new.inc');

	else:

		$url = 'redeem_gift.php?e=1';

		header("Location: $url");

		exit();	
	
	endif;

else:

	$url = 'redeem_gift.php';

	header("Location: $url");

	exit();

endif;

?>