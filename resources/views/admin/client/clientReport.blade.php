]@extends('layouts.admin')
@section('content')
    <style>
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        .print-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            padding: 10px 15px;
            font-size: 16px;
        }
        .print-btn i {
            margin-right: 8px;
        }
        .contact-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }
        .contact-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            transition: transform 0.2s ease-in-out;
        }
        .contact-item:hover {
            transform: scale(1.02);
        }
        h5 {
            margin-bottom: 10px;
            color: #007bff;
        }
        p {
            margin: 0;
            line-height: 1.6;
        }
        
        /* PRINT STYLING */
        @media print {
            body * {
                visibility: hidden; /* Hide everything */
            }
            .container, .container * {
                visibility: visible; /* Show only the container */
            }
            .container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none;
                border: none;
            }
            .print-btn {
                display: none; /* Hide the print button */
            }
        }
    </style>

    <div class="container">
        <button class="btn btn-sm btn-info print-btn" onclick="window.print()">
            <i class="fa fa-print"></i> Print
        </button>

        <div class="contact-list">
            @foreach($clientData as $client)
                <div class="contact-item">
                    <h5>To:</h5>
                    <p><strong>{{ $client->name }}</strong><br>
                        {{ $client->designationData->name }}, {{ $client->companyData->name }}<br>
                        {{ $client->address }}</p>
                </div>
            @endforeach
        </div>
    </div><br><br>
@endsection
