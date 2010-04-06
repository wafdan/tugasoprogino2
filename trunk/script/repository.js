function ajaxRequest(){
    if(window.XMLHttpRequest)
    {
    return new XMLHttpRequest();
    }else if(window.ActiveXObject)
    {
    return new ActiveXObject("Microsoft.XMLHTTP");
    }
    else
    {
    return false;
    }
}

function UploadFileUSER() {
    var reposhow = document.getElementById('repolist');
    return true;
}

function ShowRepoUserAjax(var userid,var page, var limit)
{
    var ajaxpost = new XMLHttpRequest();
    if(ajaxpost)
    {
        var obj = document.getElementById('reposhow');
        ajaxpost.open("POST","repositoryhandler.php");
        ajaxpost.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        ajaxpost.onreadystatechange = function() 
        { 
            if (ajaxpost.readyState == 4 && 
                ajaxpost.status == 200) { 
            obj.innerHTML = ajaxpost.responseText; 
        } 
    }
    return true;
}
