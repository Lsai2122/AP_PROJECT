let scrollContainer=document.querySelector('.event-view-box');
let normalNext=document.getElementById('normal-next');
let normalPrev=document.getElementById('normal-prev');
let bestNext=document.getElementById('best-next');
let bestPrev=document.getElementById('best-prev');

normalNext.addEventListener('click',()=> {
    scrollContainer.scrollLeft+= 420;
    scrollContainer.style.scrollBehavior='smooth';
});
normalPrev.addEventListener('click',()=> {
    scrollContainer.scrollLeft-= 420;
    scrollContainer.style.scrollBehavior='smooth';
});
normalNext.addEventListener('click',()=> {
    scrollContainer.scrollLeft+= 420;
    scrollContainer.style.scrollBehavior='smooth';
});
normalPrev.addEventListener('click',()=> {
    scrollContainer.scrollLeft-= 420;
    scrollContainer.style.scrollBehavior='smooth';
});