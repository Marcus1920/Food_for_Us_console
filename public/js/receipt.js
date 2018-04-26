function loadData() {
    var div_container = document.getElementById("div_container");
    var ajax = new XMLHttpRequest();
    ajax.open("GET","http://127.0.0.1:8000/api/v1/getRecipes", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() {
        var data = JSON.parse(ajax.responseText);

        var count1,count2,container='',description='', add=0,size=0;
        if(data.length < 4){size=data.length}else{size=4}
        for(count1=0;count1 < data.length; count1+=4)
        {
            container +="<div class=\"row\">";
            for(count2=0; count2 < size ; count2++){

                if(data[add]["description"].length > 400){description = data[add]["description"].substring(0,400)+" ...";}else{description = data[add]["description"];}name

                 container +='<div class="col-md-6 ml-auto mr-auto"><div class="card card-nav-tabs"><h4 class="card-header card-header-info">'+data[add]["name"]+'</h4>' +
                    '   <div class="card-body"><img class="card-img-top" style="width: 100%; height: 250px" src="'+data[add]["imgurl"]+'" alt="Card image cap">' +
                    '   <p class="card-text">'+description+'</p>'+
                    '   <a data-toggle="collapse" href="#ModalCenter'+add+'" aria-expanded="false" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="View Details">View Details </a><div class="card-footer text-muted"> 2 days ago </div>' +
                    '  <div class="collapse" id="ModalCenter'+add+'"><div >'+
                    '  <span><b>First Name</b>&emsp;&emsp;&emsp;&emsp;<b>:</b>&emsp;'+data[add]["firstName"]+' </span><br><br><span><b>Last Name</b>&emsp;&emsp;&emsp;&emsp;<b>:</b>&emsp;'+data[add]["surname"]+' </span><br><br>'+
                    '  <span><b>Ingredients</b>&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&nbsp;<b>:</b>&emsp;'+data[add]["ingredients"]+' </span><br><br><span><b>Methods</b>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<b>:</b>&emsp;'+data[add]["methods"]+'</span><br>' +
                    '  </div></div></div></div></div>'
                     add+=1;
            }
            container +="</div>"
        }
        div_container.innerHTML=container;
    }
    ajax.send(null);
}
onload=loadData();


