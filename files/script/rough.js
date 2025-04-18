let scrollContainer=document.querySelector('.box');
let next=document.getElementById('next');
let prev=document.getElementById('prev');

scrollContainer.addEventListener('wheel',(event)=> {
    event.preventDefault();
    scrollContainer.scrollLeft+=event.deltaY;
    scrollContainer.style.scrollBehavior='auto';
});
next.addEventListener('click',()=> {
    scrollContainer.scrollLeft+= 300;
    scrollContainer.style.scrollBehavior='smooth';
});
prev.addEventListener('click',()=> {
    scrollContainer.scrollLeft-= 300;
    scrollContainer.style.scrollBehavior='smooth';
});