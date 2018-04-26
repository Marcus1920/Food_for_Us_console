function loadData() {
    var div_container = document.getElementById("div_container");
    var ajax = new XMLHttpRequest();
    ajax.open("GET","http://127.0.0.1:8000/api/v1/all", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() {
        var data = JSON.parse(ajax.responseText);
        var count1,count2,container='',add=0,description='';
            for(count2=0; count2 < data.length ; count2++){
                if(data[add]["description"].length > 200){description = data[add]["description"].substring(0,200)+" ...";}else{description = data[add]["description"];}
                container +='<div class="col-md-4"> <div class="card" style="width: 20rem;"><img class="card-img-top" style="width: 100%; height: 200px" src="'+data[add]["productPicture"]+'" alt="Card image cap"><div class="card-body">' +
                    '   <h4 class="card-title">'+data[add]["productType"]+'</h4><p class="card-text">'+description+'' +
                    '<span style="color: darkorange">'+ timeDifference(data[add]["created_at"],new Date().toISOString().replace(/z|t/gi,' ').substring(0,19).trim())  +'</span></p>'+
                    '   <br style="line-height: .2"><a data-toggle="collapse" href="#ModalCenter'+add+'" aria-expanded="false" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="View Details">View Details</a>'+
                    '   <div class="collapse" id="ModalCenter'+add+'"><div >' +
                    ' <span>ProductType&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["productType"]+' </span><br><span>Location&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["country"]+' </span><br>' +
                    ' <span>City&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[add]["city"]+' </span><br><span>Packaging&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;'+data[add]["packaging"]+'</span><br>' +
                    ' <span>Payment Methods&emsp;&nbsp;&nbsp;&nbsp;:&emsp;'+data[add]["paymentMethods"]+' </span><br><span>Cost PerKg&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;'+data[add]["costPerKg"]+' </span><br>'+
                    '  ' +
                    '</div></div></div></div></div>'
                    add++;
        }
        if(container===''){container='<h2 class="card-title" style="text-align: center">You do not have any post post</h2>'}
        div_container.innerHTML=container;
    }
    ajax.send(null);

}
onload=loadData();


function timeDifference(current, previous) {
    return "";
  //  return current +"tttt"+ previous;
    var msPerMinute = 60 * 1000;
    var msPerHour = msPerMinute * 60;
    var msPerDay = msPerHour * 24;
    var msPerMonth = msPerDay * 30;
    var msPerYear = msPerDay * 365;

    var elapsed = current - previous ;

    if (elapsed < msPerMinute) {
        return Math.round(elapsed/1000) + ' seconds ago';
    }

    else if (elapsed < msPerHour) {
        return Math.round(elapsed/msPerMinute) + ' minutes ago';
    }

    else if (elapsed < msPerDay ) {
        return Math.round(elapsed/msPerHour ) + ' hours ago';
    }

    else if (elapsed < msPerMonth) {
        return 'approximately ' + Math.round(elapsed/msPerDay) + ' days ago';
    }

    else if (elapsed < msPerYear) {
        return 'approximately ' + Math.round(elapsed/msPerMonth) + ' months ago';
    }

    else {
        return 'approximately ' + Math.round(elapsed/msPerYear ) + ' years ago';
    }
}