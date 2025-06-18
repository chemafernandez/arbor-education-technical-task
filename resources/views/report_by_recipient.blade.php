<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $_ENV['APP_NAME'] }}</title>
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/8cfaf704dc.js" crossorigin="anonymous"></script>
        <script>
            function setCursorStyle(element) {
                element.css('cursor','pointer');
            }
            function expand(element, recipientId) {
                element.addClass('collapse');
                $('#collapse_'+recipientId).removeClass('collapse');
                $('.messages_'+recipientId).removeClass('collapse');
            }
            function collapse(element, recipientId) {
                element.addClass('collapse');
                $('#expand_'+recipientId).removeClass('collapse');
                $('.messages_'+recipientId).addClass('collapse');
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="mt-4 mb-4">
                <h1>SMS Report: Messages Grouped by Recipient</h1>
                <div>
                    <a href="{{ route('report_all') }}">View All Messages</a>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <div class="mt-3 mb-3">
                        <p class="fw-bold">Num. of Recipients: {{ number_format($recipientsList->count(), 0, '', ',') }}</p>
                    </div>
                    @foreach ($recipientsList as $recipientMessages)
                    <hr/>
                    <div class="fw-bold">Recipient: {{ $recipientMessages[0]->recipient->phone_number }}</div>
                    <div> {{ $recipientMessages->count() }} messages
                        <span onmouseover="setCursorStyle($(this));" onclick="expand($(this), {{ $recipientMessages[0]->recipient->id }});" id="expand_{{ $recipientMessages[0]->recipient->id }}"><i class="fa-solid fa-chevron-right"></i> expand</span>
                        <span class="collapse" onmouseover="setCursorStyle($(this));" onclick="collapse($(this), {{ $recipientMessages[0]->recipient->id }});" id="collapse_{{ $recipientMessages[0]->recipient->id }}"><i class="fa-solid fa-chevron-down"></i> collapse</span>
                    </div>
                    <table class="table table-bordered table-striped messages_{{ $recipientMessages[0]->recipient->id }} collapse">
                        <thead>
                            <tr>
                                <th>MSG ID</th>
                                <th>WEBHOOK</th>
                                <th>MESSAGE</th>
                                <th>SENDER</th>
                                <th>RECIPIENT</th>
                                <th>STUDENT</th>
                                <th>PROVIDER</th>
                                <th>TIMESTAMP</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recipientMessages as $message)
                            <tr>
                                <td>{{ $message->msg_id }}</td>
                                <td>{{ $message->webhook }}</td>
                                <td>
                                    <div class="fw-bold">{{ $message->subject }}</div>
                                    <div>{{ $message->body }}</div>
                                </td>
                                <td>{{ $message->sender->snd_id }}</td>
                                <td>{{ $message->recipient->phone_number }}</td>
                                <td>{{ $message->student->std_id }}</td>
                                <td>{{ $message->provider->name }}</td>
                                <td>{{ $message->timestamp }}</td>
                                <td>{{ $message->status->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
