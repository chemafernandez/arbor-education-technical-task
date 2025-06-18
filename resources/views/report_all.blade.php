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
    </head>
    <body>
        <div class="container">
            <div class="mt-4 mb-4">
                <h1>SMS Report: All Messages</h1>
                <div>
                    <a href="{{ route('report_by_recipient') }}">View Messages Grouped by Recipient</a>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <div class="mt-3 mb-3">
                        <div class="fw-bold">Num. of Messages: {{ $messagesList->count() }}</div>
                        <ul>
                            <li class="fw-bold">Sent: {{ $messagesSentCount }} ({{ $messagesSentRate }}%)</li>
                            <li class="fw-bold">Delivered: {{ $messagesDeliveredCount }} ({{ $messagesDeliveredRate }}%)</li>
                            <li class="fw-bold">Failed: {{ $messagesFailedCount }} ({{ $messagesFailedRate }}%)</li>
                            <li class="fw-bold">Rejected: {{ $messagesRejectedCount }} ({{ $messagesRejectedRate }}%)</li>
                        </ul>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>MSG ID</th>
                                <th>WEBHOOK</th>
                                <th>MESSAGE</th>
                                <th>SENDER</th>
                                <th>RECIPIENT</th>
                                <th>PROVIDER</th>
                                <th>TIMESTAMP</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messagesList as $message)
                            <tr>
                                <td>{{ $message->msg_id }}</td>
                                <td>{{ $message->webhook }}</td>
                                <td>
                                    <div class="fw-bold">{{ $message->subject }}</div>
                                    <div>{{ $message->body }}</div>
                                </td>
                                <td>{{ $message->sender->name }} ({{ $message->sender->id }})</td>
                                <td>{{ $message->recipient->phone_number }}</td>
                                <td>{{ $message->provider->name }}</td>
                                <td>{{ $message->timestamp }}</td>
                                <td>{{ $message->status->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
