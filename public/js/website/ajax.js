$(function() {
    $("#WebsiteContactUs").submit(function(e) {
        /* Get some values from elements on the page: */
        var values = $(this).serialize();

        /* Send the data using post and put the results in a div */
        $.ajax({

            dataType: 'html',

            //is i have a module i need to the BASE_URL
            url:'/contact',
            type: "post",
            data:values,
            error:function(jqXHR, textStatus, errorThrown){
            },
            success:function(data){
                $(".ajaxWrapper").load('/after-ajax-contact-us');
            }

        });
        return false;
    });
});




