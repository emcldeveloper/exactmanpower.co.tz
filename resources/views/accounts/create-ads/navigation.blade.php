<style>
.btn-circle.btn-lg, 
.btn-group-lg > .btn-circle.btn {
    width: 3.6rem;
    height: 3.6rem;
    line-height: 1.5 !important;
}

.step {
    border-bottom: 3px solid transparent;
}

.step.active, 
.active .step {
    border-color: #ff8000;
}

.step .btn * {
    font-size: 1.5rem;
    line-height: 1.3;
}

.step.active .btn, 
.active .step .btn {
    color: #ffffff;
    background: #ff8000;
}
</style>

<h4 class="pb-2 pt-3 mb-3">Create an ad</h4>
<div class="clearfix"> 
    <div class="row m-0" style="height:100px;">
        <div class="col text-center p-0 active">
            <div class="clearfix h-100 step">
                <div class="btn btn-light btn-lg btn-circle">
                    <i class="icon-select-category"></i>
                </div>
            </div>
        </div>
        <div class="col text-center p-0 {{ (Request::is('*/details') || Request::is('*/details/*')  || Request::is('*/photos/*') || Request::is('*/package/*') || Request::is('*/congratulation/*') || Request::is('*/payment/*'))? 'active': null }}">
            <div class="clearfix h-100 step">
                <div class="btn btn-light btn-lg btn-circle">
                    <i class="icon-Create-Ads"></i>
                </div>
            </div>
        </div>
        <div class="col text-center p-0 {{ (Request::is('*/photos/*') || Request::is('*/package/*') || Request::is('*/congratulation/*') || Request::is('*/payment/*'))? 'active': null }}">
            <div class="clearfix h-100 step">
                <div class="btn btn-light btn-lg btn-circle">
                    <i class="icon-Photo"></i>
                </div>
            </div>
        </div>
        <div class="col text-center p-0  {{ (Request::is('*/package/*') || Request::is('*/congratulation/*') || Request::is('*/payment/*'))? 'active': null }}">
            <div class="clearfix h-100 step">
                <div class="btn btn-light btn-lg btn-circle">
                    <i class="icon-Package"></i>
                </div>
            </div>
        </div>
        <div class="col text-center p-0 {{ (Request::is('*/congratulation/*') || Request::is('*/payment/*'))? 'active': null }}">
            <div class="clearfix h-100 step">
                <div class="btn btn-light btn-lg btn-circle">
                    <i class="icon-Complete"></i>
                </div>
            </div>
        </div>
    </div>
</div>