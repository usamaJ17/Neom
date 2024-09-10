@extends($activeTemplate . 'layouts.' . $layout)
@section('content')

    @if ($layout == 'frontend')
        <section class="pt-80 pb-80">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
    @endif

    <div class="card custom--card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-10 d-flex align-items-center flex-wrap">
                    @php echo $myTicket->statusBadge; @endphp

                    <h6 class="ms-2">[@lang('Ticket')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}</h6>
                </div>
                <div class="col-sm-2 text-end">
                    @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                        <button class="btn btn--danger btn-sm confirmationBtn" type="button"
                            data-question="@lang('Are you sure to close this ticket?')" data-action="{{ route('ticket.close', $myTicket->id) }}"
                            @guest disabled @endguest><i class="la la-lg la-times-circle"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('ticket.reply', $myTicket->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <textarea name="message" class="form--control" placeholder="@lang('Your reply message...')">{{ old('message') }}</textarea>
                </div>

                <div class="text-end">
                    <a href="javascript:void(0)" class="btn btn-outline--base btn-sm addFile"><i class="la la-plus"></i>
                        @lang('Add New')</a>
                </div>

                <div class="form-group">
                    <label class="form-label">@lang('Attachments')</label> <small class="text-danger">@lang('Max 5 files can be uploaded').
                        @lang('Maximum upload size is') {{ ini_get('upload_max_filesize') }}</small>
                    <input type="file" name="attachments[]" class="form-control custom--file-upload" />
                    <div id="fileUploadsContainer"></div>
                    <p class="ticket-attachments-message text-muted my-2">
                        @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'),
                        .@lang('pdf'), .@lang('doc'), .@lang('docx')
                    </p>
                </div>
                <div class="form-group text-end">
                    <button type="submit" class="btn btn-md btn--base w-100">@lang('Reply')</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card custom--card mt-4 border-0 bg-transparent">
        @foreach ($messages as $message)
            @if ($message->admin_id == 0)
                <div class="single-reply">
                    <div class="left">
                        <h6>{{ $message->ticket->name }}</h6>
                    </div>
                    <div class="right">
                        <small class="fs--14px text--base mb-2">@lang('Posted on')
                            {{ $message->created_at->format('l, dS F Y @ H:i') }}</small>
                        <p>{{ $message->message }}</p>
                        @if ($message->attachments->count() > 0)
                            <div class="mt-2">
                                @foreach ($message->attachments as $k => $image)
                                    <a href="{{ route('ticket.download', encrypt($image->id)) }}" class="me-3"><i
                                            class="la la-file"></i> @lang('Attachment') {{ ++$k }} </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="single-reply author-reply">
                    <div class="left">
                        <h6>{{ $message->admin->name }}</h6>
                        <small class="lead text-muted">@lang('Staff')</small>
                    </div>
                    <div class="right">
                        <small class="fs--14px text--base mb-2">@lang('Posted on')
                            {{ $message->created_at->format('l, dS F Y @ H:i') }}</small>
                        <p>{{ $message->message }}</p>
                        @if ($message->attachments->count() > 0)
                            <div class="mt-2">
                                @foreach ($message->attachments as $k => $image)
                                    <a href="{{ route('ticket.download', encrypt($image->id)) }}" class="me-3"><i
                                            class="la la-file"></i> @lang('Attachment') {{ ++$k }} </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    </div>
    </div>
    </div>
    </div>

    @if ($layout == 'frontend')
        </div>
        </section>
    @endif

    <x-confirmation-modal />

@endsection

@push('style')
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }
        #confirmationModal .btn {
            padding: 0.375rem .75rem !important;
        }
        .author-reply {
            background-color: #ab8a625c;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="input-group my-3">
                        <input type="file" name="attachments[]" class="form-control custom--file-upload" required />
                        <button type="button" class="input-group-text btn-danger remove-btn"><i class="las la-times"></i></button>
                    </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
@endpush
