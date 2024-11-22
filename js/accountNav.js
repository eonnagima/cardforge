const headerAvatar = document.querySelector('.header-avatar');
const accountNav = document.querySelector('.account-nav');

headerAvatar.addEventListener('click', function(e){
    e.preventDefault();
    accountNav.classList.toggle('active');
});