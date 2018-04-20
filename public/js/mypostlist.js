function loadData() {
    var div_container = document.getElementById("div_container");
    var ajax = new XMLHttpRequest();
    ajax.open("GET","http://127.0.0.1:8000/api/v1/allSellersPost", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() {
        var data = JSON.parse(ajax.responseText);
        var count1,count2,container='',add=0,description='';
        for(count1=0;count1 < data.length; count1+=4)
        {

            for(count2=0; count2 < 4 ; count2++){

                if(data[add]["description"].length > 200){description = data[add]["description"].substring(0,200)+" ...";}else{description = data[add]["description"];}

                container +='<div class="col-md-4"> <div class="card" style="width: 20rem;"><img class="card-img-top" style="width: 100%; height: 200px" src="'+data[add]["productPicture"]+'" alt="Card image cap"><div class="card-body">' +
                    '   <h4 class="card-title">'+data[add]["productType"]+'</h4><p class="card-text">'+description+'' +
                    // '<span style="color: darkorange">  2 days ago </span></p>'+
                    '   <br style="line-height: .2"><a data-toggle="collapse" href="#ModalCenter'+add+'" aria-expanded="false" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="View Details">View Details</a>'+
                    '   <div class="collapse" id="ModalCenter'+add+'"><div >' +
                    ' <span>ProductType&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["productType"]+' </span><br><span>Location&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["country"]+' </span><br>' +
                    ' <span>City&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[add]["city"]+' </span><br><span>Packaging&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[add]["packaging"]+'</span><br>' +
                    ' <span>Payment Methods&emsp;&nbsp;&nbsp;&nbsp;:&emsp;'+data[add]["paymentMethods"]+' </span><br><span>Cost PerKg&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["costPerKg"]+' </span><br>'+
                    '  ' +
                    '</div></div></div></div></div>'
                    add+=1;
            }

        }
        div_container.innerHTML=container;
    }
    ajax.send(null);
}
onload=loadData();


