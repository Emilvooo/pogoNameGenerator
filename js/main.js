function saveTextAsFile()
{
    var textToWrite = document.getElementById("textarea-name").value.replace(/\n\r?/g, '\r\n');
    var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'});

    var downloadLink = document.createElement("a");
    downloadLink.download = "Accounts.txt";
    downloadLink.innerHTML = "Download File";
    if (window.webkitURL != null)
    {
        downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
    }
    else
    {
        downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
        downloadLink.onclick = destroyClickedElement;
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
    }

    downloadLink.click();
}

function destroyClickedElement(event)
{
    document.body.removeChild(event.target);
}

$('#passcheck').click(function() {
    $('#form-passcheck')[this.checked ? "show" : "hide"]();
});

$('#randomcheck').click(function() {
    $('#form-randomcheck')[this.checked ? "show" : "hide"]();
});

$('#randomnick').click(function() {
    $('#form-randomnick')[this.checked ? "show" : "hide"]();
});

$('textarea').html($('textarea').html().trim());
