<?php

session_start();

$page_title = 'CityPackr - The Best of Your City at Your Doorstep';


include ('includes/head_new2.inc');

?>
    <div id="contact" class="contact_page">
        <div class="container">
            <!-- header -->
            <h2 class="section_header">
                <hr class="left visible-desktop">
                <span>Contact Us</span>
                <hr class="right visible-desktop">
            </h2>

            <div class="row map">
                <div class="span12">
                    <div class="gmaps">
						<iframe style="width: 100%; height: 100%; border: none;" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=7086+Hollywood+Boulevard,+Los+Angeles,+CA&amp;aq=0&amp;oq=7086+Holl&amp;sll=37.269174,-119.306607&amp;sspn=14.129865,19.753418&amp;ie=UTF8&amp;hq=&amp;hnear=7086+Hollywood+Blvd,+Los+Angeles,+California+90028&amp;t=m&amp;z=14&amp;ll=34.101532,-118.344615&amp;output=embed"></iframe>
					</div>
					<h3>
                        CityPackr keeps offices at the io.la shared workspace on the corner of Hollywood and La Brea, right on the Hollywood walk of fame.
                    </h3>
                </div>
            </div>

        </div>
    </div>
<?

include ('includes/foot_new.inc');

?>