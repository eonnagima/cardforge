let reviewSection = document.querySelector('#review-section');

// toggle review input
document.querySelector("#write-review").addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector(".review-input").classList.toggle('hidden');
    document.querySelector("#write-review").classList.toggle('hidden');
});

postReviewBtn = document.querySelector("#post-review");

postReviewBtn.addEventListener('click', function(e) {
    e.preventDefault();

    let rating = document.querySelector("#rating").value;
    let reviewText = document.querySelector("#review-txt").value;
    let anonymous = document.querySelector("#anonymous");
    let productAlias = this.dataset.product;
    let userName = this.dataset.user;
    let userEmail = this.dataset.email;

    let formData = new FormData();

    formData.append('user', userEmail);
    formData.append('anonymous', anonymous.checked);
    formData.append('rating', rating);
    formData.append('reviewText', reviewText);
    formData.append('productAlias', productAlias);

    fetch('./ajax/new_review.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(text => {
            document.querySelector(".review-input").classList.toggle('hidden');
            let seperator = document.createElement('div');
            seperator.classList.add('seperator');
            reviewSection.appendChild(seperator);
            newReview(rating, reviewText, anonymous, userName);
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function newReview(rating, text, anonymous, userName) {
    let newReview = document.createElement('section');
    newReview.classList.add('review');

    let reviewHeader = document.createElement('section');
    reviewHeader.classList.add('header');

    let reviewRating = document.createElement('div');
    reviewRating.classList.add('rating');
    
    for(let i = 0; i < 5 ; i++) {
        let star = document.createElement('span');
        star.classList.add('fa-star');
        if(i < rating) {
            star.classList.add('fa');
        }else{
            star.classList.add('far');
        }
        reviewRating.appendChild(star);
    }

    reviewHeader.appendChild(reviewRating);

    let reviewAuthor = document.createElement('span');
    reviewAuthor.classList.add('reviewer');
    
    if(anonymous.checked){
        reviewAuthor.innerHTML = 'Anonymous';
    }else{
        reviewAuthor.innerHTML = userName;
    }

    reviewHeader.appendChild(reviewAuthor);

    newReview.appendChild(reviewHeader);

    let reviewInfo = document.createElement('section');
    reviewInfo.classList.add('info');

    let reviewDate = document.createElement('span');
    reviewDate.classList.add('date');

    const DATE = new Date();
    const OPTIONS = {day: '2-digit', month: 'short', year: 'numeric'};
    let formattedDate = DATE.toLocaleDateString('en-GB', OPTIONS);
    reviewDate.innerHTML = formattedDate;
    reviewInfo.appendChild(reviewDate);

    let reviewVerified = document.createElement('span');
    reviewVerified.classList.add('verified');
    reviewVerified.innerHTML = '| Verified Purchase';
    reviewInfo.appendChild(reviewVerified);

    newReview.appendChild(reviewInfo);

    let newReviewTxt = document.createElement('p');
    newReviewTxt.innerHTML = text;

    newReview.appendChild(newReviewTxt);

    reviewSection.appendChild(newReview);
}