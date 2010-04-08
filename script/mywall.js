function enter_pressed(e) {
    var keycode;
    if (window.event) keycode = window.event.keyCode;
    else if (e) keycode = e.which;
    else return false;
    return (keycode == 13);
}

function PostCommentUserAjax(wallpostid, comment, walluserid) {
    var ajaxpost = new XMLHttpRequest();
    //alert("comment");
    if (ajaxpost) {
        ajaxpost.open("POST", "script/postcommentuserajax.php");
        ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var data;
        data = "wallpostid=" + wallpostid + "&comment=" + comment;
        ajaxpost.send(data);
    }
    ShowMyWallUserAjax(walluserid, 0, 5);
}

function ShowHideComment(wallpostid) {
    var obj = document.getElementById(wallpostid);
    if (obj) {
        if (obj.style.height == "0pt") {
            obj.style.height = "auto";
            obj.style.visibility = "visible";
        } else {
        obj.style.height = "0pt";
        obj.style.visibility = "hidden";
        }
    }
}
 
 function PostWallUserAjax(content,walluserid) {
     var ajaxpost = new XMLHttpRequest();
     //alert("comment");
     if (ajaxpost) {
         ajaxpost.open("POST", "script/postwalluserajax.php");
         ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
         var data;
         data = "content=" + content;
         ajaxpost.send(data);
     }
     ShowMyWallUserAjax(walluserid, 0, 5); 
 }

function ShowMyWallUserAjax(walluserid,page,limit) {
    var ajaxpost = new XMLHttpRequest();
    if (ajaxpost) {
        var obj = document.getElementById('wallusershow');
        ajaxpost.open("POST", "script/mywalluserajax.php");
        ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajaxpost.onreadystatechange = function() {
            if (ajaxpost.readyState == 4 && ajaxpost.status == 200) {
                obj.innerHTML = ajaxpost.responseText;
            }
        }
        var data;
        data = "walluserid=" + walluserid + "&page=" + page + "&limit=" + limit;
        ajaxpost.send(data);
    }
}