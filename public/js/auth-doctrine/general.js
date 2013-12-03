/**
 * Created by refaelgold on 12/1/13.
 */





$(function() {


    $("input:checkbox").attr( "name", "forgetme" );

    $('input:checkbox').on("click",function () {


        var name = $(this).val();


        if (name==1){
            $(this).val(0);
            $(this).attr( "name", "forgetme" );
            $("input[type='hidden']").val(1);

        }
        else{
            $(this).val(1);
            $(this).attr( "name", "forgetme" );
            $("input[type='hidden']").val(0);

        }

        console.log("Change: " + name );
    });
});
