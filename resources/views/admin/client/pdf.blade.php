<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .contact-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin: 5px;
            display: inline-block;
            width: 18%;
            vertical-align: top;
            background: #f9f9f9;
        }

        .contact-list {
            margin-top: 10px;
        }

        h5 {
            color: #007bff;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<h2>Client List</h2>

<div class="contact-list">
    @foreach($clientData as $client)
        <div class="contact-item">
            <h5>To:</h5>
            <p>
                <strong>
                    @if($client->name == 'Not Applicable')
                    @else
                    {{ $client->name ?? '' }}
                    @endif
                </strong><br>
                {{ $client->designationData->name ?? '' }}<br>
                {{ $client->companyData->name ?? '' }}<br>
                {{ $client->address ?? '' }}
            </p>
        </div>
    @endforeach
</div>

</body>
</html>
