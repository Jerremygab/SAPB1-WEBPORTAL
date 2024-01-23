$(document).ready(function () {
    $(document.body).on('click', '#btnPrint', function () {
        let layout = $('#layoutOptions').val();
        var docentry = $('#txtDocNum').val();
        
        if(docentry != '')
        {
            window.open("../forms/form.php?layout=" + layout + "&docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
        }
    });
});