function resetForm() {
    document.getElementById("post").value = "";
    document.getElementById("postTitle").value = "";
    document.getElementById("button2id").className = "btn btn-danger disabled";

}

function checkIfEmpty() {
    document.getElementById("button2id").className = "btn btn-danger";
}