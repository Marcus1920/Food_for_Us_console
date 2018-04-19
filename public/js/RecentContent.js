function loadData() {
    var div_container = document.getElementById("div_container");
    var ajax = new XMLHttpRequest();
    ajax.open("GET","http://127.0.0.1:8000/api/v1/allSellersPost", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() {
        var data = JSON.parse(ajax.responseText);
        var count1,count2,container='',add=0;
        for(count1=0;count1 < data.length; count1+=4)
        {
            container +="<div class=\"mbr-cards-row row\">";
            for(count2=0; count2 < 4 ; count2++){
                container +='<div class=\"mbr-cards-col col-xs-12 col-lg-3\" style=\"padding-top: 80px;  padding-bottom: 80px;\">' +
                ' <div class=\"container\"> <div class=\"card cart-block\" > <div class=\"card-img\"><img src=\"'+data[add]["productPicture"]+'" class="card-img-top" data-toggle="modal" data-target="#exampleModalCenter'+add+'" style="width:200px;height:200px;cursor: pointer"></div>' +
                ' <div class=\"card-block\"> <h4 class=\"card-title\">'+data[add]["productType"]+'</h4><h5 class=\"card-subtitle\"><'+data[add]["country"]+'/'+data[add]["city"]+'</h5>' +
                ' <p class=\"card-text\" style="text-align: center">'+data[add]["description"]+'</p>' +
                ' <div class=\"card-btn\"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter'+add+'">View</button></div></div></div>' +

                ' <div class="modal fade" id="exampleModalCenter'+add+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">' +
                ' <div class="modal-dialog modal-dialog-centered" role="document"> <div class="modal-content"> <div class="modal-header">' +
                ' <h3 class="modal-title" style="margin-bottom: -10px; margin-top: -10px;  float: left" id="exampleModalLongTitle">'+data[add]["productType"]+' </h3>' +
                ' <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button></div><div class="modal-body">' +
                ' <div class="card-img"><img src="'+data[add]["productPicture"]+'" style="width: 100%; height: 350px" class="card-img-top"></div><br style="line-height: .2">' +
                ' <span>ProductType&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["productType"]+' </span><br><span>Location&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["country"]+' </span><br>' +
                ' <span>City&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[add]["city"]+' </span><br><span>Packaging&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[add]["packaging"]+' </span><br>' +
                ' <span>Payment Methods&emsp;&nbsp;&nbsp;&nbsp;:&emsp;'+data[add]["paymentMethods"]+' </span><br><span>Cost PerKg&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["costPerKg"]+' </span><br>' +
                ' <span>Description&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["description"]+' </span></div> </div></div></div></div></div>' ;

                 add+=1;
            }
            container += "</div>";
        }
        div_container.innerHTML=container;
    }
     ajax.send(null);
}
onload=loadData();
