const accountNav = document.querySelector('.account-nav');

document.querySelector('.header-avatar--mobile').addEventListener('click', function(e){
    e.preventDefault();
    accountNav.classList.toggle('active');
});

document.querySelector('.header-avatar--desktop').addEventListener('click', function(e){
    e.preventDefault();
    accountNav.classList.toggle('active');
});