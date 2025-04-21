<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form class="eventhoster">
    <div style="display: flex; flex-direction: column;">
        <div class="normal">
        <div class="form_body_left">
            <div class="eve_nam">
                <label for="event_name">Event Name:</label><br>
                <input type="text" name="event_name" id="event_name" required>
            </div>
            <div class="d_sub">
                <label for="date_sub">Last Date for Submission:</label><br>
                <input type="date" name="date_sub" id="date_sub" required>
            </div>
            <div class="t_sub">
                <label for="time_sub">Time for Submission:</label><br>
                <input type="time" name="time_sub" id="time_sub" required>
            </div>
            <div class="st">
                <label for="state">State:</label><br>
                <input type="text" name="state" id="state" required>
                <br>
                <div class="incorrect-state"></div>
            </div>
            <div class="ven">
                <label for="venue">Venue:</label> <br>
                <textarea name="venue" id="venue" required></textarea>
            </div>
            <div class="no_rnds">
                <label for="rounds">Number of Rounds:</label><br>
                <select name="rounds" id="rounds" onchange="roundsDisplay()" required>
                    <option value="0"></option>
                    <option value="1">Round 1</option>
                    <option value="2">Round 2</option>
                    <option value="3">Round 3</option>
                    <option value="4">Round 4</option>
                    <option value="5">Round 5</option>
                </select>
            </div>
            <div class="no_mems">
                <label for="max_members">Max Number of Members:</label><br>
                <select name="max_members" id="max_members" required>
                    <option value="0"></option>
                    <option value="1">Member 1</option>
                    <option value="2">Member 2</option>
                    <option value="3">Member 3</option>
                    <option value="4">Member 4</option>
                    <option value="5">Member 5</option>
                    <option value="6">Member 6</option>
                </select>
            </div>
            <div class="pp">
                <label for="price">Price Pool:</label><br>
                <input type="text" name="price" id="price" required>
            </div>
            <div class="conds">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">Terms and Conditions</label>
            </div>
        </div>
        <div>
            <div class="form_vertical_line"></div>
            <div class="form_body_right" id="display-rounds"></div>
        </div>
        </div>
        <button class="submit">reg</button>
    </div>
    <div class="login-info-container">
        
    </div>
</form>

</body>
</html>