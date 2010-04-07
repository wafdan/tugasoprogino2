
function DeleteRepoUserAjax(repositoryid, filenamehash,activeid) {
    var ajaxpost = new XMLHttpRequest();
        if (ajaxpost) {
            ajaxpost.open("POST", "script/deleterepositoryuserajax.php");
            ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data;
            data = "repositoryid=" + repositoryid + "&filenamehash=" + filenamehash;
            ajaxpost.send(data);
        }
        ShowRepoUserAjax(activeid, 0, 10);
}

function ChangeAttributeStatusUserAjax(repoid,status) {
    var ajaxpost = new XMLHttpRequest();
    if (ajaxpost) {
        ajaxpost.open("POST", "script/changestatusrepouserajax.php");
        ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var data;
        data = "statusupdate=" + status + "&repositoryid=" + repoid;
        ajaxpost.send(data);
    }
}

function ChangeAttributeCategoryUserAjax(repoid, status) {
    var ajaxpost = new XMLHttpRequest();
    if (ajaxpost) {
        ajaxpost.open("POST", "script/changecategoryrepouserajax.php");
        ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var data;
        data = "statusupdate=" + status + "&repositoryid=" + repoid;
        ajaxpost.send(data);
    }
}

function DownloadRepoUserAjax(filenamehash, repoid,counter) {
    var ajaxpost = new XMLHttpRequest();
    if (ajaxpost) {
        ajaxpost.open("POST", "script/downloadrepouserajax.php");
        ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var data;
        data = "repositoryid=" + repoid + "&counter=" + counter;
        ajaxpost.send(data);
    }
    location = "repositoryfiles/" + filenamehash;
}

function ChangeAvatarUserAjax(filenamehash) {
    var ajaxpost = new XMLHttpRequest();
    if (ajaxpost) {
        ajaxpost.open("POST", "script/changeavataruserajax.php");
        ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var data;
        data = "filenamehash=" + filenamehash;
        ajaxpost.send(data);
    }
}

    function HelloWorld() {
        alert("Hello World");
     }

     function Hello(repositoryid) {
         alert("Hello " + repositoryid);
     }
     function ShowRepoUserAjax(userid, page, limit) {
        var ajaxpost = new XMLHttpRequest();
        if (ajaxpost) {
            var obj = document.getElementById('reposhow');
            ajaxpost.open("POST", "script/repositoryuserajax.php");
            ajaxpost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            ajaxpost.onreadystatechange = function() {
                if (ajaxpost.readyState == 4 && ajaxpost.status == 200) {
                    obj.innerHTML = ajaxpost.responseText;
                }
            }
            var data;
            data = "repo_userid=" + userid + "&page=" + page + "&limit=" + limit;
            //alert(data);
            ajaxpost.send(data);
        }
    } 

