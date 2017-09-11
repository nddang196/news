/**
 * Created by nddan on 09-07-2017.
 */
function addActive(id)
{
    if(!$("#"+id).hasClass("active"))
    {
        $("#"+id).addClass("active");
    }
}

function removeActive(id)
{
    if($("#"+id).hasClass("active"))
    {
        $("#"+id).removeClass("active");
    }
}

function homeActive()
{
    addActive("nav-home");
    removeActive("nav-user");
    removeActive("nav-category");
    removeActive("nav-news");
    removeActive("nav-comment");
}

function userActive()
{
    addActive("nav-user");
    removeActive("nav-home");
    removeActive("nav-category");
    removeActive("nav-news");
    removeActive("nav-comment");
}

function categoryActive()
{
    addActive("nav-category");
    removeActive("nav-user");
    removeActive("nav-home");
    removeActive("nav-news");
    removeActive("nav-comment");
}

function newsActive()
{
    addActive("nav-news");
    removeActive("nav-user");
    removeActive("nav-category");
    removeActive("nav-home");
    removeActive("nav-comment");
}

function commentActive()
{
    addActive("nav-comment");
    removeActive("nav-user");
    removeActive("nav-category");
    removeActive("nav-news");
    removeActive("nav-home");
}

function dropdown()
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