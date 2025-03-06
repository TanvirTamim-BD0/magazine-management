@extends('layouts.admin')
@section('content')
    <style>
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 100%; /* Full width to fit 5 columns */
            margin: auto;
            padding: 20px;
        }
        .print-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .print-btn i {
            margin-right: 8px;
        }
        .contact-list {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 columns */
            gap: 15px;
        }
        .contact-item {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            text-align: center;
            transition: transform 0.2s ease-in-out;
            font-size: 14px; /* Adjust font size for better fit */
        }
        .contact-item:hover {
            transform: scale(1.02);
        }
        h5 {
            margin-bottom: 5px;
            color: #007bff;
        }
        p {
            margin: 0;
            line-height: 1.4;
        }

        .filter-form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .filter-form input, .filter-form button {
            padding: 8px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        
        /* PRINT STYLING */
        @media print {
            @page {
                size: A4 landscape; /* Force landscape printing */
                margin: 0; /* Remove margins */
            }
            body * {
                visibility: hidden; /* Hide everything */
            }
            .contact-list, .contact-list * {
                visibility: visible; /* Show only contact list */
            }
            .contact-list {
                margin-top: 15px;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                background: none;
                border: none;
                box-shadow: none;
            }
            .print-btn {
                display: none; /* Hide print button */
            }
        }
    </style>

    <div class="container">

        <!-- Filter Form -->
        <form class="filter-form" method="POST" action="{{ route("admin.area.filter") }}">
            @csrf
            <input type="text" name="area_code" placeholder="Enter Area Code" required>
            <button type="submit"> <i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
        </form>

        <button class="print-btn" onclick="window.print()">
            <i class="fas fa-print"></i> Print
        </button>
        <div class="contact-list">
            @foreach($clientData as $client)
                <div class="contact-item">
                    <h5>To:</h5>
                    <p><strong>{{ $client->name ?? ''}}</strong><br>
                        {{ $client->designationData->name ?? ''}}, {{ $client->companyData->name ?? ''}}<br>
                        {{ $client->address ?? ''}}</p>
                </div>
            @endforeach
        </div>
    </div><br><br>
@endsection
