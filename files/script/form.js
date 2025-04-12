let eventName= document.getElementById('event_name');
let lastDate= document.getElementById('date_sub');
let submissionTime= document.getElementById('time_sub');
let state= document.getElementById('state');
let venue= document.getElementById('venue');
let totalRounds= document.getElementById('rounds');
let totalMembers= document.getElementById('max_members'); 
let prizePool= document.getElementById('price'); 
let termsConditions= document.getElementById('terms');
document.body.addEventListener('keydown',(event)=> {
    if(event.key === 'Enter') {
        
        stateCheck(state.value);
    }
});
totalRounds.addEventListener('change',()=> {
    numberOfRounds(totalRounds.value);
    console.log("DOne");
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
