$(document).ready(function () {
    setTimeout(function(){
        $('.alert').hide('slow');
    },2000);
});
function disabledText(){
    var checkbox = document.querySelector("#checkbox");
    var input = document.querySelector("#stock");

    var toogleInput = function(e){
        input.disabled = !e.target.checked;
    };

    toogleInput({target: checkbox});
    checkbox.addEventListener("change", toogleInput);
};
