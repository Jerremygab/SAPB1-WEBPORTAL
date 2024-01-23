<div class="row d-flex align-items-center mt-5">
    <div class="col-12">
        <ul class="nav nav-tabs pt-2" id="pctpwindowtabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="summarytab" data-toggle="tab" href="#summarytabpane" role="tab" aria-controls="summarytabpane"
                aria-selected="true" style="color: black; font-weight:bold">
                    <div class="row">
                        <div class="col-auto">SUMMARY</div>
                        <div id="summaryloading" class="col-auto text-right loading ml-auto">
                            <span><i class="fas fa-spinner fa-pulse fa-lg" style="color: blue;"></i></span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="podtab" data-toggle="tab" href="#podtabpane" role="tab" aria-controls="podtabpane"
                aria-selected="false" style="color: black; font-weight:bold">
                    <div class="row">
                        <div class="col-auto">POD</div>
                        <div id="podloading" class="col-auto text-right loading ml-auto">
                            <span><i class="fas fa-spinner fa-pulse fa-lg" style="color: blue;"></i></span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="billingtab" data-toggle="tab" href="#billingtabpane" role="tab" aria-controls="billingtabpane"
                aria-selected="false" style="color: black; font-weight:bold">
                    <div class="row">
                        <div class="col-auto">BILLING</div>
                        <div id="billingloading" class="col-auto text-right loading ml-auto">
                            <span><i class="fas fa-spinner fa-pulse fa-lg" style="color: blue;"></i></span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tptab" data-toggle="tab" href="#tptabpane" role="tab" aria-controls="tptabpane"
                aria-selected="false" style="color: black; font-weight:bold">
                    <div class="row">
                        <div class="col-auto">TP</div>
                        <div id="tploading" class="col-auto text-right loading ml-auto">
                            <span><i class="fas fa-spinner fa-pulse fa-lg" style="color: blue;"></i></span>
                        </div>	
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pricingtab" data-toggle="tab" href="#pricingtabpane" role="tab" aria-controls="pricingtabpane"
                aria-selected="false" style="color: black; font-weight:bold">
                    <div class="row">
                        <div class="col-auto">PRICING</div>
                        <div id="pricingloading" class="col-auto text-right loading ml-auto">
                            <span><i class="fas fa-spinner fa-pulse fa-lg" style="color: blue;"></i></span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="treasurytab" data-toggle="tab" href="#treasurytabpane" role="tab" aria-controls="treasurytabpane"
                aria-selected="false" style="color: black; font-weight:bold">
                    <div class="row">
                        <div class="col-auto">TREASURY</div>
                        <div id="treasuryloading" class="col-auto text-right loading ml-auto">
                            <span><i class="fas fa-spinner fa-pulse fa-lg" style="color: blue;"></i></span>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<div id="resultDiv" class="tab-content col-12 p-0 m-0">
    <div class="tab-pane fade show active scrollableDiv" data-pctp-model="summary" id="summarytabpane" role="tabpanel" aria-labelledby="summarytabpane" style="min-height: 0px; max-height: 750px; overflow: auto;">
        <div id="summarytabpaneloading" style="padding-top: 10px;" class="text-center"><h4>LOADING ROWS PLEASE WAIT...</h4></div>
        <div id="summarytabpanecontent" style="white-space: nowrap;" class="text-center d-none">
        </div>
    </div>
    <div class="tab-pane fade scrollableDiv" data-pctp-model="pod" id="podtabpane" role="tabpanel" aria-labelledby="podtabpane" style="min-height: 0px; max-height: 750px; overflow: auto;">
        <div id="podtabpaneloading" style="padding-top: 10px;" class="text-center"><h4>LOADING ROWS PLEASE WAIT...</h4></div>
        <div id="podtabpanecontent" style="white-space: nowrap;" class="text-center d-none">
        </div>
    </div>
    <div class="tab-pane fade scrollableDiv" data-pctp-model="billing" id="billingtabpane" role="tabpanel" aria-labelledby="billingtabpane" style="min-height: 0px; max-height: 750px; overflow: auto;">
        <div id="billingtabpaneloading" style="padding-top: 10px;" class="text-center"><h4>LOADING ROWS PLEASE WAIT...</h4></div>
        <div id="billingtabpanecontent" style="white-space: nowrap;" class="text-center d-none">
        </div>
    </div>
    <div class="tab-pane fade scrollableDiv" data-pctp-model="tp" id="tptabpane" role="tabpanel" aria-labelledby="tptabpane" style="min-height: 0px; max-height: 750px; overflow: auto;">
        <div id="tptabpaneloading" style="padding-top: 10px;" class="text-center"><h4>LOADING ROWS PLEASE WAIT...</h4></div>
        <div id="tptabpanecontent" style="white-space: nowrap;" class="text-center d-none">
        </div>
    </div>
    <div class="tab-pane fade scrollableDiv" data-pctp-model="pricing" id="pricingtabpane" role="tabpanel" aria-labelledby="pricingtabpane" style="min-height: 0px; max-height: 750px; overflow: auto;">
        <div id="pricingtabpaneloading" style="padding-top: 10px;" class="text-center"><h4>LOADING ROWS PLEASE WAIT...</h4></div>
        <div id="pricingtabpanecontent" style="white-space: nowrap;" class="text-center d-none">
        </div>
    </div>
    <div class="tab-pane fade scrollableDiv" data-pctp-model="treasury" id="treasurytabpane" role="tabpanel" aria-labelledby="treasurytabpane" style="min-height: 0px; max-height: 750px; overflow: auto;">
        <div id="treasurytabpaneloading" style="padding-top: 10px;" class="text-center"><h4>LOADING ROWS PLEASE WAIT...</h4></div>
        <div id="treasurytabpanecontent" style="white-space: nowrap;" class="text-center d-none">
        </div>
    </div>
</div>