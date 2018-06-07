function _(el){return document.getElementById(el);}
function  changepp() {
    var  pic = _('file_pic').files[0];
    if(pic.type === "image/jpeg" || pic.type === "image/jpg" || pic.type === "image/png"){
        _("error").innerHTML="";
        upload_image(pic);
    }else{
        _("error").innerHTML="Invalid image we only accept jpeg,jpg and png format";
    }
}

function upload_image(pic) {
    if ( _("file_pic").value != "") {
    var formdata = new FormData();
    formdata.append("file_pic", pic);
    formdata.append('_token',document.getElementsByName("_token").item(0).value);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "../../../change_pp");
    ajax.send(formdata);
    }else {
        _("error").innerHTML="Please select your picture";
    }
    function progressHandler(event){
        var percent = (event.loaded / event.total) * 100;
        _("error").innerHTML ="<span style=\"color:green\">Please wait... "+percent+"%<\span>";
        if(percent == 100){
            _("error").innerHTML ="";
        }
    }
    function completeHandler(event) {
        _("error").innerHTML = event.target.responseText;
       // document.getElementById('loading').style.display="none";
        var file= _("file_pic").files[0];
        _("pic_image").src="img/"+file.name
        if(localStorage.getItem("imageName") !== "null" || localStorage.getItem("imageName") !== null){
                removeOldImg();
        }
        localStorage.setItem("imageName",file.name)
    }
    function errorHandler(event){
        _("error").innerHTML = "Upload Failed";
        _("file_pic").value="";
    }
    function abortHandler(event){
        _("error").innerHTML = "Upload Aborted";
        _("file_pic").value="";
    }

}

function removeOldImg() {
    var ajax= new XMLHttpRequest();
    ajax.open("GET","../../deleteImg/"+localStorage.getItem("imageName"),true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
           }
        }
    ajax.send(null);
}

function saveData() {
    var  pic = _('file_pic').value,cell=_('cell').value,location=_('location').value;
    var name = _('name').value,interest=_('interest').value,idnumber=_('idnumber').value,email=_('email').value;
    if(cell.trim() !== "" || location.trim() !== "" || name.trim() !== "" || interest !== "" || idnumber !== "" || email !== ""){
        var formdata = new FormData();
        if(pic !== ""){formdata.append("file_pic", _('file_pic').files[0].name);}else{formdata.append("file_pic","")}
        formdata.append("cell",cell);
        formdata.append("location",location);
        formdata.append("name",name);
        formdata.append("interest",interest);
        formdata.append("idnumber",idnumber);
        formdata.append('id',document.getElementById('id').value);
        formdata.append("email",email);
        formdata.append('_token',document.getElementsByName("_token").item(0).value);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "../../../updateprofile");
        ajax.send(formdata);
        function progressHandler(event){
            var percent = (event.loaded / event.total) * 100;
            _("error").innerHTML ="<span style=\"color:green\">Please wait... "+percent+"%<\span>";
            if(percent == 100){
                _("error").innerHTML ="";
            }
        }
        function completeHandler(event) {
            _("error").innerHTML ="<span style='color:green'>"+event.target.responseText+"</span>";
            // document.getElementById('loading').style.display="none";
            var file= _("file_pic").files[0];
            if(_("file_pic").value !== "") {
                _("pic_image").src = "img/" + file.name;
                _("img2").src = "img/" + file.name;
            }
            _("nm").innerHTML = _('name').value;
            _("idn").innerHTML = _('idnumber').value;
            _("em").innerHTML = _('email').value;
            _("cl").innerHTML = _('cell').value;
            _("lc").innerHTML = _('location').value;

            setTimeout(function(){
                _("myModal").style.display="none";
            },2000);

            //if(localStorage.getItem("imageName") !== "null" || localStorage.getItem("imageName") !== null){
            //    _("myModal").style.display="none";
            // }
            localStorage.removeItem("imageName");
        }
        function errorHandler(event){
            _("error").innerHTML = "Upload Failed";
            _("file_pic").value="";
            localStorage.removeItem("imageName");
        }
        function abortHandler(event){
            _("error").innerHTML = "Upload Aborted";
            _("file_pic").value="";
            localStorage.removeItem("imageName");
        }
    }else{
        _("error").innerHTML="All fields required";
        localStorage.removeItem("imageName");
    }

}


