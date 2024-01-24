@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="row g-2 align-items-center my-3">
        <div class="col">
            <div class="event-pretitle"> Event Management</div>
            @if (isset($event))
            <h2 class="event-title py-2"> Edit Event</h2>
            @else
            <h2 class="event-title"> Create Event </h2>
            @endif
        </div>
        <div class="col-12 my-2 col-md-auto ms-auto d-print-none">
            <a href="{{ route('events.index') }}" class="btn btn-secondary d-inline-block">
                Back
            </a>
            <button class="btn btn-primary d-inline-block outerSubmitBtn">
                Submit
            </button>
        </div>
    </div>


    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
            @endif

            @if ($message = Session::get('msg'))
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
            @endif
            <form action="{{ route('events.storeOrUpdate', isset($event) ? $event->id : 0) }}" method="POST"
                id="eventEditForm" enctype="multipart/form-data">
                @csrf


                <div class="row">
                    <div class="col-12 my-2">
                        <div class="form-group">
                            <label class="form-label" for="form-title">Title(*):</label>
                            <input id="form-title" type="text" name="title" class="form-control" placeholder="Title"
                                value="{{ old('title', isset($event->title) ? $event->title : '') }}" />
                        </div>
                    </div>

                    <div class="col-12 my-2">

                        <div class="form-group">
                            <label class="form-label">Slug:</label>
                            <input type="text" name="slug"
                                value="{{ old('slug', isset($event->slug) ? $event->slug : '') }}" class="form-control"
                                placeholder="Slug" />
                        </div>
                    </div>

                    <div class="col-6 my-2">
                        <div class="form-group">
                            <label class="form-label" for="form-start_date">Start Date(*):</label>
                            <input id="form-start_date" type="date" name="start_date"
                                class="form-control flatpickr date" placeholder="Start Date"
                                value="{{ old('start_date', isset($event->start_date) ? $event->start_date : '') }}"
                                required />
                        </div>
                    </div>

                    <div class="col-6 my-2">
                        <div class="form-group">
                            <label class="form-label" for="form-end_date">End Date(*):</label>
                            <input id="form-end_date" type="date" name="end_date" class="form-control flatpickr date"
                                placeholder="End Date"
                                value="{{ old('end_date', isset($event->end_date) ? $event->end_date : '') }}"
                                required />
                        </div>
                    </div>

                    <div class="col-6 my-2">
                        <div class="form-group">
                            <label class="form-label" for="form-registration_start_date">Registration Start
                                Date(*):</label>
                            <input id="form-registration_start_date" type="datetime-local"
                                name="registration_start_date" class="form-control  flatpickr datetime"
                                placeholder="Registration Start Date"
                                value="{{ old('registration_start_date', isset($event->registration_start_date) ? $event->registration_start_date : '') }}"
                                required />
                        </div>
                    </div>

                    <div class="col-6 my-2">
                        <div class="form-group">
                            <label class="form-label" for="form-registration_end_date">Registration End
                                Date(*):</label>
                            <input id="form-registration_end_date" type="datetime-local" name="registration_end_date"
                                class="form-control flatpickr datetime" placeholder="Registration End Date"
                                value="{{ old('registration_end_date', isset($event->registration_end_date) ? $event->registration_end_date : '') }}"
                                required />
                        </div>
                    </div>

                    <div class="col-12 my-2">
                        <div class="form-group">
                            <label class="form-label">Status(*):</label>

                            <select class="form-select" name="status" required>
                                <option value="2" {{ old('status', isset($event->status) ? $event->status : '') == 2 ?
                                    'selected' : '' }}>
                                    Disabled
                                </option>
                                <option value="1" {{ old('status', isset($event->status) ? $event->status : '') == 1 ?
                                    'selected' : '' }}>
                                    Enacled
                                </option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12 my-2 text-center">
                        <button type="submit" class="btn btn-primary editEventBtn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery.validator.addMethod("greaterThan", function (value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val()) ||
            (Number(value) > Number($(params).val()));
    }, 'Must be greater than {0}.');

    jQuery(document).ready(function ($) {
        $('button[data-bs-toggle="tab"]').on('click', function () {
            localStorage.setItem("event-tab", $(this).attr('id'));
            localStorage.setItem("event-tab-id", {{ $event-> id }});
            });

    let eventEditForm = $("#eventEditForm");

    // validation rules
    eventEditForm.validate({
        errorClass: 'text-danger',
        rules: {
            title: {
                required: true,
            },
            status: {
                required: true,
            },
            registration_end_date: {
                greaterThan: "#form-registration_start_date"
            }
        },
        messages: {
            title: {
                required: "Please enter a title",
            },
            status: {
                required: 'Please select a status',
            },
            registration_end_date: {
                greaterThan: 'End date cant be before start date',
            }
        }
    });

    //on eventEditForm submit
    eventEditForm.submit(function (event) {
        //check validation
        if (!eventEditForm.valid()) {
            return false;
        }
    });

    $('.outerSubmitBtn').on('click', function () {
        $('.editEventBtn').trigger('click');
    });

    const event_tab = localStorage.getItem("event-tab");
    const event_tab_id = localStorage.getItem("event-tab-id");
    if (event_tab != '' && event_tab_id == {{ $event -> id }}) {
        $('#' + event_tab).tab('show');
    }
        });
</script>
@endsection