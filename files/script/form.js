let eventName= document.getElementById('event_name');
let lastDate= document.getElementById('date_sub');
let submissionTime= document.getElementById('time_sub');
let state= document.getElementById('state');
let venue= document.getElementById('venue');
let totalRounds= document.getElementById('rounds');
let totalMembers= document.getElementById('max_members'); 
let prizePool= document.getElementById('price'); 
let termsConditions= document.getElementById('terms');
/*document.body.addEventListener('keydown',(event)=> {
    if(event.key === 'Enter') {
        //timeCheck(submissionTime.value);
        //dateCheck(lastDate.value);
        //eventNameCheck(eventName.value);
        //checkBox(termsConditions);
        //stateCheck(state.value);
        //venueCheck(venue.value);
        //priceCheck(prizePool.value);
        //membersCheck(totalMembers.value);
    }
});*/
totalRounds.addEventListener('change',()=> {
    numberOfRounds(totalRounds.value);
})
function numberOfRounds(rounds) {
    let roundsDisplay='';
    for(let i=0;i<rounds;i++) {
        roundsDisplay+=
        `
            <div class="body_right_details">
                            <p>Round ${i+1}:</p>
                            <div class="username">
                                <label for="name">Name:</label><br>
                                <input type="text" name="name" id="name" class="name${i+1}">
                            </div>
                            <div class="dt">
                                <label for="date">Date:</label><br>
                                <input type="date" name="date" id="date" class="date${i+1}">
                            </div>
                            <div class="tm">
                                <label for="time">Time:</label><br>
                                <input type="time" name="time" id="time" class="time${i+1}">
                            </div>
                            <div class="dur">
                                <label for="duration">Duration:in hrs</label><br>
                                <input type="text" name="duration" id="duration" class="duration${i+1}">
                            </div>
                            <div class="details_rnds">
                                <label for="deatails_of_round">Details of Round ${i+1}:</label><br>
                                <textarea name="deatails_of_round" id="deatails_of_round" class="deatails_of_rounds${i+1}"></textarea>
                            </div>
                            <div class="modes">
                                <input type="radio" name="mode" id="online" class="online${i+1}">
                                <label for="online">Online:</label>
                                <input type="radio" name="mode" id="offline" class="offline${i+1}">
                                <label for="offline">Offline:</label>
                            </div>
                        </div>
                        <hr>
        `;
    }
    document.getElementById('display-rounds').innerHTML=roundsDisplay;
}
function stateCheck(state) {
    const indiaState = ["andhra pradesh","arunachal pradesh","assam","bihar","chhattisgarh","goa","gujarat","haryana","himachal pradesh","jharkhand","karnataka","kerala","madhya pradesh","maharashtra","manipur","meghalaya","mizoram","nagaland","odisha","punjab","rajasthan","sikkim","tamil nadu","telangana","tripura","uttar pradesh","uttarakhand","west bengal"];
    if(!indiaState.includes(!state.toLowerCase())) {
        document.querySelector('.incorrect-state').innerHTML = '*Please enter a correct state name';
    }
}
function checkBox(value) {
    if(!value.checked) {
        alert("Please agree terms & conditions");
    }
}
function eventNameCheck(value) {
    if(value === '') {
        document.querySelector('.incorrect-name').innerHTML = '*Please enter valid Event name';
    }
}
function dateCheck(value) {
    if(value === '') {
        document.querySelector('.incorrect-date').innerHTML = '*Please select last date for event';
    }
}
function timeCheck(value) {
    if(value === '') {
        document.querySelector('.incorrect-time').innerHTML = '*Please enter valid Time';
    }
}
function venueCheck(value) {
    if(value === '') {
        document.querySelector('.incorrect-venue').innerHTML = '*Please fill venue';
    }
}
function priceCheck(value) {
    if (/[^0-9]/.test(value)) {
        document.querySelector('.incorrect-price').innerHTML = '*Please enter a valid price (numbers only)';
    }
    else if(value==='') {
        document.querySelector('.incorrect-price').innerHTML = '*Please enter a valid price (numbers only)';
    }
}
function membersCheck(value) {
    if(value === 0) {
        document.querySelector('.incorrect-members').innerHTML = '*Please enter no. of members';
        
    }
}
