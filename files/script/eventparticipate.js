let teamName = document.getElementById('team-name');
let leadName= document.getElementById('lead-name');
let leadCollege= document.getElementById('lead-college');
let leadEmail= document.getElementById('lead-email');
let leadNumber= document.getElementById('lead-number');
let teamMembers=[];
function addMember() {
    let html=`
        <div class="team-member-box team-member-1-box">
            <label for="member-1-name" class="member-name member-1-name">Member 1: </label>
            <div class="member-details member-1-details">
                <div class="name-college-gender">
                    <input type="text" name="member-1-name" id="member-1-name" class="member-1-name-input member-name-input" placeholder="Name" size="30"><br>
                    <input type="text" name="member-1-college" id="member-1-college" class="member-1-college member-college" placeholder="College" size="30"><br>
                    <div class="member-gender member-1-gender">
                        <div class="sex">Gender:</div>
                        <div class="male">
                            <input type="radio" name="member-1-gender" id="member-1-male" class="input-male" value="male">
                            <label for="male" class="member-1-male member-male">Male</label>
                        </div>
                        <div class="female"> 
                            <input type="radio" name="member-1-gender" id="member-1-female" class="input-female" value="female">
                            <label for="female" class="member-1-female member-female">Female</label>
                        </div>
                    </div>
                </div>
                <div class="line"></div>
                <div class="member-email-number-button">        
                    <input type="email" name="member-1-email" id="member-1-email" class="member-1-email member-email" placeholder="Email" size="30"><br>
                    <input type="tel" name="member-1-number" id="member-1-number" class="member-1-number member-number" placeholder="Phone Number" size="30"><br>
                    <div class="button">
                        <input type="button" name="add-member" id="add-member" class="add-member" value="Add a Member" onclick="addMember();">
                        <input type="reset" name="remove" id="remove" class="remove" value="Remove">
                    </div>
                </div>
            </div>
        </div>
    `;
    let teamMember=document.querySelector('.team-members-box').innerHTML=html;
    teamMembers.push(teamMember);
}