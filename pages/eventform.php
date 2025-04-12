<form class="eventhoster">
    <div class="form_body_left">
        <div class="eve_nam">
            <label for="event_name">Event Name:</label><br>
            <input type="text" name="event_name" id="event_name">
        </div>
        <div class="d_sub">
            <label for="date_sub">Last Date for Submission:</label><br>
            <input type="date" name="date_sub" id="date_sub">
        </div>
        <div class="t_sub">
            <label for="time_sub">Time for Submission:</label><br>
            <input type="time" name="time_sub" id="time_sub">
        </div>
        <div class="st">
            <label for="state">State:</label><br>
            <input type="text" name="state" id="state">
        </div>
        <div class="ven">
            <label for="venue">Venue:</label> <br>
            <textarea name="venue" id="venue"></textarea>
        </div>
        <div class="no_rnds">
            <label for="rounds">Number of Rounds:</label><br>
            <select name="rounds" id="rounds">
                <option value=0></option>
                <option value=1>Round 1</option>
                <option value=2>Round 2</option>
                <option value=3>Round 3</option>
                <option value=4>Round 4</option>
                <option value=5>Round 5</option>
            </select>
        </div>
        <div class="no_mems">
            <label for="max_members">Max Number of Members:</label><br>
            <select name="max_members" id="max_members">
                <option value="0"></option>
                <option value="1">1 Member</option>
                <option value="2">2 Members</option>
                <option value="3">3 Members</option>
                <option value="4">3 Members</option>
                <option value="5">4 Members</option>
                <option value="6">5 Members</option>
            </select>
        </div>
        <div class="pp">
            <label for="price">Price Pool:</label><br>
            <input type="text" name="price" id="price">
        </div>
        <div class="conds">
            <input type="checkbox" name="terms" id="terms">
            <label for="terms">Terms and Conditions</label>
        </div>

    </div>
    <div class="form_vertical_line"></div>
    <div class="form_body_right">
        <div class="body_right_details">
            <p>Round 1:</p>
            <div class="username">
                <label for="name">Name:</label><br>
                <input type="text" name="name1" id="name1">
            </div>
            <div class="dt">
                <label for="date">Date:</label><br>
                <input type="date" name="date1" id="date1">
            </div>
            <div class="tm">
                <label for="time">Time:</label><br>
                <input type="time" name="time1" id="time1">
            </div>
            <div class="dur">
                <label for="duration">Duration:in hrs</label><br>
                <input type="text" name="duration1" id="duration">
            </div>
            <div class="details_rnds">
                <label for="details_of_round">Details of Round 1:</label><br>
                <textarea name="details_of_round1" id="deatails_of_round"></textarea>
            </div>
            <div class="modes">
                <input type="radio" name="mode1" id="online">
                <label for="online">Online:</label>
                <input type="radio" name="mode1" id="offline">
                <label for="offline">Offline:</label>
            </div>
        </div>
        <div class="body_right_horizontal"></div>
        <div class="body_right_details">
            <p>Round 1:</p>
            <div class="username">
                <label for="name">Name:</label><br>
                <input type="text" name="name2" id="name">
            </div>
            <div class="dt">
                <label for="date">Date:</label><br>
                <input type="date" name="date2" id="date">
            </div>
            <div class="tm">
                <label for="time">Time:</label><br>
                <input type="time" name="time2" id="time">
            </div>
            <div class="dur">
                <label for="duration">Duration:in hrs</label><br>
                <input type="text" name="duration2" id="duration">
            </div>
            <div class="details_rnds">
                <label for="deatails_of_round2">Details of Round 1:</label><br>
                <textarea name="deatails_of_round" id="deatails_of_round"></textarea>
            </div>
            <div class="modes">
                <input type="radio" name="mode2" id="online" value="online">
                <label for="online">Online:</label>
                <input type="radio" name="mode2" id="offline" value="offline">
                <label for="offline">Offline:</label>
            </div>
        </div>
    </div>
    <button class="submit">reg</button>
</form>
