var x="close"
function myFunction() {
    document.getElementById("myDropdown").style.display="block";
    x="open"
}


window.onclick = function(event) {
    if (x  === 'close') {document.getElementById("myDropdown").style.display="none";x="open";}else{x="close";}
}


var OneSignal = window.OneSignal || [];
OneSignal.push(function() {
    OneSignal.init({
        appId: "9061f725-d62f-4978-97f1-eb1235f13b10",
        autoRegister: false,
        notifyButton: {
            enable: true,
        },
    });
});

strat();
