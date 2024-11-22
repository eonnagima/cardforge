//select footer
const footer = document.querySelector('footer');

//bubbling over footer elements with class .dropdown
footer.addEventListener('click', function(e) {
    if (e.target.classList.contains('dropdown')) {
        e.preventDefault();
        //toggle between classes fa-caret-down and fa-caret-up on target
        e.target.classList.toggle('fa-caret-down');
        e.target.classList.toggle('fa-caret-up');

        e.target.parentElement.nextElementSibling.classList.toggle('hidden');
    }
});