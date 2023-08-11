in email folder:

index.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Log</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Email Log</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Sender Facility</th>
                <th>Receiver Email</th>
                <th>Subject</th>
                <th>Body Preview</th>
            </tr>
        </thead>
        <tbody id="logTable">
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $.getJSON('get_logs.php', function(data) {
                $.each(data, function(key, log) {
                    $('#logTable').append(
                        '<tr>' +
                        '<td>' + log.email_date + '</td>' +
                        '<td>' + log.sender_facility + '</td>' +
                        '<td>' + log.receiver_email + '</td>' +
                        '<td>' + log.subject + '</td>' +
                        '<td>' + log.body_preview + '</td>' +
                        '</tr>'
                    );
                });
            });
        });
    </script>
</body>
</html>


