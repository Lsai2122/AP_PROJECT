
//header animation
const header = document.querySelector(".head-header")
const host = document.querySelector(".head-host-button")
host.classList.add("head-host-button-top")
header.classList.add("head-header-top");

window.addEventListener("scroll",()=>{
    const scrolly = window.scrollY || window.pageYOffset;
    const triggerPoint = window.innerHeight;
    if(scrollY >= triggerPoint){
        header.classList.remove("head-header-top");
        host.classList.remove("head-host-button-top")
    }
    else{
        host.classList.add("head-host-button-top")
        header.classList.add("head-header-top");
    }
})


//scroll animations
let scrollContainer=document.querySelector('.event-view-box');
let normalNext=document.getElementById('normal-next');
let normalPrev=document.getElementById('normal-prev');
let bestNext=document.getElementById('best-next');
let bestPrev=document.getElementById('best-prev');
let bestScrollContainer=document.querySelector('.best-event-view-box');
let appliedScrollContainer=document.querySelector('.applied-event-view-box');
let appliedNext=document.getElementById('applied-next');
let appliedPrev=document.getElementById('applied-prev');

normalNext.addEventListener('click',()=> {
    scrollContainer.scrollLeft+= 420;
    scrollContainer.style.scrollBehavior='smooth';
});
normalPrev.addEventListener('click',()=> {
    scrollContainer.scrollLeft-= 420;
    scrollContainer.style.scrollBehavior='smooth';
});
bestNext.addEventListener('click',()=> {
    bestScrollContainer.scrollLeft+= 420;
    bestScrollContainer.style.scrollBehavior='smooth';
});
bestPrev.addEventListener('click',()=> {
    bestScrollContainer.scrollLeft-= 420;
    bestScrollContainer.style.scrollBehavior='smooth';
});
function appliedright(){
    appliedScrollContainer.scrollLeft+= 340;
    appliedScrollContainer.style.scrollBehavior='smooth';
};
function appliedleft(){
    appliedScrollContainer.scrollLeft-= 340;
    appliedScrollContainer.style.scrollBehavior='smooth';
};
