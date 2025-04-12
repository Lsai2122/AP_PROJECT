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
        console.log("WORKING");
        numberOfRounds(totalRounds.value);
    }
});
function numberOfRounds(rounds) {
    let roundsDisplay='';
    for(let i=0;i<rounds;i++) {
        roundsDisplay+=
        `
            <div class="body_right_details">
                            <p>Round ${i+1}:</p>
                            <div class="username">
                                <label for="name">Name:</label><br>
                                <input type="text" name="name" id="name">
                            </div>
                            <div class="dt">
                                <label for="date">Date:</label><br>
                                <input type="date" name="date" id="date">
                            </div>
                            <div class="tm">
                                <label for="time">Time:</label><br>
                                <input type="time" name="time" id="time">
                            </div>
                            <div class="dur">
                                <label for="duration">Duration:in hrs</label><br>
                                <input type="text" name="duration" id="duration">
                            </div>
                            <div class="details_rnds">
                                <label for="deatails_of_round">Details of Round 1:</label><br>
                                <textarea name="deatails_of_round" id="deatails_of_round"></textarea>
                            </div>
                            <div class="modes">
                                <input type="radio" name="mode" id="online">
                                <label for="online">Online:</label>
                                <input type="radio" name="mode" id="offline">
                                <label for="offline">Offline:</label>
                            </div>
                        </div>
                        <div class="body_right_horizontal"></div>
        `;
    }
    document.getElementById('display-rounds').innerHTML=roundsDisplay;
}