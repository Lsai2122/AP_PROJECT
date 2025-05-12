let scrollContainer=document.querySelector('.event-view-box');
let normalNext=document.getElementById('normal-next');
let normalPrev=document.getElementById('normal-prev');
let bestNext=document.getElementById('best-next');
let bestPrev=document.getElementById('best-prev');
let bestScrollContainer=document.querySelector('.best-event-view-box');
let appliedScrollContainer=document.querySelector('.applied-event-view-box');
let appliedNext=document.getElementById('applied-next');
let appliedPrev=document.getElementById('applied-prev');
let hostedPrev=document.getElementById('hosted-prev');
let hostedNext=document.getElementById('hosted-next');
let hostedScrollContainer=document.querySelector('.hosted-event-view-box');

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
appliedNext.addEventListener('click',()=> {
    appliedScrollContainer.scrollLeft+= 340;
    appliedScrollContainer.style.scrollBehavior='smooth';
});
appliedPrev.addEventListener('click',()=> {
    appliedScrollContainer.scrollLeft-= 340;
    appliedScrollContainer.style.scrollBehavior='smooth';
});
hostedNext.addEventListener('click',()=> {
    hostedScrollContainer.scrollLeft+= 420;
    hostedScrollContainer.style.scrollBehavior='smooth';
});
hostedPrev.addEventListener('click',()=> {
    hostedScrollContainer.scrollLeft-= 420;
    hostedScrollContainer.style.scrollBehavior='smooth';
});