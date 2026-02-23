<h4 class="pb-2 pt-3">Account & Profile</h4>
<div class="card border-0 mb-4"> 
    <div class="btn-group">
        <a href="{{ url('account/setting/profile') }}" class="btn {{ (Request::is('account') || Request::is('account/setting/profile'))? 'btn-light': null }} px-4">Profile</a>
        <a href="{{ url('account/setting/account') }}" class="btn {{ Request::is('account/setting/account')? 'btn-light': null }} px-4">Account</a>
        <a href="{{ url('account/setting/notification') }}" class="btn {{ Request::is('account/setting/notification')? 'btn-light': null }} px-4">Notification</a>
    </div>
</div>