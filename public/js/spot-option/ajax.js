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




    $("#customer").submit(function(e) {

        /* Stop form from submitting normally */
//        e.preventDefault();

        /* Clear result div*/
        $(".globalWrapper").html('');
        $(".globalWrapper").load(BASE_URL+'customer/index');




        /* Get some values from elements on the page: */
        var values = $(this).serialize();

        /* Send the data using post and put the results in a div */
        $.ajax({
            dataType: 'html',
            url:'/spot-option/customer/index',
            type: "post",
//            data:values,


            error:function(jqXHR, textStatus, errorThrown){
                alert("fails");
                $(".globalWrapper").empty();
                $(".globalWrapper").load(BASE_URL+'customer/index')

            },


            success:function(data){

            }

        });

    });






    $("#newCustomerBtn").click(function(e) {

        /* Stop form from submitting normally */
//        e.preventDefault();

        /* Clear result div*/
        $(".globalWrapper").html('');
        $(".globalWrapper").load(BASE_URL+'customer/index');




        /* Get some values from elements on the page: */
        var values = $(this).serialize();

        /* Send the data using post and put the results in a div */
        $.ajax({
            dataType: 'html',
            url:'/spot-option/customer/new',
            type: "post",
//            data:values,


            error:function(jqXHR, textStatus, errorThrown){
                alert("fails");
                $(".globalWrapper").empty();
//                $(".globalWrapper").load(BASE_URL+'customer/edit/'.id)

            },


            success:function(data){

            }

        });

    });





});




//$(function(){
//    $("form#TestEntity").submit(function(){
//
//        //if not call by ajax
//        //submit to showformAction
//        if (is_xmlhttprequest == 0)
//            return true;
//
//        //if by ajax
//        //check by ajax : validatepostajaxAction
//        $.post(urlform,
//            { 'name' : $('input[name=name]').val() }, function(itemJson){
//
//                var error = false;
//
//                if (itemJson.name != undefined){
//
//                    if ($(".element_name ul").length == 0){
//                        //prepare ...
//                        $(".element_name").append("<ul></ul>");
//                    }
//
//                    for(var i=0;i<itemJson.name.length;i++)
//                    {
//                        if ($(".element_name ul").html().substr(itemJson.name[i]) == '')
//                            $(".element_name ul").append('<li>'+itemJson.name[i]+'</li>');
//                    }
//
//                    error = true;
//                }
//
//                if (!error){
//                    $("#winpopup").dialog('close');
//
//                    if (itemJson.success == 1){
//                        alert('Data saved');
//                    }
//                }
//
//            }, 'json');
//
//        return false;
//    });
//});
//



