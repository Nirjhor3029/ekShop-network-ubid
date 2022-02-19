@extends('backend.layouts.admin')
<?php
$themePath = asset('theme/');
?>
@section('title')
    Role Create - Admin Panel
@endsection
@section('styles')
    <style>
    </style>
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">SMS - Send</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.sms.send.page') }}">Messaging</a></li>
                        <li class="breadcrumb-item active">Send SMS</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('admin-content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-12 col-sm-8">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                        href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                        aria-selected="true">Send SMS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                                        aria-selected="false">Group Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                        href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages"
                                        aria-selected="false">Dynamic SMS</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings"
                                        aria-selected="false">Settings</a>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                {{-- Send SMS --}}
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-home-tab">
                                    <form action="#" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required">Sender ID</label>
                                                    <select class="form-control select2" style="width: 100%;">
                                                        <option value="null" selected="selected" disabled>Select sender ID
                                                        </option>
                                                        <option value="{1}">Aspire BD</option>
                                                        <option value="{1}">Apire It</option>
                                                        <option value="{1}">016xxxxxxxx</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <!-- /.form-group -->
                                                <div class="form-group">
                                                    <label>Textarea</label>
                                                    <textarea class="form-control" rows="8"
                                                        placeholder="8801800000000"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>
                                                        Enter SMS Content * Use Template
                                                        (<a href="javascript:void(0)">বাংলা লিখতে এখানে ক্লিক করুন</a>)
                                                    </label>
                                                    <textarea class="form-control" rows="8" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>
                                                        Schedule SMS
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="send_now" name="sms_schedule" checked=""
                                                                value="send_now">
                                                            <label for="send_now">
                                                                Send Now
                                                            </label>
                                                        </div>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="send_later" name="sms_schedule"
                                                                value="send_later">
                                                            <label for="send_later">
                                                                Send Later
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group" id="datetime_sms_schedule_div"
                                                    style="display: none">
                                                    <label>Date and time:</label>
                                                    <div class="input-group date reservationdatetime"
                                                        id="datetime_sms_schedule" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input"
                                                            data-target="#datetime_sms_schedule" />
                                                        <div class="input-group-append" data-target="#datetime_sms_schedule"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <!-- /.form group -->
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>
                                                        Campaign Title
                                                    </label>
                                                    <input type="text" class="form-control" name="campaign_name" id=""
                                                        placeholder="Campaign Name">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                    <button type="reset" class="btn btn-danger">
                                                        reset
                                                    </button>
                                                </div>

                                            </div>

                                            <!-- /.col -->

                                        </div>
                                    </form>
                                </div>

                                {{-- Group Contancts --}}
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-profile-tab">
                                    <form action="#" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required">Sender ID</label>
                                                    <select class="form-control select2" style="width: 100%;">
                                                        <option value="null" selected="selected" disabled>Select sender ID
                                                        </option>
                                                        <option value="{1}">Aspire BD</option>
                                                        <option value="{1}">Apire It</option>
                                                        <option value="{1}">016xxxxxxxx</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required"> Select Contact Group </label>
                                                    <select class="form-control select2" style="width: 100%;">
                                                        <option value="null" selected="selected" disabled>
                                                            Contact Group
                                                        </option>
                                                        <option value="{1}">Bankers</option>
                                                        <option value="{1}">Immigrations</option>
                                                        <option value="{1}">ekShop </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <!-- /.form-group -->
                                                <div class="form-group">
                                                    <label>Textarea</label>
                                                    <textarea class="form-control" rows="8"
                                                        placeholder="8801800000000"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>
                                                        Enter SMS Content * Use Template
                                                        (<a href="javascript:void(0)">বাংলা লিখতে এখানে ক্লিক করুন</a>)
                                                    </label>
                                                    <textarea class="form-control" rows="8" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>
                                                        Schedule SMS
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="group_send_now"
                                                                name="group_sms_schedule" checked="" value="group_send_now">
                                                            <label for="group_send_now">
                                                                Send Now
                                                            </label>
                                                        </div>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="group_send_later"
                                                                name="group_sms_schedule" value="group_send_later">
                                                            <label for="group_send_later">
                                                                Send Later
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group" id="group_sms_schedule_div"
                                                    style="display: none">
                                                    <label>Date and time:</label>
                                                    <div class="input-group date reservationdatetime"
                                                        id="group_sms_schedule" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input"
                                                            data-target="#group_sms_schedule" />
                                                        <div class="input-group-append" data-target="#group_sms_schedule"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <!-- /.form group -->
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>
                                                        Campaign Title
                                                    </label>
                                                    <input type="text" class="form-control" name="campaign_name" id=""
                                                        placeholder="Campaign Name">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                    <button type="reset" class="btn btn-danger">
                                                        reset
                                                    </button>
                                                </div>

                                            </div>

                                            <!-- /.col -->

                                        </div>
                                    </form>

                                </div>

                                {{-- Dynamic SMS --}}
                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-messages-tab">
                                    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus
                                    volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce
                                    nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue
                                    ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur
                                    eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur,
                                    ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex
                                    vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus.
                                    Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                </div>

                                {{-- <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-settings-tab">
                                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus
                                    turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis
                                    vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum
                                    pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget
                                    aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac
                                    habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                </div> --}}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card card-danger card-tabs">
                        <div class="card-header p-0 pt-1 title-center">
                            Note for Masking SMS
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>For Bangla/Unicode: Max 315 Character...</li>
                                <li>Text with Emoji Will count as Unicode Content</li>
                            </ul>
                            <h4>Number format</h4>
                            <p>88017xxxxxxxx</p>
                            <p>017xxxxxxxx</p>
                            <p>17xxxxxxxx</p>

                            <h4 class="">SMS Recipient</h4>
                            <p>
                                Before doing any campaign we recommend you to do a testing with the sender id to your number
                                to ensure the sender id is working fine.
                            </p>

                            <h4>SMS Content</h4>
                            <ul>
                                <li>1 Text (English: 160 and Bangla: 70 Character)</li>
                                <li>2 or more Text (English: 153 X n and Bangla: 67 X n Character)</li>
                            </ul>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    {{-- @include('backend.pages.roles.partials.scripts') --}}
    <script>
        $(document).ready(function() {
            //Date and time picker
            $('#datetime_sms_schedule').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });
            // datetime_sms_schedule_div
            $('input[name="sms_schedule"]').on('change', function() {
                let datetime_sms_schedule_div = $("#datetime_sms_schedule_div");
                if ($(this).val() === "send_later") {
                    datetime_sms_schedule_div.show();
                    datetime_sms_schedule_div.find("input").attr('required', true);
                } else {
                    datetime_sms_schedule_div.hide();
                    datetime_sms_schedule_div.find("input").attr('required', false);
                }
                // console.log($(this).val());
            });

            // Group
            $('#group_sms_schedule').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });
            $('input[name="group_sms_schedule"]').on('change', function() {
                let datetime_sms_schedule_div = $("#group_sms_schedule_div");
                if ($(this).val() === "group_send_later") {
                    datetime_sms_schedule_div.show();
                    datetime_sms_schedule_div.find("input").attr('required', true);
                } else {
                    datetime_sms_schedule_div.hide();
                    datetime_sms_schedule_div.find("input").attr('required', false);
                }
                // console.log($(this).val());
            });
        });
    </script>
@endsection
