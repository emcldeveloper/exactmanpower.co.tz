@extends('account')

@section('title', 'Notification')

@section('content')

@include('accounts.accounts.navigation')

<div class="card border-0 p-4">
    <div class="text-center">
        <h4>NOTIFICATIN SETTING</h4>
        <h5 class="text-primary">Select the notificatin you would like to receive</h5>
    </div>
</div>

<form method="POST" action="{{ url('account/setting/notification') }}">
    {{ csrf_field() }}
    <div class="row m-0 bg-white">
        <div class="col-12 col-lg-6 p-0">
            <!----- Start form field email ----->
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Abuse reported on ads you've anquired</label>
                <div class="bg-light py-2 px-4">
                    <div class="custom-control custom-checkbox">
                        <input name="is_ads_anquired_abused_email" {{ ($setting_model->is_ads_anquired_abused_email)? 'checked':null }} type="checkbox" class="custom-control-input" id="is_ads_anquired_abused_email">
                        <label class="custom-control-label" for="is_ads_anquired_abused_email">Email</label>
                    </div>
                </div>
            </div>
            <!----- End form field email ----->
        </div>

        <div class="col-12 col-lg-6 p-0">
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Business approval</label>
                <div class="bg-light py-2 px-4">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input name="is_business_approved_email" {{ ($setting_model->is_business_approved_email)? 'checked':null }} type="checkbox" class="custom-control-input" id="is_business_approved_email">
                                <label class="custom-control-label" for="is_business_approved_email">Email</label>
                            </div>
                        </div>
                        <div class="col col-lg-8 col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_business_approved_telegram" {{ ($setting_model->is_business_approved_telegram)? 'checked':null }} class="custom-control-input" id="is_business_approved_telegram">
                                <label class="custom-control-label" for="is_business_approved_telegram">Telegram</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row m-0 bg-white">
        <div class="col-12 col-lg-6 p-0">
            <!----- Start form field email ----->
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Credits added to your account</label>
                <div class="bg-light py-2 px-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_credit_added_email" {{ ($setting_model->is_credit_added_email)? 'checked':null }} class="custom-control-input" id="is_credit_added_email ">
                        <label class="custom-control-label" for="is_credit_added_email ">Email</label>
                    </div>
                </div>
            </div>
            <!----- End form field email ----->
        </div>

        <div class="col-12 col-lg-6 p-0">
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Email Rejected</label>
                <div class="bg-light py-2 px-4">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_email_rejected_email" {{ ($setting_model->is_email_rejected_email)? 'checked':null }} class="custom-control-input" id="is_email_rejected_email">
                                <label class="custom-control-label" for="is_email_rejected_email">Email</label>
                            </div>
                        </div>
                        <div class="col col-lg-8 col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_email_rejected_telegram" {{ ($setting_model->is_email_rejected_telegram)? 'checked':null }} class="custom-control-input" id="is_email_rejected_telegram">
                                <label class="custom-control-label" for="is_email_rejected_telegram">Telegram</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row m-0 bg-white">
        <div class="col-12 col-lg-6 p-0">
            <!----- Start form field email ----->
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Draft ad remainders</label>
                <div class="bg-light py-2 px-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_draft_ads_remainder_email" {{ ($setting_model->is_draft_ads_remainder_email)? 'checked':null }} class="custom-control-input" id="is_draft_ads_remainder_email">
                        <label class="custom-control-label" for="is_draft_ads_remainder_email">Email</label>
                    </div>
                </div>
            </div>
            <!----- End form field email ----->
        </div>

        <div class="col-12 col-lg-6 p-0">
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Enquires on your ads</label>
                <div class="bg-light py-2 px-4">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_ads_enquire_sms" {{ ($setting_model->is_ads_enquire_sms)? 'checked':null }} class="custom-control-input" id="is_ads_enquire_sms">
                                <label class="custom-control-label" for="is_ads_enquire_sms">SMS</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_ads_enquire_email" {{ ($setting_model->is_ads_enquire_email)? 'checked':null }} class="custom-control-input" id="is_ads_enquire_email">
                                <label class="custom-control-label" for="is_ads_enquire_email">Email</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_ads_enquire_telegram" {{ ($setting_model->is_ads_enquire_telegram)? 'checked':null }} class="custom-control-input" id="is_ads_enquire_telegram">
                                <label class="custom-control-label" for="is_ads_enquire_telegram">Telegram</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row m-0 bg-white">
        <div class="col-12 col-lg-12 p-0">
            <!----- Start form field email ----->
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Types Horizon \ Broadcasting \ Notications \ Report \ Listing Performance Description</label>
                <div class="bg-light py-2 px-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_other_notifired_email" {{ ($setting_model->is_other_notifired_email)? 'checked':null }} class="custom-control-input" id="is_other_notifired_email">
                        <label class="custom-control-label" for="is_other_notifired_email">Email</label>
                    </div>
                </div>
            </div>
            <!----- End form field email ----->
        </div>
    </div>

    <div class="row m-0 bg-white">
        <div class="col-12 col-lg-6 p-0">
            <!----- Start form field email ----->
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Email changed confirmation</label>
                <div class="bg-light py-2 px-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_email_changed_confirm_email" {{ ($setting_model->is_email_changed_confirm_email)? 'checked':null }} class="custom-control-input" id="is_email_changed_confirm_email">
                        <label class="custom-control-label" for="is_email_changed_confirm_email">Email</label>
                    </div>
                </div>
            </div>
            <!----- End form field email ----->
        </div>

        <div class="col-12 col-lg-6 p-0">
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Email verification reminder</label>
                <div class="bg-light py-2 px-4">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_email_verification_remainder_email" {{ ($setting_model->is_email_verification_remainder_email)? 'checked':null }} class="custom-control-input" id="is_email_verification_remainder_email">
                                <label class="custom-control-label" for="is_email_verification_remainder_email">Email</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row m-0 bg-white">
        <div class="col-12 col-lg-12 p-0">
            <!----- Start form field email ----->
            <div class="form-group">
                <label class="d-block px-4 mb-1" for="email">Password changed confirmation</label>
                <div class="bg-light py-2 px-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_password_changed_confirm_email" {{ ($setting_model->is_password_changed_confirm_email)? 'checked':null }} class="custom-control-input" id="is_password_changed_confirm_email">
                        <label class="custom-control-label" for="is_password_changed_confirm_email">Email</label>
                    </div>
                </div>
            </div>
            <!----- End form field email ----->
        </div>

    </div>

    <div class="bg-white p-4">
        <button type="submit" class="btn btn-primary btn-block mt-1 mb-3">Update Notifications</button>
    </div>
</form>

@endsection
