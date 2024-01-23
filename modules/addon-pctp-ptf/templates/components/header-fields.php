<div class="row d-flex pr-0 pb-2"  width="100%">
    <div class="col-6">
        <?php $labelColumnSize = 2 ?>
        <?php $fieldColumnSize = 10 ?>
        <div class="row d-flex">
            <div class="col-<?= $labelColumnSize ?>">
                <label for="txtfind" class="col-form-label" style="color: black;">FIND</label>
            </div>
            <div class="col-<?= $fieldColumnSize ?> align-self-start">
                <input type="search" id="txtfind" style="width: 100%;" data-pctp-header="findText" placeholder="Search here..." 
                    title="This will search all the alphanumeric fields of the current tab.">
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-<?= $labelColumnSize ?>">
                <label class="col-form-label" style="color: black;">BOOKING DATE</label>
            </div>
            <div class="col-<?= $fieldColumnSize ?>">
                <div class="row d-flex">
                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col-auto text-right">
                                <label for="txtfrombookingdate" class="col-form-label" style="color: black;">FROM</label>
                            </div>
                            <div class="col-6">
                                <input type="date" id="txtfrombookingdate" style="width: 100%;" data-pctp-header="bookingDateFrom">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col-auto text-right">
                                <label for="txttobookingdate" class="col-form-label" style="color: black;">TO</label>
                            </div>
                            <div class="col-6">
                                <input type="date" id="txttobookingdate" style="width: 100%;" data-pctp-header="bookingDateTo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-<?= $labelColumnSize ?>">
                <label class="col-form-label" style="color: black;">DELIVERY DATE</label>
            </div>
            <div class="col-<?= $fieldColumnSize ?>">
                <div class="row d-flex">
                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col-auto text-right">
                                <label for="txtfromdeliverydate" class="col-form-label" style="color: black;">FROM</label>
                            </div>
                            <div class="col-6">
                                <input type="date" id="txtfromdeliverydate" style="width: 100%;" data-pctp-header="deliveryDateFrom">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col-auto text-right">
                                <label for="txttodeliverydate" class="col-form-label" style="color: black;">TO</label>
                            </div>
                            <div class="col-6">
                                <input type="date" id="txttodeliverydate" style="width: 100%;" data-pctp-header="deliveryDateTo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-<?= $labelColumnSize ?>">
                <label for="txtclienttag" class="col-form-label" style="color: black;">CLIENT TAG</label>
            </div>
            <div class="col-<?= $fieldColumnSize ?> align-self-start">
                <input type="search" id="txtclienttag" style="width: 100%;" data-pctp-header="clientTag" placeholder="Type client tag...">
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-<?= $labelColumnSize ?>">
                <label for="txttruckertag" class="col-form-label" style="color: black;">TRUCKER TAG</label>
            </div>
            <div class="col-<?= $fieldColumnSize ?> align-self-start">
                <input type="search" id="txttruckertag" style="width: 100%;" data-pctp-header="truckerTag" placeholder="Type trucker tag...">
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-<?= $labelColumnSize ?>">
                <label for="seldeliverystatus" class="col-form-label" style="color: black;">DELIVERY STATUS</label>
            </div>
            <div class="col-<?= $fieldColumnSize ?> align-self-start">
                <select id="seldeliverystatus" style="width: 100%;" data-pctp-header="deliveryStatusOptions" data-pctp-options="deliveryStatusOptions">
                    <option value="" style="display: none;" disabled selected>Select...</option>
                    <option value="">Any</option>
                </select>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-<?= $labelColumnSize ?>">
                <label for="selpodstatus" class="col-form-label" style="color: black;">POD Status</label>
            </div>
            <div class="col-<?= $fieldColumnSize ?> align-self-start">
                <select id="selpodstatus" style="width: 100%;" data-pctp-header="podStatusOptions" data-pctp-options="podStatusOptions">
                    <option value="" style="display: none;" disabled selected>Select...</option>
                    <option value="">Any</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-1">
        <div class="row d-flex">
            <div class="col">
                <button type="button" data-pctp-action="find" id="btnfind" class="btn btn-warning btn-rounded" style="color: black; font-weight: bold; width:100%; height:30px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">FIND</button>
            </div>
        </div>
    </div>
</div>