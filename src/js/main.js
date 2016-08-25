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

if($('#form-passcheck').is(':visible')) {
    $("#input-pass").prop('required',true);
}

$('textarea').html($('textarea').html().trim());

// Tooltip

$('#btn-copy').tooltip({
    trigger: 'click',
    placement: 'bottom'
});

function setTooltip(btn, message) {
    $(btn).tooltip('hide')
        .attr('data-original-title', message)
        .tooltip('show');
}

function hideTooltip(btn) {
    setTimeout(function() {
        $(btn).tooltip('hide');
    }, 1000);
}

// Clipboard

var clipboard = new Clipboard('#btn-copy');

clipboard.on('success', function(e) {
    setTooltip(e.trigger, 'Copied!');
    hideTooltip(e.trigger);
});

clipboard.on('error', function(e) {
    setTooltip(e.trigger, 'Failed!');
    hideTooltip(e.trigger);
});