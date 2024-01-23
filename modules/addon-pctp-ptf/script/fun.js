// Highlighting row when clicking in the current row
const selectTableRow = (jCheckRow, forceSelectRow = false) => {
    let jTableRow = jCheckRow.parent().parent()
    if (jCheckRow.is(':checked')) {
        if (!jTableRow.hasClass('selected') || forceSelectRow) {
            jTableRow.addClass('selected')
            jTableRow.find('td').each(function(){
                $(this).css('background-color', ptcpWindowView.viewOptions.selection_background_color)
            })
        }
    } else {
        ptcpWindowView.unselectTableRow(jTableRow);
    }
}

// Field event listeners and validators
const fieldEvent = (jElement, eventType, targetTabName = '', globalEvent = '') => {
    try {
        let activeTabName = targetTabName ? targetTabName : ptcpWindowView.getActiveTabName();
        if (ptcpWindowView.columnValidations[activeTabName] !== undefined) {
            let fieldName = jElement.data('pctpModel');
            let activeTabValidations = ptcpWindowView.columnValidations[activeTabName];
            if (activeTabValidations[fieldName] !== undefined) {
                if (activeTabValidations[fieldName].events[eventType] !== undefined) {
                    let row = jElement.parent().parent();
                    let jElementValue = ptcpWindowView.getAnonymousElementValue(jElement);
                    let eventOptions = activeTabValidations[fieldName].events[eventType].filter(o => {
                        ptcpWindowView.log('globalEvent:', globalEvent)
                        ptcpWindowView.log('jElementValue:', jElementValue)
                        ptcpWindowView.log('o.values:', o.values)
                        ptcpWindowView.log('o.for:', o.for)
                            return o.for.includes(globalEvent) 
                                && (o.values.includes(jElementValue) || (!o.values.length && (new RegExp(o.regex)).test(jElementValue)));
                        });
                    if (!eventOptions.length) {
                        eventOptions = activeTabValidations[fieldName].events[eventType].filter(o => o.values.includes('DEFAULT'));
                    }
                    if (!eventOptions.length) {
                        if (!targetTabName) fieldOnchange(jElement);
                        return;
                    }
                    for (const eventOption of eventOptions) {
                        let observee = eventOption.observee;
                        let success = true;
                        if (observee !== undefined && observee.invalidValues.length) {
                            for (const field of observee.fields) {
                                let e = row.find(`*[data-pctp-model='${field}']`);
                                let value = '';
                                if (!e.length) {
                                    ptcpWindowView.log('cannot find observee', field, e[0].localName, jElement)
                                    ptcpWindowView.refreshDataValue(jElement)
                                    ptcpWindowView.log(`Cannot find element: ${e[0].localName} field: ${field}`);
                                    success = false;
                                } else {
                                    value = ptcpWindowView.getAnonymousElementValue(e);
                                    if (observee.invalidValues.includes(value)) {
                                        ptcpWindowView.log('invalid values detected', field, e[0].localName, jElement)
                                        ptcpWindowView.refreshDataValue(jElement)
                                        ptcpWindowView.log(`Field '${field}' should have a valid value`);
                                        success = false;
                                    }
                                }
                            }
                        }
                        if (success && observee.result !== undefined && observee.result.success !== undefined) {
                            let successEvent = observee.result.success;
                            let arg = {
                                row: row,
                                activeTabName: activeTabName,
                                jElement: jElement,
                                ...successEvent.arg
                            }
                            if (!targetTabName || !successEvent.callback.includes('prompt')) ptcpWindowView[successEvent.callback](arg);
                            if (!targetTabName) selectTableRow(row.find('input[type=checkbox]'), true);
                        }
                    }
                }
            }
        }
        if (!targetTabName) fieldOnchange(jElement);
    } catch (error) {
        ptcpWindowView.log(error)
        if (!targetTabName) promptMessage1Button('ERROR', error, 'OK');
    }
}

// File upload listener
const fileUploadRemoveListener = (input) => {
    try {
        if ($(input).html() === 'REMOVE') {
            ptcpWindowView.removeUploadedAttachment(ptcpWindowView.getActiveTabName(), ptcpWindowView.currentRowTabCode);
        } else {
            if (!ptcpWindowView.isValidData($(input).val()) || !ptcpWindowView.isValidData($(input)[0].files[0].name)) return
            ptcpWindowView.addUploadedAttachment(ptcpWindowView.getActiveTabName(), ptcpWindowView.currentRowTabCode, $(input)[0].files[0]);
        }
        let attachment = ptcpWindowView.uploadedAttachment[ptcpWindowView.getActiveTabName()][ptcpWindowView.currentRowTabCode].attachment;
        renderUploadModal(attachment)
        ptcpWindowView.isValidData(attachment) ? ptcpWindowView.currentAttachmentLink.html('1 attachment').prop('title', attachment) 
            : ptcpWindowView.currentAttachmentLink.html('No attachment').prop('title', '');
        fieldOnchange(ptcpWindowView.currentAttachmentLink)
    } catch (error) {
        ptcpWindowView.log(error)
        promptMessage1Button('ERROR', error, 'OK');
    }
    $(input).val('');
    ptcpWindowView.log(ptcpWindowView.uploadedAttachment)
}

// Attachment link control
const clickAttachmentLink = (linkTag, event) => {
    ptcpWindowView.currentAttachmentLink = $(linkTag);
    ptcpWindowView.currentRowTabCode = ptcpWindowView.currentAttachmentLink.parent().parent().data('pctpCode');
    if (ptcpWindowView.uploadedAttachment.hasOwnProperty(ptcpWindowView.getActiveTabName())) {
        let attachmentObj = ptcpWindowView.uploadedAttachment[ptcpWindowView.getActiveTabName()][ptcpWindowView.currentRowTabCode];
        if (ptcpWindowView.isValidData(attachmentObj) && attachmentObj.hasOwnProperty('attachment')) renderUploadModal(attachmentObj.attachment, true)
    }
    event.preventDefault();
}

const renderUploadModal = (attachment, reopenModal = false) => {
    let uploadModal = $('#uploadmodal');
    if (reopenModal) uploadModal.modal('hide');
    if (ptcpWindowView.getActiveTabName() === 'pod') {
        $('#uploadmodalbtnupload').removeClass('d-none');
    } else {
        if (!$('#uploadmodalbtnupload').hasClass('d-none')) $('#uploadmodalbtnupload').addClass('d-none');
    }
    let html = '';
    html += '<div class="container-fluid">'
    if (!ptcpWindowView.isValidData(attachment)) {
        html += '<div class="row d-flex">'
        html += '<div class="col-12 text-center">'
        html += '<span>No Attachment</span>'
        html += '</div>'
        html += '</div>'
        $('#uploadmodalbtnupload').html('UPLOAD');
    } else {
        html += '<div class="row d-flex">'
        html += `<div class="col-${ptcpWindowView.getActiveTabName() === 'pod' ? '6' : '12'} text-center">`
        html += '<span><a href="../res/download.php?code='+ptcpWindowView.currentRowTabCode+'&file='+attachment+'" download>'+attachment+'</a></span>'
        html += '</div>'
        if (ptcpWindowView.getActiveTabName() === 'pod') {
            html += '<div class="col-6 text-center">'
            html += '<button onclick="fileUploadRemoveListener(this)">REMOVE</button>'
            html += '</div>'
        }
        html += '</div>'
        $('#uploadmodalbtnupload').html('REPLACE');
    }
    html += '</div>'
    uploadModal.find('div.modal-body').html('');
    uploadModal.find('div.modal-body').html(html);
    if (reopenModal) uploadModal.modal('show');
}

//
const loadingMethodWrapper = async (info, ...methods) => {
    if (ptcpWindowView.isValidData(info)) {
        setScreenLoading(true, false, info);
    } else {
        setScreenLoading(true);
    }
    await timeout(10)
    for (const method of methods) {
        method()
    }
    setScreenLoading(false);
}

// Onchange event and checking for modification
const fieldOnchange = (jElement) => {
    ptcpWindowView.fieldOnchange(jElement);
}

// Selecting Row via checkbox, only modified rows will checked
const selectRow = (checkbox, isDirectClick = true) => {
    let row = checkbox.parent().parent();
    let activeTabName = ptcpWindowView.getActiveTabName();
    if (checkbox.is(':checked')) {
        ptcpWindowView.selectedModifiedRows.push(row.data('pctpCode'));
    } else {
        ptcpWindowView.selectedModifiedRows = ptcpWindowView.selectedModifiedRows.filter(z => z !== row.data('pctpCode'));
    }
    if (isDirectClick) {
        ptcpWindowView.log('modified-rows', ptcpWindowView.modifiedRows);
        ptcpWindowView.log('selected-modified-rows', ptcpWindowView.selectedModifiedRows);
        ptcpWindowView.renderCountTabUpdate(activeTabName);
    }
    if (['billing', 'tp'].includes(activeTabName)) {
        if (checkbox.is(':checked')) {
            if (ptcpWindowView.isValidData(checkbox.data('pctpPosting'))) {
                ptcpWindowView.selectedSapObjRows.push(`${row.data('pctpCode')}-${checkbox.data('pctpPosting')}`);
            }
        } else {
            ptcpWindowView.selectedSapObjRows = ptcpWindowView.selectedSapObjRows.filter(z => z !== `${row.data('pctpCode')}-${checkbox.data('pctpPosting')}`);
        }
        ptcpWindowView.log('selected-rows', ptcpWindowView.selectedSapObjRows);
    }
    ptcpWindowView.renderCountSapObjs(activeTabName)
}

// Data parsing from rows, only changed values will be parsed
const parseDataRow = (row, tab, dontConsiderChanges = false) => {
    let data = {}, props = {}, old = {};
    data['Code'] = ptcpWindowView.getRowCode(tab, row);
    row.find('a[data-pctp-model]:not([data-pctp-formula])').each(function(){
        let attachmentObj = ptcpWindowView.uploadedAttachment[tab][row.data('pctpCode')];
        if (ptcpWindowView.isValidData(attachmentObj) && $(this).data('pctpValue') != attachmentObj.attachment) {
            props[$(this).data('pctpModel')] = attachmentObj.attachment;
            old[$(this).data('pctpModel')] = $(this).data('pctpValue');
            data['upload'] = attachmentObj.upload;
            data['uploaded'] = attachmentObj.uploaded;
        }
    })
    row.find('input.edit-field:not([data-pctp-formula])').each(function(){
        if (dontConsiderChanges || String($(this).data('pctpValue')).replace(/\s/g, '') != String($(this).val()).replace(/\s/g, '')) {
            props[$(this).data('pctpModel')] = $(this).val();
            if (!dontConsiderChanges) old[$(this).data('pctpModel')] = $(this).data('pctpValue');
        }
    })
    row.find('select.edit-field:not([data-pctp-formula])').each(function(){
        ptcpWindowView.log('data-pctp-value', $(this).data('pctpValue'))
        ptcpWindowView.log('element-value', $(this).find(":selected").val())
        if (dontConsiderChanges || String($(this).data('pctpValue')).replace(/\s/g, '') != String($(this).find(":selected").val()).replace(/\s/g, '')) {
            props[$(this).data('pctpModel')] = $(this).find(":selected").val();
            if (!dontConsiderChanges) old[$(this).data('pctpModel')] = $(this).data('pctpValue');
        }
    })
    if (dontConsiderChanges || ptcpWindowView.getActiveTabName() === 'pod') {
        row.find('span[data-pctp-model]:not([data-pctp-formula])').each(function(){
            let htmlTextValue = ptcpWindowView.decodeHtml($(this).html());
            if (ptcpWindowView.getActiveTabName() === 'pod') {
                if (String($(this).data('pctpValue')).replace(/\s/g, '') != String(htmlTextValue).replace(/\s/g, '')) {
                    props[$(this).data('pctpModel')] = htmlTextValue;
                    old[$(this).data('pctpModel')] = $(this).data('pctpValue');
                }
            } else {
                props[$(this).data('pctpModel')] = htmlTextValue;
            }
        })
    }
    if (dontConsiderChanges || Object.keys(props).length) {
        data['props'] = props;
        if (!dontConsiderChanges) data['old'] = old;
    }
    ptcpWindowView.log('data:', data)
    return data;
}

// Render header fields with passed header data from back end
const renderHeader = (header) => {
    $('input[data-pctp-header]').each(function(){
        $(this).val(header[$(this).data('pctpHeader')]);
    })
    $('select[data-pctp-header]').each(function(){
        for (const option of header.dropDownOptions[$(this).data('pctpOptions')]) {
            $(this).append($('<option>', {
                value: option.Name,
                text: option.Name
            }));
        }
    })
}

// Parse header fields
const parseHeader = () => {
    let data = {};
    $('input[data-pctp-header]').each(function(){
        data[$(this).data('pctpHeader')] = $(this).val();
    })
    $('select[data-pctp-header]').each(function(){
        data[$(this).data('pctpHeader')] = $(this).find(":selected").val();
    })
    return data;
}

// Initialize module by ajax calling controller.initialize()
const initialize = (afterInitEvent) => {
    result = $.ajax({
        type: 'GET',
        url: '../res/action.php',
        data: {action: 'initialize'},
        async: false
    }).responseText;
    try {
        ptcpWindowView.log('init-data-pctp-received', JSON.parse(result))
        result = JSON.parse(result)
        afterInitEvent(result, () => setScreenLoading(false));
        return result;
    } catch (error) {
        ptcpWindowView.log(result)
    }
}

// Ajax call to execute controller's public methods
const callAction = async (actionName, arg) => {
    setScreenLoading(true);
    if (!ptcpWindowView.validateAction(actionName)) {
        setScreenLoading(false, true)
        return false;
    }
    let data = {};
    data['activeTab'] = ptcpWindowView.getActiveTabName();
    let count = 0, fullCount = 0, results = [], filteredSapObjRows = [];
    switch (actionName) {
        case 'find':
            data['header'] = parseHeader();
            ptcpWindowView.log('data-pctp-passed', data)
            ptcpWindowView.selectedModifiedRows = ptcpWindowView.selectedModifiedRows.filter(s => !s.includes(ptcpWindowView.getActiveTabName()))
            ptcpWindowView.renderCountTabUpdate();
            return await actionAjax(actionName, data, () => setScreenLoading(false, true))
        case 'update':
            ptcpWindowView.log('modifiedRows', ptcpWindowView.modifiedRows)
            let dataForUpdate = ptcpWindowView.getTabModifiedRows(ptcpWindowView.getActiveTabName());
            let tabRows = dataForUpdate.tabRows;
            let childRows = dataForUpdate.childRows;
            let childTab = dataForUpdate.childTab;
            ptcpWindowView.log('tabRows', dataForUpdate)
            // processing of attachments or uploads
            ptcpWindowView.showInfo('Updating rows...')
            if (tabRows.length) {
                for (const row of tabRows) {
                    if (ptcpWindowView.isValidData(row.upload) && typeof row.upload === 'object' && row.props.Attachment === row.upload.name) {
                        let returnData = await uploadAjax(row);
                        ptcpWindowView.log('file-upload-result', returnData)
                        if (returnData.result === 'success') {
                            row.uploaded = 'yes';
                            ptcpWindowView.log('uploaded-row:', row)
                            ptcpWindowView.uploadedAttachment[ptcpWindowView.getActiveTabName()][`${ptcpWindowView.getActiveTabName()}.${row.Code}`] = {
                                attachment: row.upload.name,
                                removed: 'no',
                                upload: null,
                                uploaded: 'no'
                            }
                        } else {
                            row.uploaded = 'no';
                        }
                    }
                }
                let validatedRows = JSON.parse(JSON.stringify(tabRows));
                ptcpWindowView.log('validatedRows', validatedRows)
                data['rows'] = validatedRows;
                ptcpWindowView.log('data-pctp-passed', data)
                await actionAjax(actionName, data, childRows.length ? null : () => setScreenLoading(false))
                if (!childRows.length) return;
            }
            if (childRows.length) {
                data['activeTab'] = childTab;
                for (const row of childRows) {
                    if (ptcpWindowView.isValidData(row.upload) && typeof row.upload === 'object' && row.props.Attachment === row.upload.name) {
                        let returnData = await uploadAjax(row);
                        ptcpWindowView.log('file-upload-result', returnData)
                        if (returnData.result === 'success') {
                            row.uploaded = 'yes';
                        } else {
                            row.uploaded = 'no';
                        }
                    }
                }
                let validatedRows = JSON.parse(JSON.stringify(childRows));
                ptcpWindowView.log('validatedRows', validatedRows)
                data['rows'] = validatedRows;
                ptcpWindowView.log('data-pctp-passed', data)
                return await actionAjax(actionName, data, () => setScreenLoading(false))
            }
            setScreenLoading(false, true)
            break;
        case 'createSalesOrder':
            filteredSapObjRows = ptcpWindowView.selectedSapObjRows.filter(s => s.includes('SALES_ORDER'));
            fullCount = filteredSapObjRows.length
            prepProgressBar();
            for (const sapObjRow of filteredSapObjRows) {
                count++;
                progressBar(count, fullCount, 'Creating Sales Order');
                data['sapObjRow'] = sapObjRow;
                ptcpWindowView.log('data-pctp-passed', data)
                let result = await actionAjax(actionName, data);
                ptcpWindowView.log(result)
                if (!result.valid) {
                    remProgressBar();
                    setScreenLoading(false)
                    ptcpWindowView.showError('Sales Order Creation Failed');
                    promptMessage1Button('ERROR', result.message, 'OK');
                    return;
                }
                results.push(result)
            }
            remProgressBar();
            ptcpWindowView.showSuccess('Created Sales Order Successfully');
            for (const result of results) {
                ptcpWindowView.refreshUpdatedRowsFromTab(result.rDataRows, result.rowData !== undefined ? result.rowData : null);
            }
            setScreenLoading(false)
            break;
        case 'createArInvoice':
            filteredSapObjRows = ptcpWindowView.selectedSapObjRows.filter(s => s.includes('AR_INVOICE'));
            fullCount = filteredSapObjRows.length
            prepProgressBar();
            for (const sapObjRow of filteredSapObjRows) {
                count++;
                progressBar(count, fullCount, 'Creating AR Invoice');
                data['sapObjRow'] = sapObjRow;
                ptcpWindowView.log('data-pctp-passed', data)
                let result = await actionAjax(actionName, data);
                ptcpWindowView.log(result)
                if (!result.valid) {
                    remProgressBar();
                    setScreenLoading(false)
                    ptcpWindowView.showError('AR Invoice Creation Failed');
                    promptMessage1Button('ERROR', result.message, 'OK');
                    return;
                }
                results.push(result)
            }
            remProgressBar();
            ptcpWindowView.showSuccess('Created AR Invoice Successfully');
            for (const result of results) {
                ptcpWindowView.refreshUpdatedRowsFromTab(result.rDataRows, result.rowData !== undefined ? result.rowData : null);
            }
            setScreenLoading(false)
            break;
        case 'createApInvoice':
            filteredSapObjRows = ptcpWindowView.selectedSapObjRows.filter(s => s.includes('AP_INVOICE'));
            fullCount = filteredSapObjRows.length
            prepProgressBar();
            for (const sapObjRow of filteredSapObjRows) {
                count++;
                progressBar(count, fullCount, 'Creating AP Invoice');
                data['sapObjRow'] = sapObjRow;
                ptcpWindowView.log('data-pctp-passed', data)
                let result = await actionAjax(actionName, data);
                ptcpWindowView.log(result)
                if (!result.valid) {
                    remProgressBar();
                    setScreenLoading(false)
                    ptcpWindowView.showError('AP Invoice Creation Failed');
                    promptMessage1Button('ERROR', result.message, 'OK');
                    return;
                }
                results.push(result)
            }
            remProgressBar();
            ptcpWindowView.showSuccess('Created AP Invoice Successfully');
            for (const result of results) {
                ptcpWindowView.refreshUpdatedRowsFromTab(result.rDataRows, result.rowData !== undefined ? result.rowData : null);
            }
            setScreenLoading(false)
            break;
        case 'downloadAttachment':
            if (ptcpWindowView.isValidData(arg)) {
                let dataArg = {};
                dataArg['code'] = arg[0];
                dataArg['file'] = arg[1];
                data['arg'] = dataArg;
                ptcpWindowView.log('data-pctp-passed', data)
                return await actionAjax(actionName, data, () => setScreenLoading(false, true))
            }
            break;
        default:
            setScreenLoading(false);
    }
}

// File Upload Ajax
const uploadAjax = async (row) => {
    try {
        let file_data = row.upload;   
        let form_data = new FormData();                  
        form_data.append('file', file_data);
        form_data.append('code', row.Code);
        ptcpWindowView.log(form_data);                             
        return await $.ajax({
            url: '../res/upload.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(res){
                return res;
            }
        });
    } catch (error) {
        ptcpWindowView.showError(error.message)
    }
    
}

// Main Action Ajax
const actionAjax = async (actionName, data, callback = null) => {
    return await $.post('../res/action.php', {action: actionName, data: data}).then((d) => {
        try {
            ptcpWindowView.log('data-pctp-received', JSON.parse(d));
            let data = JSON.parse(d)
            if (data.type !== undefined && data.type === 'error') throw data.message
            if (data.result == 'success') {
                if (ptcpWindowView.isValidData(data.message) && ptcpWindowView.isValidData(callback)) ptcpWindowView.showSuccess(data.message)
                if (ptcpWindowView.isValidData(data.callback)) {
                    ptcpWindowView[data.callback](data.arg, callback === null ? null : () => callback());
                } else {
                    if (callback !== null) {
                        callback();
                    } else {
                        return data.resultData;
                    }
                }
            } else {
                if (ptcpWindowView.isValidData(data.message) && ptcpWindowView.isValidData(callback)) ptcpWindowView.showError(data.message)
                if (callback !== null) {
                    callback();
                } else {
                    return data.resultData;
                }
            }
        } catch (error) {
            ptcpWindowView.showError(error)
            ptcpWindowView.log(error)
            ptcpWindowView.log(d)
            if (callback !== null) {
                callback();
            }
        }
    });
}

// Show or unshow loading animation
const setScreenLoading = (isLoading, hidePortalMessage = false, infoWhenLoading = '') => {
    isLoading ? $('#loadingAnimation').removeClass('d-none') : $('#loadingAnimation').addClass('d-none');
    if (isLoading) ptcpWindowView.showInfo(ptcpWindowView.isValidData(infoWhenLoading) ? infoWhenLoading : 'Please wait...')
    if (hidePortalMessage) ptcpWindowView.hidePortalMessage();
}

// Make timeout in millisecond
const timeout = (ms) => new Promise(resolve => setTimeout(resolve, ms));

// Tabs reloading
class PtcpWindowView {
    #selectedRows;
    #sapObjs;
    #sapDocumentStructures;
    #uploadedAttachment;
    #columnValidations;
    #columnDefinitions;
    #dropDownOptions;
    #constants;
    #actionValidations;
    #viewOptions;
    constructor() {
        this.currentRowTabCode = '';
        this.currentAttachmentLink = {};
        this.modifiedRows = []; // Global array for storing modified rows for later update or any opertaion 
        this.selectedModifiedRows = []; // Global array for selected modified rows for later update or any opertaion 
        this.#selectedRows = []; // Global array for storing selected rows 
        this.selectedSapObjRows = []; // Global array for storing sapObj parsed from selected rows 
        this.#sapObjs = []; // Global array for storing sapObj parsed from selected rows 
        this.#uploadedAttachment = {};
        this.childUpdateRow = [];
        this.#actionValidations = {};
        this.#viewOptions = {};
    }
    get uploadedAttachment() {
        return this.#uploadedAttachment;
    }
    get selectedRows() {
        return this.#selectedRows;
    }
    get sapObjs() {
        return this.#sapObjs;
    }
    get columnValidations() {
        return this.#columnValidations;
    }
    get constants() {
        return this.#constants
    }
    get viewOptions() {
        return this.#viewOptions
    }
    initialize(data) {
        this.#sapDocumentStructures = data.sapDocumentStructures;
        this.#uploadedAttachment = data.uploadedAttachment;
        this.#columnValidations = data.columnValidations;
        this.#columnDefinitions = data.columnDefinitions;
        this.#dropDownOptions = data.dropDownOptions;
        this.#sapObjs = data.sapObjs;
        this.#constants = data.constants;
        this.#actionValidations = data.actionValidations;
        this.#viewOptions = data.viewOptions;
    }
    addUploadedAttachment(tabName, code, file) {
        if (this.#uploadedAttachment[tabName][code] !== undefined) {
            if (this.#uploadedAttachment[tabName][code].attachment === file.name) throw 'Selected file is already uploaded';
        }
        if (this.#uploadedAttachment[tabName][code] === undefined) {
            this.#uploadedAttachment[tabName][code]  = {attachment: file.name, upload: file};
        }
        this.#uploadedAttachment[tabName][code].attachment = file.name
        this.#uploadedAttachment[tabName][code].upload = file
    }
    removeUploadedAttachment(tabName, code) {
        if (this.#uploadedAttachment[tabName][code] === undefined) {
            this.#uploadedAttachment[tabName][code]  = {attachment: '', upload: {}};
        } else {
            this.#uploadedAttachment[tabName][code].attachment = ''
            this.#uploadedAttachment[tabName][code].upload = {};
        }
    }
    addModifiedRow(data, tab) {
        try {
            if (Object.keys(data).length > 1) {
                if (this.modifiedRows.length) {
                    const tabRows = this.modifiedRows.filter(z => z.tab === tab)
                    if (tabRows.length) {
                        if (tabRows[0].rows.length) {
                            let storedData = tabRows[0].rows.filter(z => z.Code === data.Code)
                            if (storedData.length) {
                                tabRows[0].rows = tabRows[0].rows.filter(z => z.Code !== data.Code)
                                tabRows[0].rows.push(data);
                            } else {
                                tabRows[0].rows.push(data);
                            }
                        } else {
                            tabRows[0].rows.push(data);
                        }
                    } else {
                        this.modifiedRows.push({tab: tab, rows: [data]});
                    }
                } else {
                    this.modifiedRows.push({tab: tab, rows: [data]});
                }
                return true
            } else {
                const tabRows = this.modifiedRows.filter(z => z.tab === tab)
                if (tabRows.length) {
                    this.modifiedRows.map(z => {
                        if (z.tab === tab) z.rows = z.rows.filter(x => x.Code !== data.Code);
                    })
                }
                return false
            }
        } catch (error) {
            promptMessage1Button('ERROR', 'Cannot add modified row.', 'OK', error)
            return false
        }
    }
    getTabModifiedRows(tabName) {
        try {
            let selectedCodes = this.selectedModifiedRows.map(z => z.replace(new RegExp(`^${ptcpWindowView.getActiveTabName()}`), ''))
            let filteredModifiedRows = this.modifiedRows.filter(z => z.tab === tabName)
            let tabRows = filteredModifiedRows.length ? filteredModifiedRows[0].rows.filter(z => selectedCodes.includes(z.Code)): []
            let childCodes = (this.childUpdateRow.map(c => this.selectedModifiedRows.includes(c.parent) ? c.child : null )).filter(c => this.isValidData(c));
            let childTab = childCodes.length ? childCodes[0].replace(/\d+/, '') : '';
            let filteredModifiedChildRows = this.modifiedRows.filter(z => z.tab === childTab)
            let selectedChildCodes = childCodes.map(z => z.replace(new RegExp(`^${childTab}`), ''))
            let childRows = filteredModifiedChildRows.length ? filteredModifiedChildRows[0].rows.filter(z => selectedChildCodes.includes(z.Code)): []
            return {
                tabRows: tabRows, 
                childRows: childRows, 
                childTab: childCodes.length ? childCodes[0].replace(/\d+/, '') : ''
            }
        } catch (error) {
            throw error
        }
    }
    renderCountTabUpdate(tabName) {
        let tabModifiedRows = this.selectedModifiedRows.filter(z => z.includes(tabName));
        if (tabModifiedRows.length) {
            $('#btnaddupdate').removeAttr('disabled');
            $('#btnaddupdate span.count').html(`(${tabModifiedRows.length})`);
        } else {
            $('#btnaddupdate').attr('disabled', true);
            $('#btnaddupdate span.count').html(``);
        }
    }
    renderCountSapObjs(tabName) {
        let tabSapObjRows = this.selectedSapObjRows.filter(z => z.includes(tabName));
        let typeCount = [];
        for (const structure in this.#sapDocumentStructures) {
            let count = 0;
            if (Object.hasOwnProperty.call(this.#sapDocumentStructures, structure)) {
                for (const selectedSapObjRow of tabSapObjRows) {
                    if (selectedSapObjRow.includes(structure)) count++;
                }
            }
            typeCount.push({
                type: structure,
                count: count
            })
        }
        this.log('typeCount', typeCount)
        let countObj = typeCount.filter(tc => tc.type === 'SALES_ORDER')[0];
        if (countObj.count) {
            $('#btncreatesalesorder').removeAttr('disabled');
            $('#btncreatesalesorder span.count').html(`(${countObj.count})`);
        } else {
            $('#btncreatesalesorder').attr('disabled', true);
            $('#btncreatesalesorder span.count').html(``);
        }
        countObj = typeCount.filter(tc => tc.type === 'AR_INVOICE')[0];
        if (countObj.count) {
            $('#btncreatearinvoice').removeAttr('disabled');
            $('#btncreatearinvoice span.count').html(`(${countObj.count})`);
        } else {
            $('#btncreatearinvoice').attr('disabled', true);
            $('#btncreatearinvoice span.count').html(``);
        }
        countObj = typeCount.filter(tc => tc.type === 'AP_INVOICE')[0];
        if (countObj.count) {
            $('#btncreateapinvoice').removeAttr('disabled');
            $('#btncreateapinvoice span.count').html(`(${countObj.count})`);
        } else {
            $('#btncreateapinvoice').attr('disabled', true);
            $('#btncreateapinvoice span.count').html(``);
        }
    }
    isValidData(data) {
        if (data === undefined || data === null || data === '') return false;
        return true;
    }
    getRowCode(tab, row) {
        return row.data('pctpCode').replace(new RegExp(`^${tab}`), '');
    }
    async reloadTab(arg, callback = null){
        
        $(`#${arg.tab}tabpaneloading`).removeClass('d-none')
        $(`#${arg.tab}loading`).removeClass('d-none')
        if (!$(`#${arg.tab}tabpanecontent`).hasClass('d-none')) $(`#${arg.tab}tabpanecontent`).addClass('d-none')
        const cb = (t, callback) => {
            this.initializeDataTable($(`#tabtbl${t}`), t);
            if (callback !== null) {
                callback();
            }
        }
        if (arg.uploadedAttachment !== undefined) {
            this.#uploadedAttachment[arg.tab] = arg.uploadedAttachment;
            ptcpWindowView.log('uploadedAttachment:', this.#uploadedAttachment)
        }
        $(`#${arg.tab}tabpanecontent`).load(`../templates/components/ptcp-table-tab.php?tab=${arg.tab}`, () => cb(arg.tab, callback));
        if (arg.tab === 'pod') this.modifiedRows = [];
        this.selectedSapObjRows = this.selectedSapObjRows.filter(s => !s.includes(arg.tab))
        this.renderCountSapObjs(arg.tab)
    }
    #runObserversEvents(jParent, targetTabName, globalEvent = '') {
        jParent.find('[data-pctp-observer]').each(function(){
            fieldEvent($(this), 'onchange', targetTabName, globalEvent);
        })
    }
    initializeDataTable(tbl, tabName) {
        if (!tbl.find('tr td.nodataplaceholder').length) {
            tbl.DataTable({
                ajax: {
                    url: '../res/api.php',
                    type: 'POST',
                    data: {
                        action: 'fetchDataRows',
                        data: {
                            tab: tabName
                        }
                    }
                },
                createdRow: function (row, data, index) {
                    let tdCode = $(row).find('td span[data-pctp-code]');
                    let code = tdCode.data('pctpCode')
                    tdCode.removeAttr('data-pctp-code')
                    $(row).attr('data-pctp-code', code)
                },
                initComplete: function(settings, json) {
                    if (!$(`#${tabName}tabpaneloading`).hasClass('d-none')) $(`#${tabName}tabpaneloading`).addClass('d-none')
                    if (!$(`#${tabName}loading`).hasClass('d-none')) $(`#${tabName}loading`).addClass('d-none')
                    $(`#${tabName}tabpanecontent`).removeClass('d-none')
                    if ($(`#tabtbl${tabName}`).find('tr').length) ptcpWindowView.#runObserversEvents($(`#tabtbl${tabName}`), tabName, 'initialize');
                    ptcpWindowView.renderTableRowsFormula(tabName);
                },
                info: false,
                searching: false,
                pagingType: 'full_numbers',
                ordering: false,
            });
        } else {
            if (!$(`#${tabName}tabpaneloading`).hasClass('d-none')) $(`#${tabName}tabpaneloading`).addClass('d-none')
            if (!$(`#${tabName}loading`).hasClass('d-none')) $(`#${tabName}loading`).addClass('d-none')
            $(`#${tabName}tabpanecontent`).removeClass('d-none')
        }
    }
    hasDataTable(tabName) {
        return $.fn.DataTable.isDataTable(`#tabtbl${tabName}`)
    }
    refreshUpdatedRows(arg, callback = null) {
        let modifiedRowCode = [];
        for (const m of arg.rows) {
            for (const k in m.props) {
                if (Object.hasOwnProperty.call(m.props, k)) {
                    $(`#tabtbl${arg.tab}`).DataTable().$(`tr[data-pctp-code='${arg.tab}${m.Code}']`).each(function() {
                        let row = $(this);
                        let e = row.find(`*[data-pctp-model='${k}']`);
                        if (e.length) {
                            switch (e[0].localName) {
                                case 'span':
                                    e = ptcpWindowView.setAnonymousElementValue(arg.tab, e, m.props[k])
                                    e.data('pctpValue', m.props[k])
                                    break;
                                default:
                                    e.data('pctpValue', m.props[k])
                                    break;
                            }
                            ptcpWindowView.#runObserversEvents(row, arg.tab, 'update');
                            modifiedRowCode.push(m.Code);
                        }
                        ptcpWindowView.unselectTableRow(row, row.find('input[type=checkbox]'))
                    });
                }
            }
        }
        for (const modifiedRow of ptcpWindowView.modifiedRows) {
            if (modifiedRow.tab === arg.tab) {
                modifiedRow.rows = modifiedRow.rows.filter(r => !modifiedRowCode.includes(r.Code))
            }
        }
        ptcpWindowView.childUpdateRow = ptcpWindowView.childUpdateRow.filter(c => !modifiedRowCode.includes(c.parent))
        let selectedModifiedRowCodes = modifiedRowCode.map(m => `${arg.tab}${m}`);
        ptcpWindowView.selectedModifiedRows = ptcpWindowView.selectedModifiedRows.filter(s => !selectedModifiedRowCodes.includes(s))
        if (arg.rDataRows !== undefined) {
            this.refreshUpdatedRowsFromTab(arg.rDataRows);
        }
        if (arg.uploadedAttachment !== undefined) {
            this.#uploadedAttachment = arg.uploadedAttachment;
        }
        if (callback !== null) {
            callback();
        }
    }
    refreshUpdatedRowsFromTab(dataRows, rowData = null) {
        for (const d of dataRows) {
            for (const m of d.rows) {
                let hasModifiedRowData = false;
                for (const k in m.props) {
                    if (Object.hasOwnProperty.call(m.props, k)) {
                        $(`#tabtbl${d.tab}`).DataTable().$(`tr[data-pctp-code='${d.tab}${m.Code}']`).each(function() {
                            let row = $(this);
                            let e = row.find(`*[data-pctp-model='${k}']`);
                            if (e.length) {
                                switch (e[0].localName) {
                                    case 'span':
                                        e = ptcpWindowView.setAnonymousElementValue(d.tab, e, m.props[k])
                                        e.data('pctpValue', m.props[k])
                                        break;
                                    default:
                                        e.data('pctpValue', m.props[k])
                                        break;
                                }
                                ptcpWindowView.renderRowFormulas(d.tab, row)
                                if (!hasModifiedRowData) {
                                    ptcpWindowView.#runObserversEvents(row, d.tab, 'update');
                                    let checkbox = row.find('input[type=checkbox]');
                                    if (checkbox.length) checkbox.data('pctpModified', false)
                                    if (ptcpWindowView.isValidData(rowData)) {
                                        let e = row.find(rowData.find);
                                        if (e.length) {
                                            for (const key in rowData.data) {
                                                if (Object.hasOwnProperty.call(rowData.data, key)) {
                                                    const value = rowData.data[key];
                                                    e.data(key, value)
                                                    if (key === 'posting' && value !== '') {
                                                        let selectedSapRow = ptcpWindowView.selectedSapObjRows.filter(s => s.includes(`${d.tab}${m.Code}`));
                                                        if (selectedSapRow.length) {
                                                            ptcpWindowView.selectedSapObjRows.push(`${d.tab}${m.Code}-${value}`);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ptcpWindowView.selectedSapObjRows = ptcpWindowView.selectedSapObjRows.filter(s => !s.includes(`${d.tab}${m.Code}`))
                                    hasModifiedRowData = true;
                                    ptcpWindowView.unselectTableRow(row, checkbox)
                                }
                            }
                        });
                    }
                }
            }
        }
        this.renderCountSapObjs(ptcpWindowView.getActiveTabName());
    }
    showError(message) {
        portalMessage(message, 'red', 'white');
    }
    showSuccess(message) {
        portalMessage(message, '#00FF7F', 'black');
    }
    showInfo(message, timeout = -1) {
        portalMessage(message, 'lightblue', 'black', timeout);
    }
    hidePortalMessage() {
        $('#messageBar').text('').css({'background-color': '', 'color': ''});   
        $('#messageBar2').removeClass('d-none');
    }
    disableFields(arg) {
        for (const fieldName of arg.fieldNames) {
            let e = arg.row.find(`input[data-pctp-model="${fieldName.replace(/^_/, '')}"]`);
            if (!e.length) {
                e = arg.row.find(`select[data-pctp-model="${fieldName.replace(/^_/, '')}"]`)
            }
            if (e.length) {
                let newTdHtml = '';
                newTdHtml += `<td style="vertical-align: middle; background-color: ${this.#viewOptions.td_background_color};">`;
                newTdHtml += `<span data-pctp-model="${e.data('pctpModel')}" data-pctp-value="${e.data('pctpValue')}">${e.val()}</span>`
                newTdHtml += `</td>`;
                e.parent().replaceWith(newTdHtml);
            }
        }
    }
    enableFields(arg) {
        for (const fieldName of arg.fieldNames) {
            let e = arg.row.find(`span[data-pctp-model='${fieldName.replace(/^_/, '')}']`);
            if (e.length) {
                let newTdHtml = '';
                newTdHtml += `<td style="vertical-align: middle;">`;
                let columnDefinition = this.#columnDefinitions[arg.activeTabName].filter(f => f.fieldName === fieldName)[0];
                let data = e.data('pctpValue');
                let dataHtml = e.html();
                let placeHolder = 'No data';
                switch (columnDefinition.columnViewType) {
                    case 'DROPDOWN':
                        let options = this.#dropDownOptions[columnDefinition.options];
                        newTdHtml += `<select onchange="fieldOnChange(this)" data-pctp-model="${e.data('pctpModel')}" data-pctp-value="${data}" 
                                        class="edit-field" id="sel${e.data('pctpModel').toLowerCase()}" 
                                        style="width: 100%;" data-pctp-options="${columnDefinition.options}">`
                        newTdHtml += `<option value=""></option>`;
                        if (!options.filter(o => o.Code === data || o.Name === data).length) {
                            newTdHtml += `<option value="${data}" selected>${data}</option>`;
                        }
                        for (const option of options) {
                            newTdHtml += `<option value="${option.Name}" ${option.Name === data || option.Code === data ? 'selected' : ''}>${option.Name}</option>`
                        }
                        newTdHtml += `</select>`
                        break;
                    default:
                        let inputType;
                        let inputValue = '';
                        let inputPlaceholder = '';
                        let alignment;
                        switch (columnDefinition.columnType) {
                            case 'DATE':
                                inputType = 'date';
                                if (this.isValidData(data)) {
                                    inputValue = data;
                                } else {
                                    inputValue = '';
                                }
                                alignment = 'left';
                                break;
                            case 'INT':
                            case 'FLOAT':
                                inputType = 'number';
                                alignment = 'right';
                                if (columnDefinition.fieldName) {
                                    if (!this.isValidData(data)) {
                                        inputPlaceholder = placeHolder;
                                    } else {
                                        inputValue = data;
                                    }
                                } else {
                                    inputPlaceholder = placeHolder;
                                }
                                break;
                            default:
                                inputType = 'text';
                                alignment = 'left';
                                if (columnDefinition.fieldName) {
                                    if (!this.isValidData(data)) {
                                        inputPlaceholder = placeHolder;
                                    } else {
                                        inputValue = data;
                                    }
                                } else {
                                    inputPlaceholder = placeHolder;
                                }
                                break;
                        }
                        newTdHtml += `<input onchange="fieldOnChange(this)" data-pctp-model="${e.data('pctpModel')}" data-pctp-value="${inputValue ? inputValue : ''}" 
                                        class="edit-field" style="width: 100%; box-sizing: border-box; text-align: ${alignment};" 
                                        type="${inputType}" 
                                        value="${inputValue && inputType !== 'date' ? inputValue : (inputType === 'date' ? dataHtml : '')}" 
                                        ${inputPlaceholder ? 'placeholder="'+inputPlaceholder+'"' : ''}
                                    >`
                        break;
                }
                newTdHtml += `</td>`;
                e.parent().replaceWith(newTdHtml);
            }
        }
    }
    decodeHtml(html) {
        let txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }
    fieldOnchange(jElement, tab = this.getActiveTabName()) {
        let row = jElement.parent().parent();
        let data = parseDataRow(row, tab);
        this.addModifiedRow(data, tab); 
        this.renderRowFormulas(tab, row);
        this.#runObserversEvents(row, tab);
    }
    getActiveTabName() {
        return $('div.tab-pane.active').data('pctpModel');
    }
    changeFieldValueFromOtherTab(prop) {
        if (!prop.bool) return;
        const { jElement, row, tab, refField, otherTab, foreignField, field, value } = prop;
        let refValue = null;
        row.find(`*[data-pctp-model="${refField.replace(/^_/, '')}"]`).each(function(){
            refValue = ptcpWindowView.getFormattedModelValue(tab, $(this), refField);
            return false;
        })
        if (!this.hasDataTable(otherTab)) return;
        $(`#tabtbl${otherTab}`).DataTable().$('tr').each(function(){
            let hasFound = false;
            let oRow = $(this);
            oRow.find(`*[data-pctp-model="${foreignField.replace(/^_/, '')}"]`).each(function(){
                let foreignValue = ptcpWindowView.getFormattedModelValue(otherTab, $(this), foreignField);
                if (foreignValue == refValue) {
                    let targetElement = oRow.find(`*[data-pctp-model="${field.replace(/^_/, '')}"]`)
                    if (targetElement.length) {
                        if (value === 'self') {
                            targetElement = ptcpWindowView.setAnonymousElementValue(otherTab, targetElement, ptcpWindowView.getAnonymousElementValue(jElement));
                        } else {
                            targetElement = ptcpWindowView.setAnonymousElementValue(otherTab, targetElement, value);
                        }
                        ptcpWindowView.fieldOnchange(targetElement, otherTab);
                        hasFound = true;
                        ptcpWindowView.childUpdateRow.push({parent: row.data('pctpCode'), child: oRow.data('pctpCode')})
                        return false;
                    }
                    ptcpWindowView.log(`Cannot find target element with field '${field}'`);
                    return false;
                }
            })
            if (hasFound) return false;
        })
    }
    changeFieldValueFromOtherTabByFormula(prop) {
        if (!prop.bool) return;
        const { jElement, row, tab, refField, otherTab, foreignField, field, formula, useFormulaInsideRow } = prop;
        let refValue = null;
        row.find(`*[data-pctp-model="${refField.replace(/^_/, '')}"]`).each(function(){
            refValue = ptcpWindowView.getFormattedModelValue(tab, $(this), refField);
            return false;
        })
        if (!this.hasDataTable(otherTab)) return;
        $(`#tabtbl${otherTab}`).DataTable().$('tr').each(function(){
            let hasFound = false;
            let oRow = $(this);
            oRow.find(`*[data-pctp-model="${foreignField.replace(/^_/, '')}"]`).each(function(){
                let foreignValue = ptcpWindowView.getFormattedModelValue(otherTab, $(this), foreignField);
                if (foreignValue == refValue) {
                    let targetElement = oRow.find(`*[data-pctp-model="${field.replace(/^_/, '')}"]`)
                    if (targetElement.length) {
                        let value = ptcpWindowView.getFormulas(useFormulaInsideRow !== undefined && useFormulaInsideRow ? row : oRow)[formula]();
                        targetElement = ptcpWindowView.setAnonymousElementValue(otherTab, targetElement, value);
                        ptcpWindowView.fieldOnchange(targetElement, otherTab);
                        hasFound = true;
                        ptcpWindowView.childUpdateRow.push({parent: row.data('pctpCode'), child: oRow.data('pctpCode')})
                        return false;
                    }
                    ptcpWindowView.log(`Cannot find target element with field '${field}'`);
                    return false;
                }
            })
            if (hasFound) return false;
        })
    }
    promptMessage2Buttons2ReturnBools(arg) {
        ptcpWindowView.log(arg)
        const { row, title, message, button1Label, button2Label, prop, info, callback } = arg;
        let appendedProp = { row: row, ...prop };
        $('#promptTitle').html(title);
        $('#promptMessage').html(message);
        if (this.isValidData(info)) {
            $('#promptInfo').removeClass('d-none');
            $('#promptInfo').html(info);
        } else
            $('#promptInfo').addClass('d-none');
        $('#btnPrompt1').removeClass('d-none');
        $('#btnPrompt1').html(button1Label);
        $('#btnPrompt2').removeClass('d-none');
        $('#btnPrompt2').html(button2Label);
        $('#promptModal').modal('show');
        $('#btnPrompt1').off('click').click(function(){
            if (ptcpWindowView.isValidData(callback)) {
                if (Object.keys(appendedProp).length)
                    ptcpWindowView[callback]({bool: true, ...appendedProp});
                else
                    ptcpWindowView[callback](true);
            }
        });
        $('#btnPrompt2').off('click').click(function(){
            if (ptcpWindowView.isValidData(callback)) {
                if (Object.keys(appendedProp).length)
                    ptcpWindowView[callback]({bool: false, ...appendedProp});
                else
                    ptcpWindowView[callback](false);
            }
        });
    }
    promptMessage1Button(arg) {
        const { title, message, button1Label, info } = arg;
        $('#promptTitle').html(title);
        $('#promptMessage').html(message);
        if (ptcpWindowView.isValidData(info)){
            $('#promptInfo').html(info);
            $('#promptInfo').removeClass('d-none');
        }
        else {
            if (!$('#promptInfo').hasClass('d-none'))
                $('#promptInfo').addClass('d-none');
        }
        $('#btnPrompt1').removeClass('d-none');
        $('#btnPrompt1').html(button1Label);
    
        if (!$('#btnPrompt2').hasClass('d-none'))
            $('#btnPrompt2').addClass('d-none');
    
        $('#promptModal').modal('show');
    
        $('#btnPrompt1').off('click').click(function(){
            $('#promptModal').modal('hide');
            setTimeout(() => {
                $('#btnPrompt2').removeClass('d-none');
                $('#promptInfo').removeClass('d-none');
            }, 200);
        });
    }
    findTableRow(rowCode) {
        let tabName = rowCode.replace(/\d+/, '')
        return $(`#tabtbl${tabName}`).DataTable().$(`tr[data-pctp-code="${rowCode}"]`)
    }
    validateAction(actionName) {
        if (this.#actionValidations.hasOwnProperty(actionName)) {
            let filteredSapObjRows = ptcpWindowView.selectedSapObjRows.filter(s => s.includes(this.#actionValidations[actionName].structure));
            for (const filteredSapObjRow of filteredSapObjRows) {
                const [ Code, structure ] = filteredSapObjRow.split('-')
                const tableRow = this.findTableRow(Code)
                const validation = this.#actionValidations[actionName].validation;
                for (const target of validation.targets) {
                    for (const field of target.fields) {
                        let jField = tableRow.find(`*[data-pctp-model="${field.replace(/^_/, '')}"]`)
                        let fieldDataValue = this.getFormattedModelDataValue(target.tab, jField, field);
                        ptcpWindowView.log(field, fieldDataValue)
                        if (validation.invalidValues.includes(fieldDataValue)) {
                            if (validation.result !== undefined && validation.result.failed !== undefined) {
                                let failedEvent = validation.result.failed;
                                ptcpWindowView[failedEvent.callback](failedEvent.arg);
                                return false;
                            }
                        }
                    }
                }
            }
        }
        return true;
    }
    changeOtherField(arg) {
        const { row, jElement, field, value, activeTabName } = arg;
        let jOtherField = row.find(`*[data-pctp-model="${field.replace(/^_/, '')}"]`)
        if (value === 'self') {
            this.setAnonymousElementValue(activeTabName, jOtherField, this.getAnonymousElementValue(jElement));
        } else {
            this.setAnonymousElementValue(activeTabName, jOtherField, value);
        }
    }
    changeOtherFieldByFormula(arg) {
        const { row, field, formula, activeTabName } = arg;
        let jOtherField = row.find(`*[data-pctp-model="${field.replace(/^_/, '')}"]`)
        let value = this.getFormulas(row)[formula]();
        this.setAnonymousElementValue(activeTabName, jOtherField, value);
    }
    changeOtherFieldBasedOnFormerValue(arg) {
        const { row, field, formerValue, value, activeTabName } = arg;
        let jOtherField = row.find(`*[data-pctp-model="${field.replace(/^_/, '')}"]`)
        if (this.getAnonymousElementValue(jOtherField) == formerValue) this.setAnonymousElementValue(activeTabName, jOtherField, value);
    }
    deleteRowFromTable(arg) {
        const { tab, row } = arg;
        $(`#tabtbl${tab}`).DataTable()
        .row(row)
        .remove()
        .draw();
        this.refreshRowNumbers(tab);
    }
    getDateDefaultFormat(date) {
        let option = {args: {year: 'numeric', month: '2-digit', day: '2-digit'}, order: [4,0,2]};
        let dateObj = new Intl.DateTimeFormat('en-us', option.args).formatToParts(date);
        return `${dateObj[option.order[0]].value}-${dateObj[option.order[1]].value}-${dateObj[option.order[2]].value}`;
    }
    SAPDateFormater(dateLiteral) {
        let SAPDateFormat = Number(this.#constants.SAPDateFormat);
        let options = [
            {args: {year: '2-digit', month: '2-digit', day: '2-digit'}, order: [2,0,4]},
            {args: {year: 'numeric', month: '2-digit', day: '2-digit'}, order: [2,0,4]},
            {args: {year: '2-digit', month: '2-digit', day: '2-digit'}, order: [0,2,4]},
            {args: {year: 'numeric', month: '2-digit', day: '2-digit'}, order: [0,2,4]},
            {args: {year: 'numeric', month: '2-digit', day: '2-digit'}, order: [4,0,2]},
            {args: {year: 'numeric', month: 'long', day: '2-digit'}, order: [2,0,4]},
            {args: {year: '2-digit', month: '2-digit', day: '2-digit'}, order: [4,0,2]}
        ];
        dateLiteral = SAPDateFormat == 6 && dateLiteral.length == 8 ? '20'+dateLiteral : dateLiteral;
        let dateObj;
        try {
            let passDate = new Date(dateLiteral);
            if (passDate == 'Invalid Date') throw `Invalid date format. Cannot parse date value from string '${dateLiteral}'`;
            dateObj = new Intl.DateTimeFormat('en-us', options[SAPDateFormat].args).formatToParts(passDate);
        }
        catch(err) {
            throw err
        }
        return `${dateObj[options[SAPDateFormat].order[0]].value}.${dateObj[options[SAPDateFormat].order[1]].value}.${dateObj[options[SAPDateFormat].order[2]].value}`;
    }
    SQLDateFormater(dateLiteral) {
        if (dateLiteral == '') {
            return '';
        }
    
        let dateObj = new Intl.DateTimeFormat('en-us', {year: 'numeric', month: '2-digit', day: '2-digit'}).formatToParts(new Date(dateLiteral));
    
        return `${dateObj[4].value}-${dateObj[0].value}-${dateObj[2].value}`;
    }
    async apiAjax(actionName, data, callback = null) {
        const d = await $.post('../res/api.php', { action: actionName, data: data });
        try {
            ptcpWindowView.log('data-pctp-received', JSON.parse(d));
            let data_1 = JSON.parse(d);
            if (data_1.type !== undefined && data_1.type === 'error')
                throw data_1.message;
            if (data_1.result == 'success') {
                if (ptcpWindowView.isValidData(data_1.callback)) {
                    ptcpWindowView[data_1.callback](data_1.arg, callback === null ? null : () => callback());
                } else {
                    if (callback !== null) {
                        callback();
                    } else {
                        return data_1.resultData;
                    }
                }
            } else {
                if (callback !== null) {
                    callback();
                } else {
                    return data_1.resultData;
                }
            }
        } catch (error) {
            ptcpWindowView.showError(error);
            ptcpWindowView.log(error);
            ptcpWindowView.log(d);
            if (callback !== null) {
                callback();
            }
        }
    }
    refreshDataValue(jElem) {
        switch (jElem[0].localName) {
            case 'input':
                jElem.val(jElem.data('pctpValue'))
                break;
            case 'select':
                jElem.val(jElem.data('pctpValue'))
                break;
            default:
                break;
        }
    }
    refreshRowNumbers(tabName) {
        let rowNo = 0;
        $(`#tabtbl${tabName}`).DataTable().$('tr').each(function(){
            $(this).find('span.rowNo').html(++rowNo);
        })
    }
    getFormattedModelDataValue(tab, jElement, field) {
        let columnDefinition = this.#columnDefinitions[tab].filter(c => c.fieldName === field || c.fieldName === `_${field}`)[0];
        let modelDataValue = jElement.data('pctpValue');
        switch (columnDefinition.columnType) {
            case 'DATE':
                return new Date(modelDataValue) == 'Invalid Date' ? null : new Date(modelDataValue);
            case 'INT':
            case 'FLOAT':
                return Number(modelDataValue)
            default:
                return modelDataValue
        }
    }
    getFormattedModelValue(tab, jElement, field) {
        let columnDefinition = this.#columnDefinitions[tab].filter(c => c.fieldName === field || c.fieldName === `_${field}`)[0];
        let modelValue = this.getAnonymousElementValue(jElement);
        switch (columnDefinition.columnType) {
            case 'DATE':
                return new Date(modelValue) == 'Invalid Date' ? null : new Date(modelValue);
            case 'INT':
            case 'FLOAT':
                return Number(modelValue)
            default:
                return modelValue
        }
    }
    getElementModelValue(tab, jRow, field) {
        let columnDefinition = this.#columnDefinitions[tab].filter(c => c.fieldName === field || c.fieldName === `_${field}`)[0];
        let modelValue = this.getAnonymousElementValue(this.getElementModel(jRow, field));
        switch (columnDefinition.columnType) {
            case 'DATE':
                return new Date(modelValue) == 'Invalid Date' ? null : new Date(modelValue);
            case 'INT':
            case 'FLOAT':
                return Number(modelValue)
            default:
                return modelValue
        }
    }
    getElementModel(jRow, field) {
        return jRow.find(`*[data-pctp-model="${field.replace(/^_/, '')}"]`)
    }
    getAnonymousElementValue(jElement) {
        switch (jElement[0].localName) {
            case 'input':
                return jElement.val()
            case 'select':
                return jElement.find(':selected').val();
            case 'a':
            case 'span':
                return this.decodeHtml(jElement.html())
            default:
                ptcpWindowView.log(jElement.localName, jElement)
                throw 'Cannot find localName of anonymous element';
        }
    }
    setAnonymousElementValue(tab, jElement, value) {
        switch (jElement[0].localName) {
            case 'input':
            case 'select':
                jElement.val(this.formatModelValue(tab, jElement, value))
                break;
            case 'a':
            case 'span':
                jElement.html(this.formatModelValue(tab, jElement, value))
                break;
            default:
                ptcpWindowView.log(jElement, jElement.localName, value)
                throw 'Cannot find localName of anonymous element';
        }
        return jElement;
    }
    formatModelValue(tab, jElement, value) {
        let columnDefinition = this.#columnDefinitions[tab]
            .filter(c => c.fieldName === jElement.data('pctpModel') || c.fieldName === `_${jElement.data('pctpModel')}`)[0];
        this.log(tab, jElement, value, jElement.data('pctpModel'), columnDefinition)
        try {
            switch (columnDefinition.columnType) {
                case 'DATE':
                    return new Date(value) == 'Invalid Date' ? null : this.SAPDateFormater(new Date(value));
                case 'INT':
                    return Number(value)
                case 'FLOAT':
                    return this.formatAsMoney(Number(value))
                default:
                    return value
            }
        } catch (error) {
            console.log(error)
            return value
        }
    }
    renderTableRowsFormula(tabName) {
        $(`#tabtbl${tabName}`).DataTable().$('tr').each(function() {
            ptcpWindowView.renderRowFormulas(tabName, $(this));
        });
    }
    renderRowFormulas(tab, jRow) {
        jRow.find('*[data-pctp-formula]').each(function() {
            let jElement = $(this);
            let formula = jElement.data('pctpFormula');
            jElement = ptcpWindowView.setAnonymousElementValue(
                tab,
                jElement,
                ptcpWindowView.getFormulas(jRow)[formula]()
            )
        })
    }
    unselectTableRow(jTableRow, jCheckRow = null) {
        jTableRow.removeClass('selected')
        jTableRow.find('td').each(function(){
            $(this).css('background-color', ptcpWindowView.viewOptions.td_background_color)
        })
        if (jCheckRow !== null) jCheckRow.prop('checked', false);
    }
    formatAsMoney(amount){
        amount = String(amount).replaceAll(',', '');
        if (amount === NaN || isNaN(amount)) ptcpWindowView.log(`Cannot parse float from '${amount}'`);
        return accounting.formatMoney(Number(amount), '', this.#constants['SAPPriceDecimal']);
    }
    getValueFromOtherTab(jRow, otherTab, fieldName, ownField, foreignField) {
        let tab = jRow.data('pctpCode').replace(/\d+/, '');
        let commonFieldValue = this.getElementModelValue(tab, jRow, ownField);
        let fElement = null;
        $(`#tabtbl${otherTab}`).DataTable.$(`tr *[data-pctp-model="${foreignField}"]`).each(function(){
            if (ptcpWindowView.getAnonymousElementValue($(this)) == commonFieldValue) {
                fElement = $(this);
                return false;
            }
        })
        if (this.isValidData(fElement)) {
            return this.getFormattedModelValue(otherTab, fElement, fieldName)
        }
        ptcpWindowView.log(`element with data '${foreignField}' not found`);
        return null
    }
    getFormulas(jRow) {
        return {
            jRow: jRow,
            oneDayInMs: 24 * 60 * 60 * 1000,
            getValue: function(fieldName) {
                let tab = this.jRow.data('pctpCode').replace(/\d+/, '');
                return ptcpWindowView.getElementModelValue(tab, this.jRow, fieldName)
            },
            getConstant: function(constantName) {
                let constant = ptcpWindowView.#constants[constantName].filter(c => c.Code === this.jRow.data('pctpCode'));
                if (!constant.length) constant = ptcpWindowView.#constants[constantName].filter(c => c.subCode1 !== undefined && c.subCode1 === this.jRow.data('pctpCode'));
                if (!constant.length) constant = ptcpWindowView.#constants[constantName].filter(c => c.subCode2 !== undefined && c.subCode2 === this.jRow.data('pctpCode'));
                if (!constant.length) throw `Cannot find constant '${constantName}' of ${this.jRow.data('pctpCode')}`;
                return constant[0];
            },
            getDateDiffInDays(date1, date2) {
                if (!ptcpWindowView.isValidData(date1) || !ptcpWindowView.isValidData(date2)) return 0;
                return Math.round((date1 - date2) / this.oneDayInMs);
            },
            _ClientSubStatus: function() {
                let ClientReceivedDate = this.getValue('ClientReceivedDate')
                return ptcpWindowView.isValidData(ClientReceivedDate) ? 'SUBMITTED' : 'PENDING';
            },
            _ClientSubOverdue: function() {
                let DeliveryDateDTR = this.getValue('DeliveryDateDTR')
                let ClientReceivedDate = this.getValue('ClientReceivedDate')
                return this.getDateDiffInDays(DeliveryDateDTR, ClientReceivedDate) + Number(this.getConstant('CDC_DCD').CDC);
            },
            _ClientPenaltyCalc: function() {
                let ClientSubOverdue = this._ClientSubOverdue(jRow);
                return ClientSubOverdue < 0 ? ClientSubOverdue * 200.00 : 0;
            },
            _PODStatusPayment: function() {
                let OverdueDays = this._OverdueDays();
                if (OverdueDays >= 0) {
                    return 'Ontime';
                } else if (OverdueDays > -13 && OverdueDays < 0) {
                    return 'Late';
                }
                return 'Lost';
            },
            _OverdueDays: function() {
                let InitialHCRecDate = this.getValue('InitialHCRecDate')
                let DeliveryDateDTR = this.getValue('DeliveryDateDTR')
                if (!ptcpWindowView.isValidData(InitialHCRecDate) && ptcpWindowView.isValidData(DeliveryDateDTR)) {
                    return this.getDateDiffInDays(new Date(), DeliveryDateDTR + Number(this.getConstant('CDC_DCD').CDC));
                } else if (ptcpWindowView.isValidData(InitialHCRecDate) && ptcpWindowView.isValidData(DeliveryDateDTR)) {
                    return this.getDateDiffInDays(InitialHCRecDate, DeliveryDateDTR + Number(this.getConstant('CDC_DCD').CDC));
                }
                return 0;
            },
            _InteluckPenaltyCalc: function() {
                switch (this._PODStatusPayment()) {
                    case 'Ontime':
                        return 0;
                    case 'Late':
                        let OverdueDays = this._OverdueDays();
                        return OverdueDays < 0 ? OverdueDays * 200 : 0;
                    case 'Lost':
                        return 0;
                    default:
                        break;
                }
            },
            _LostPenaltyCalc: function() {
                if (this._PODStatusPayment() === 'Lost') return ptcpWindowView.getValueFromOtherTab(this.jRow, 'pricing', 'TotalInitialTruckers', 'BookingNumber', 'BookingId') * 2;
                return 0;
            },
            _TotalSubPenalties: function() {
                return this._ClientPenaltyCalc() + this._InteluckPenaltyCalc() + this._LostPenaltyCalc();
            },
            _TotalPenaltyWaived: function() {
                return this._TotalSubPenalties() - (this.getValue('PercPenaltyCharge') * this._TotalSubPenalties());
            },
            _PODSubmitDeadline: function() {
                try {
                    let DeliveryDateDTR = this.getValue('DeliveryDateDTR');
                    DeliveryDateDTR.setDate(DeliveryDateDTR.getDate() + Number(this.getConstant('CDC_DCD').CDC));
                    ptcpWindowView.log(DeliveryDateDTR)
                    return ptcpWindowView.SAPDateFormater(ptcpWindowView.getDateDefaultFormat(DeliveryDateDTR))
                } catch (error) {
                    ptcpWindowView.log(error)
                    return '';
                }
            },
            _GrossProfit: function() {
                let GrossTruckerRates = this.getValue('GrossTruckerRates');
                let GrossClientRates = this.getValue('GrossClientRates');
                return GrossClientRates - GrossTruckerRates;
            },
            _TotalInitialClient: function() {
                let GrossClientRates = this.getValue('GrossClientRates');
                let Demurrage = this.getValue('Demurrage');
                let AddtlCharges2 = this.getValue('AddtlCharges2');
                return GrossClientRates + Demurrage + AddtlCharges2;
            },
            _TotalInitialTruckers: function() {
                let GrossTruckerRates = this.getValue('GrossTruckerRates');
                let Demurrage2 = this.getValue('Demurrage2');
                let AddtlCharges = this.getValue('AddtlCharges');
                return GrossTruckerRates + Demurrage2 + AddtlCharges;
            },
            _TotalGrossProfit: function() {
                return this._TotalInitialTruckers() - this._TotalInitialClient();
            },
            _GrossClientRatesTax: function() {
                let GrossClientRates = this.getValue('GrossClientRates');
                if (this.getConstant('TaxType').TaxTypeClient === 'Y') {
                    return GrossClientRates
                } else {
                    return GrossClientRates/1.12
                }
            },
            _GrossTruckerRatesTax: function() {
                let GrossTruckerRates = this.getValue('GrossTruckerRates');
                if (this.getConstant('TaxType').TaxTypeTrucker === 'Y') {
                    return GrossTruckerRates
                } else {
                    return GrossTruckerRates/1.12
                }
            },
            _Demurrage4: function() {
                let Demurrage = this.getValue('Demurrage');
                if (this.getConstant('TaxType').TaxTypeClient === 'Y') {
                    return Demurrage
                } else {
                    return Demurrage/1.12
                }
            },
            _Demurrage3: function() {
                let Demurrage2 = this.getValue('Demurrage2');
                if (this.getConstant('TaxType').TaxTypeTrucker === 'Y') {
                    return Demurrage2
                } else {
                    return Demurrage2/1.12
                }
            },
            _TotalAddtlCharges: function() {
                let AddtlDrop = this.getValue('AddtlDrop');
                let BoomTruck = this.getValue('BoomTruck');
                let Manpower = this.getValue('Manpower');
                let Backload = this.getValue('Backload');
                return AddtlDrop + BoomTruck + Manpower + Backload;
            },
            _AddtlCharges2: function() {
                let _TotalAddtlCharges = this._TotalAddtlCharges();
                if (this.getConstant('TaxType').TaxTypeClient === 'Y') {
                    return _TotalAddtlCharges
                } else {
                    return _TotalAddtlCharges/1.12
                }
            },
            _totalAddtlCharges2: function() {
                let AddtlDrop2 = this.getValue('AddtlDrop2');
                let BoomTruck2 = this.getValue('BoomTruck2');
                let Manpower2 = this.getValue('Manpower2');
                let Backload2 = this.getValue('Backload2');
                return AddtlDrop2 + BoomTruck2 + Manpower2 + Backload2;
            },
            _AddtlCharges: function() {
                let _totalAddtlCharges2 = this._totalAddtlCharges2();
                if (this.getConstant('TaxType').TaxTypeTrucker === 'Y') {
                    return _totalAddtlCharges2
                } else {
                    return _totalAddtlCharges2/1.12
                }
            },
            field: function() {

            },
        };
    }
    log(...optionalParams) {
        if (this.#viewOptions.enable_test_logging || this.#viewOptions.enable_test_logging === undefined) console.log(...optionalParams);
    }
}

async function progressBar(count, fullCount, customText = '', withPresetText = true) {
    let progressBar = $('#progressBar');
    let progressText = $('#progressText');
    progressBar.css('width', (count/fullCount) * 100 + '%');
    if (withPresetText)
        progressText.html(customText + '  -  ADDING  ' + count + '  OUT OF  ' + fullCount);
    else
        progressText.html(customText + ' ' + Math.floor((count/fullCount) * 100) + '%');
}

function prepProgressBar(){
    $('#btnPost').attr('disabled', true);
    $('#btnBrowse').attr('disabled', true);
    $('#btnCancel').attr('disabled', true);
    $('#messageBar2').addClass('d-none');
    $('#progressDiv').removeClass('d-none');
}

function remProgressBar(){
    $('#btnBrowse').removeAttr('disabled');
    $('#btnCancel').removeAttr('disabled');
    $('#messageBar2').removeClass('d-none');
    $('#progressDiv').addClass('d-none');
}

function portalMessage(message, bgColor, textColor, timeoutms = 5000){
    $('#messageBar2').addClass('d-none');
    $('#messageBar3').removeClass('d-none');
    $('#messageBar').text(message).css({'background-color': bgColor, 'color': textColor});
    if (timeoutms > 0) setTimeout(() => ptcpWindowView.hidePortalMessage(), timeoutms)
}

function promptMessage1Button(title, message, button1Label, info = '') {
    $('#promptTitle').html(title);
    $('#promptMessage').html(message);
    if (info !== ''){
        $('#promptInfo').html(info);
        $('#promptInfo').removeClass('d-none');
    }
    else {
        if (!$('#promptInfo').hasClass('d-none'))
            $('#promptInfo').addClass('d-none');
    }
    $('#btnPrompt1').removeClass('d-none');
    $('#btnPrompt1').html(button1Label);

    if (!$('#btnPrompt2').hasClass('d-none'))
        $('#btnPrompt2').addClass('d-none');

    $('#promptModal').modal('show');

    $('#btnPrompt1').off('click').click(function(){
        $('#promptModal').modal('hide');
        setTimeout(() => {
            $('#btnPrompt2').removeClass('d-none');
            $('#promptInfo').removeClass('d-none');
        }, 200);
    });
}

const ptcpWindowView =  new PtcpWindowView();