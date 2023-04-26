$(function(){
    $("a#confirmDeletion").on("click", function(){
        if(!confirm("Are you sure ?")) {
            return false;
        }
    });
});


$(function(){
    $('#selectAllBoxes').on('click', function(e){
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            })
        }
    });
});


$(function(){
    $('input[type="file"]').on('change', function(event){
        //  get the file name
        var fileName = event.target.files[0].name;
        // replace the placeholder text with filename
        $('.custom-file-label').html(fileName);
    });
});


$(function(){
    setTimeout(function(){
        document.querySelector('#sessionMessage').remove();
    }, 4000);
});


$(function(){
    // disable button initially
    $('#postsPerPage').prop('disabled', true);
    // enable the button when value changes
    $('#selectPostsPerPage').on('change', function(){
        $('#postsPerPage').prop('disabled', false);
    });
});


$(function(){
    // disable button initially
    $('#updatePostStatus').prop('disabled', true);
    // enable button when the value changes
    $('#selectPostStatus').on('change', function(){
        $('#updatePostStatus').prop('disabled', false);
    })
});

$(function(){
    // disable button initially
    $('#pagesPerPage').prop('disabled', true);
    // enable the button when value changes
    $('#selectPagesPerPage').on('change', function(){
        $('#pagesPerPage').prop('disabled', false);
    });
});


$(function(){
    // disable button initially
    $('#updatePageStatus').prop('disabled', true);

    // enable button when the value changes
    $('#selectPageStatus').on('change', function(){
        $('#updatePageStatus').prop('disabled', false);
    })
});

$(function(){
    $('#categoryButton').prop('disabled', true);
    $('#selectCategoriesPerPage').on('change', function(){
        $('#categoryButton').prop('disabled', false);
    });
});

$(function(){
    $('#updateUserRole').prop('disabled', true);
    $('#changeUserRole').on('change', function(){
        $('#updateUserRole').prop('disabled', false);
    });
});


$(function(){
    // disable download button initially
    $('#downloadButton').prop('disabled', true);
    $('input:radio').on('click', function(){
        $('#downloadButton').prop('disabled', false);
    });
});

$(function(){
    // disable download button initially
    $('#import').prop('disabled', true);
    $('#csvFilename').on('input', function(){
        $('#import').prop('disabled', false);
    });
});

$(function(){
    // disable username input
    $('.disable').prop('disabled', true);
});

$(function(){
    // disable email input
    $('.disable').prop('disabled', true);
});
