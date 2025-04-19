let teamName= document.getElementById('team-name');
let leadName= document.getElementById('lead-name');
let leadCollege= document.getElementById('lead-college');
let leadEmail= document.getElementById('lead-email');
let leadNumber= document.getElementById('lead-number');
let addMembers= document.getElementById('add-member');
let memberBox= document.querySelector('.team-members-box');
let i=0;
let totalMembers=4;
let members=[];
/*function addMember() {
    if(i<totalMembers) {
        let html=`
            <div class="team-member-box team-member-${i+1}-box">
                <label for="member-${i+1}-name" class="member-name member-${i+1}-name">Member ${i+1}: </label>
                <div class="member-details member-${i+1}-details">
                    <div class="name-college-gender">
                        <input type="text" name="member-${i+1}-name" id="member-${i+1}-name" class="member-${i+1}-name-input member-name-input" placeholder="Name" size="30"><br>
                        <input type="text" name="member-${i+1}-college" id="member-${i+1}-college" class="member-${i+1}-college member-college" placeholder="College" size="30"><br>
                        <div class="member-gender member-${i+1}-gender">
                            <div class="sex">Gender:</div>
                            <div class="male">
                                <input type="radio" name="member-${i+1}-gender" id="member-${i+1}-male" class="input-male" value="male">
                                <label for="male" class="member-${i+1}-male member-male">Male</label>
                            </div>
                            <div class="female"> 
                                <input type="radio" name="member-${i+1}-gender" id="member-${i+1}-female" class="input-female" value="female">
                                <label for="female" class="member-${i+1}-female member-female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="member-email-number-button">        
                        <input type="email" name="member-${i+1}-email" id="member-${i+1}-email" class="member-${i+1}-email member-email" placeholder="Email" size="30"><br>
                        <input type="tel" name="member-${i+1}-number" id="member-${i+1}-number" class="member-${i+1}-number member-number" placeholder="Phone Number" size="30"><br>
                    </div>
                </div>
            </div>
        `;
        members.push(html);
        memberBox.innerHTML=members;
        i++;
    }
    else {
        alert("Maximum team members reached!");
    }
}*/
document.getElementById('add-member').addEventListener('click',()=> {
    if(i<totalMembers) {
        let html=`
            <div class="team-member-box team-member-${i+1}-box">
                <label for="member-${i+1}-name" class="member-name member-${i+1}-name">Member ${i+1}: </label>
                <div class="member-details member-${i+1}-details">
                    <div class="name-college-gender">
                        <input type="text" name="member-${i+1}-name" id="member-${i+1}-name" class="member-${i+1}-name-input member-name-input" placeholder="Name" size="30"><br>
                        <input type="text" name="member-${i+1}-college" id="member-${i+1}-college" class="member-${i+1}-college member-college" placeholder="College" size="30"><br>
                        <div class="member-gender member-${i+1}-gender">
                            <div class="sex">Gender:</div>
                            <div class="male">
                                <input type="radio" name="member-${i+1}-gender" id="member-${i+1}-male" class="input-male" value="male">
                                <label for="male" class="member-${i+1}-male member-male">Male</label>
                            </div>
                            <div class="female"> 
                                <input type="radio" name="member-${i+1}-gender" id="member-${i+1}-female" class="input-female" value="female">
                                <label for="female" class="member-${i+1}-female member-female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="member-email-number-button">        
                        <input type="email" name="member-${i+1}-email" id="member-${i+1}-email" class="member-${i+1}-email member-email" placeholder="Email" size="30"><br>
                        <input type="tel" name="member-${i+1}-number" id="member-${i+1}-number" class="member-${i+1}-number member-number" placeholder="Phone Number" size="30"><br>
                    </div>
                </div>
            </div>
        `;
        members.push(html);
        memberBox.innerHTML=members;
        i++;
    }
    else {
        alert("Maximum team members reached!");
    }
});
document.getElementById('remove').addEventListener('click',()=> {
    if(i>0) {
        members.pop();
        memberBox.innerHTML=members;
        i--;
    }
    else {
        alert("Members list is empty");
    }
   console.log("hello");
});