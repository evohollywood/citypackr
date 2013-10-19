<?php

session_start();

$page_title = 'CityPackr - The Best of Your City at Your Doorstep';

include ('includes/head_new.inc');

?>
<div class="container">
    <div id="box_login">
        <div class="container">
            <div class="span12 box_wrapper">
                <div class="span12 box">
                    <div>
                        <div class="head">
                            <h4>Redeem Your Gift Code</h4>
                        </div>
                        <div class="form">
                            <form method="post" action="gift_redeem_address.php">
                                <input type="text" name="code" <?php if (isset($_GET['code'])) { echo 'value="' . $_GET['code'] . '"'; } ?> id="inputCode" placeholder="Gift Code"/>
								<input type="hidden" name="submitted" value="TRUE" />
                                <input type="submit" class="btn" value="Redeem"/>
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

?>