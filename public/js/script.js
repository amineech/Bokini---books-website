window.onload = () => {

    const intro_section = document.querySelector('.intro-text'),
          recom_books = document.querySelector('.recommended-books');
          
    intro_section.setAttribute('id', 'slide-intro');
    recom_books.setAttribute('id', 'slide-recommended');

    // initialize animate on scroll library (AOS)
    AOS.init();

    console.log('Loaded successfully !');    
};

// display menu on burger-icon click Start (Client Side)
const items = document.querySelector('.burger-menu .items'),
      burger_icon = document.querySelector('.burger-menu');

// click event
    burger_icon.onclick = () => {
        if(!items.hasAttribute('id'))
            items.setAttribute('id', 'show-menu')
        else
            items.removeAttribute('id');       
};
// display menu on burger-icon click End (Client Side)


// Books Page Start =======================================================

// load more books button start
    $(document).on('click', '.books .inner .load-more .load-more-btn', () => {
        
        var last_idBook = Number($('.books .inner .load-more .val_idBook').val());

        // make the request
        $.ajax({
            url: 'resources/load-more-books.php', // the path is according to where the file is going to be refered as external js file !
            method: 'POST',
            data: { 
                'last_id': last_idBook,
            },
            dataType: "json",
            beforeSend: () => {
                $('.books .inner .load-more .load-more-btn').text('Loading...');
            },
            success: (response) => {
                setTimeout(() => { 
                    if(response){
                        if(response.items.length !== 0) {
                            $('.books .inner .load-more').remove(); //to avoid duplicate when adding load more in php file
                            $('.books .inner .books-content').append(response.items);
                            $('.books .inner').append(response.load);
                        } else{
                            $('.books .inner .load-more').remove();
                        }
                    }
                }, 1000);
            }
        });
    });
// load more books button end

// Books Page End =======================================================

// Detail Book Start

// load more similar books (same category) start
    $(document).on('click', '.books .inner .load-more2 .load-more-btn', () => {

        var last_idBook = Number($('.books .inner .load-more2 .val_idBook').val()),
            chosen_idBook = Number($('.books .inner .load-more2 .val_chosenBook').val()),
            last_categoryBook = Number($('.books .inner .load-more2 .val_categoryBook').val());

        // make the request
        $.ajax({
            url: 'resources/load-more-similar-books.php', // the path is according to where the file is going to be refered as external js file !
            method: 'POST',
            data: { 
                'last_id': last_idBook,
                'chosen_idBook': chosen_idBook,
                'last_category': last_categoryBook
            },
            dataType: "json",
            beforeSend: () => {
                $('.books .inner .load-more2 .load-more-btn').text('Loading...');
            },
            success: (response) => {
                setTimeout(() => { 
                    if(response){
                        if(response.items.length !== 0) {
                            $('.books .inner .load-more2').remove(); //to avoid duplicating when adding load more in php file
                            $('.books .inner .books-content').append(response.items);
                            $('.books .inner').append(response.load);
                        } else {
                            $('.books .inner .load-more2').remove();
                        }
                    }
                }, 1000);
            }
        });
    });
// load more similar books (same category) end

// Detail Book End

// Authors Page Start

// load more authors start
    $(document).on('click', '.authors .inner .load-more-auth .load-more-btn', () => {

        var last_idAuthor = Number($('.authors .inner .load-more-auth .val_idAuthor').val());

        // make request
        $.ajax({
            url: 'resources/load-more-authors.php',
            method: 'POST',
            data: { 'last_idAuthor': last_idAuthor },
            dataType: 'json',
            beforeSend: () => {
                $('.authors .inner .load-more-auth .load-more-btn').text('Loading...');
            },
            success: (response) => {
                setTimeout(() => {
                    if(response.authors.length !== 0){
                        $('.authors .inner .load-more-auth').remove();
                        $('.authors .inner .authors-content').append(response.authors);
                        $('.authors .inner').append(response.load);
                    } else {
                        $('.authors .inner .load-more-auth').remove();
                    }
                }, 1000);
            }
        })

    });
// load more authors end

// Authors Page End

// Author Overview Page Start

// load more authors start
$(document).on('click', '.authors .inner .load-more-auth2 .load-more-btn', () => {

    var last_idAuthor = Number($('.authors .inner .load-more-auth2 .val_idAuthor').val()),
        chosen_author = Number($('.authors .inner .load-more-auth2 .val_chosenAuthor').val());

    // make request
    $.ajax({
        url: 'resources/load-more-other-authors.php',
        method: 'POST',
        data: { 
            'last_idAuthor': last_idAuthor,
            'chosen_author': chosen_author
        },
        dataType: 'json',
        beforeSend: () => {
            $('.authors .inner .load-more-auth2 .load-more-btn').text('Loading...');
        },
        success: (response) => {
            setTimeout(() => {
                if(response.authors.length !== 0){
                    $('.authors .inner .load-more-auth2').remove();
                    $('.authors .inner .authors-content').append(response.authors);
                    $('.authors .inner').append(response.load);
                } else {
                    $('.authors .inner .load-more-auth2').remove();
                }
            }, 1000);
        }
    });
});
// load more other authors end

// Author Overview Page End

// Articles Page Start

// load more other articles start
$(document).on('click', '.articles .inner .load-more .load-more-btn', () => {
    console.log('test');
    var last_idArticle = Number($('.articles .inner .load-more .val_idArticle').val());
    console.log(last_idArticle);
    $.ajax({
        url: 'resources/load-more-articles.php',
        method: 'POST',
        data: { 'last_idArticle': last_idArticle },
        dataType: 'json',
        beforeSend: () => {
            console.log('before');
            $('.articles .inner .load-more .load-more-btn').text('Loading...');
        },
        success: (response) => {
            setTimeout(() => {
                if(response.articles.length !== 0){
                    $('.articles .inner .load-more').remove();
                    $('.articles .inner .articles-content').append(response.articles);
                    $('.articles .inner').append(response.load);
                } else {
                    $('.articles .inner .load-more').remove();
                }
            }, 1000);
        }
    });
}); 
// load more articles end

// Articles Page End

// Article Detail Page Start

// load more other articles start
$(document).on('click', '.other-articles .inner .content-inner .load-more .load-more-btn', () => {
    var chosen_article = Number($('.other-articles .inner .content-inner .load-more .chosen_article').val());
    var last_idArticle = Number($('.other-articles .inner .content-inner .load-more .val_last_idArticle').val());

    // ajax request
    $.ajax({
        url: 'resources/load-other-articles.php',
        method:'POST',
        data: { 
            'last_idArticle': last_idArticle,
            'chosen_article': chosen_article
        },
        dataType: 'json',
        beforeSend: () => {
            $('.other-articles .inner .content-inner .load-more .load-more-btn').text('Loading...');
        },
        success: (response) => {
            setTimeout(() => {
                if(response.articles.length !== 0){
                    $('.other-articles .inner .content-inner .load-more').remove();
                    $('.other-articles .inner .content-inner').append(response.articles);
                    $('.other-articles .inner .content-inner').append(response.load);

                } else{
                    $('.other-articles .inner .content-inner .load-more').remove();
                }
            }, 1000);
        }
    });
});
// load more other articles end

// Article Detail Page End