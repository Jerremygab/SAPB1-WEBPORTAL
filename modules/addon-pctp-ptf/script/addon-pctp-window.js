$(() => {

//===============INITIALIZATION===============//

    //Loading of tabs
    initialize((data, callback) => {
        renderHeader(data);
        ptcpWindowView.initialize(data);
        ptcpWindowView.reloadTab({tab: 'summary'});
        ptcpWindowView.reloadTab({tab: 'pod'});
        ptcpWindowView.reloadTab({tab: 'billing'});
        ptcpWindowView.reloadTab({tab: 'tp'});
        ptcpWindowView.reloadTab({tab: 'pricing'});
        ptcpWindowView.reloadTab({tab: 'treasury'}, callback);
    });


//===============EVENTS===============//
    
    //Execution of controller's methods that are mapped to buttons using data-action attribute
    $('button[data-pctp-action]').on('click', async (e) => {
        await callAction($(e.target).data('pctpAction'), $(e.target).data('arg'))
    })

    $('a.nav-link').on('click', async (e) => {
        ptcpWindowView.renderCountTabUpdate(e.currentTarget.id.replace('tab', ''))
        ptcpWindowView.renderCountSapObjs(e.currentTarget.id.replace('tab', ''))
    })

    $('span.count').on('click', async (e) => {
        $(e.target).parent().trigger('click')
    })

    $(document.body).on('click','#btncancel',function() {
        window.location.replace('../../dashboard/templates/dashboard.php')
    })
    $(document.body).on('click', '#btnLogout', function() {
        $('#logoutModal').modal('show');
    });
    $(document.body).on('click', '#btnLogoutConfirm', function (){
        $('#logoutModal').modal('hide');
        $.ajax({
            type: 'GET',
            url: '../proc/views/utilities/vw_logout.php',
            success: function (html) 
            {
                window.location.reload();
            }
        }); 
    });
});