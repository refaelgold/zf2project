/**
 * Created by refaelgold on 12/1/13.
 */




//
//$("#customer").submit(function(e) {
//
//
//    $(".globalWrapper").load(BASE_URL+'customer/index');
//
//});


$(function() {








    //customer ajax call
    $("#customerEdit").submit(function(e) {

        /* Get some values from elements on the page: */
        var values = $(this).serialize();

        /* Send the data using post and put the results in a div */
        $.ajax({
            dataType: 'html',
            url:BASE_URL+'customer/edit/'+currentId,
            type: "post",
            data:values,
            error:function(jqXHR, textStatus, errorThrown){
                alert("fails");
            },
            success:function(data){
                $(".globalWrapper").load(BASE_URL+'customer/index');
            }

        });
        return false;
    });


    $("#customerNew").submit(function(e) {

        /* Get some values from elements on the page: */
        var values = $(this).serialize();

        /* Send the data using post and put the results in a div */
        $.ajax({
            dataType: 'html',
            url:BASE_URL+'customer/new',
            type: "post",
            data:values,
            error:function(jqXHR, textStatus, errorThrown){
                alert("fails");
            },
            success:function(data){
                $(".globalWrapper").load(BASE_URL+'customer/index');
            }
        });
        return false;
    });







    $("#callNew").submit(function(e) {

        /* Get some values from elements on the page: */
        var values = $(this).serialize();


        alert(customerId);
        /* Send the data using post and put the results in a div */
        $.ajax({
            dataType: 'html',
            url:BASE_URL+'call/new/'+customerId,
            type: "post",
            data:values,
            error:function(jqXHR, textStatus, errorThrown){
                alert("fails");
            },
            success:function(data){
                $(".globalWrapper").load(BASE_URL+'call/index/'+customerId);
            }
        });
        return false;
    });







    $("#callEdit").submit(function(e) {

        /* Get some values from elements on the page: */
        var values = $(this).serialize();

        /* Send the data using post and put the results in a div */
        $.ajax({
            dataType: 'html',
            url:BASE_URL+'call/edit/'+callId,
            type: "post",
            data:values,
            error:function(jqXHR, textStatus, errorThrown){
                alert("fails");
            },
            success:function(data){
                $(".globalWrapper").load(BASE_URL+'call/index/'+customerId);
            }
        });
        return false;
    });











});




