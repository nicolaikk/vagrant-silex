$( document ).ready(function() {
    $(this).removeClass("floating-message").addClass("floating-message");
});

function resetForm() {
    document.getElementById("post").value = "";
    document.getElementById("postTitle").value = "";
    document.getElementById("button2id").className = "btn btn-danger disabled";
}

function checkIfEmpty() {
    document.getElementById("button2id").className = "btn btn-danger";
}

function hideElement($element){
    var elements = document.getElementsByClassName($element);
    var firstElement = elements[0];
    firstElement.style.display = "none";
}