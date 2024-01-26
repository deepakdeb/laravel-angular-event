@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="row g-2 align-items-center my-3">
        <div class="col">
            <!-- Event pre-title -->
            <div class="event-pretitle">
                Event Management
            </div>
            <h2 class="event-title">
                Events
            </h2>
        </div>
        <!-- Event title actions -->
        <div class="col-12 col-md-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="{{ route('events.create') }}" class="btn btn-primary d-none d-sm-inline-block"
                    data-bs-target="#modal-report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Create New
                </a>
                <a href="{{ route('events.create') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="Create New"
                    data-bs-target="#modal-report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </a>
            </div>
        </div>
    </div>


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

    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div id="table-default" class="">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Created By</th>
                        <th>Updated By</th>
                        <th>Created Time</th>
                        <th>Updated Time</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($events as $event)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->createdBy->name }}</td>
                        <td>{{ $event->updatedBy->name }}</td>
                        <td>{{ $event->created_at }}</td>
                        <td>{{ $event->updated_at }}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-secondary me-2" href="{{ route('events.edit', $event->id) }}">Edit</a>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle btn-outline-dark"
                                        data-bs-toggle="dropdown"> Actions </button>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <button class="dropdown-item eventDeleteBtn"
                                                data-id="{{ $event->id }}">Delete</button>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <form action="" method="POST" id="eventDeleteForm">
        @csrf
        <input name="id" type="hidden" value="" />
        <input name="_method" type="hidden" value="DELETE" />
    </form>

    <div class="mt-3">
        {!! $events->links('pagination::bootstrap-5') !!}
    </div>
</div>

<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('events.storeOrUpdate', 0) }}" method="POST" id="eventAddForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 my-2">
                            <div class="form-group">
                                <label class="form-label" for="form-title">Title:</label>
                                <input id="form-title" type="text" name="title" class="form-control" placeholder="Title"
                                    required />
                            </div>
                        </div>

                        <div class="col-12 my-2">
                            <div class="form-group">
                                <label class="form-label">Slug:</label>
                                <input type="text" name="slug" class="form-control" placeholder="Slug" />
                            </div>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <button type="submit" class="btn btn-primary editEventBtn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    let notifier = new AWN();
    let currentForm;
    let token;
    let deletedId;

    jQuery(document).ready(function ($) {
        let onOk = () => {
            deleteEvent();
        };

        let onCancel = () => {
            return false;
        };

        //on event delete
        $(".eventDeleteBtn").on('click', function (e) {
            deletedId = $(this).attr("data-id");

            //show confirmation modal
            notifier.confirm('Are you sure want to delete this?',
                onOk,
                onCancel, {
                labels: {
                    confirm: 'Confirmation'
                }
            }
            );
        });

    });

    /**
     * Delete single event
     */
    function deleteEvent() {
        let APP_URL = {!! json_encode(url('/'))!!}
        let action = APP_URL + "/dashboard/events/" + deletedId;

        let $form = $("#eventDeleteForm");

        $form.find('input[name="id"]').val(deletedId);
        $form.attr('action', action);
        $form.submit();
    } // end function deleteEvent
</script>
@endsection