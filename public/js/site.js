function scrollEvent()
{
    var st = 0;

    $(window).scroll(function ()
    {
        var current = $(this).scrollTop();

        if(current > 170)
        {
            $("#up_to_top").show();
            if(current < st)
            {
                $("#navbar").css("position", "fixed");
            }
            else
            {
                $("#navbar").css("position", "static");
            }
        }
        else
        {
            if(current <= 0)
            {
                $("#navbar").css("position", "static");
            }
            $("#up_to_top").hide();
        }

        st = current;
    })
}

function dropdownEvent()
{
    $(".dropdown").mouseover(function ()
    {
        $(this).addClass("open");
    })
    $(".dropdown").mouseout(function ()
    {
        $(this).removeClass("open");
    })
}

