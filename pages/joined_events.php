<?php
    $id=$_SESSION['user-id']

?>
<div class="applied">
                Applied Events
                <div class="underline-applied"></div>
            </div>
            <div class="applied-event">
                <div class="arrow" onclick="appliedleft()">
                    <img src="images/arrow-left.png" id="applied-prev">
                </div>
                <div class="applied-event-view-box">
                    <div class="applied-event-box">
                    </div>
                </div>
                <div class="arrow" onclick="appliedright()">
                    <img src="images/arrow-right.png" id="applied-next">
                </div>
            </div>