@extends('layouts.admin')
@section('content')

<style>
    .container {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        margin: auto;
    }

    .btn-group {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-bottom: 20px;
    }

    .print-btn,
    .word-btn {
        padding: 10px 15px;
        font-size: 16px;
        cursor: pointer;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .word-btn-pdf {
        padding: 10px 15px;
        font-size: 16px;
        cursor: pointer;
        background: #f53f3f;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .print-btn i,
    .word-btn i {
        margin-right: 6px;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .filter-form select {
        padding: 8px;
        min-width: 200px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .contact-list {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
    }

    .contact-item {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        text-align: left;
        transition: transform 0.2s ease-in-out;
        font-size: 14px;
    }

    .contact-item:hover {
        transform: scale(1.02);
    }

    h5 {
        margin-bottom: 5px;
        color: #007bff;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body * {
            visibility: hidden;
        }

        .contact-list,
        .contact-list * {
            visibility: visible;
        }

        .contact-list {
            margin-top: 15px;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .btn-group,
        .filter-form {
            display: none !important;
        }

        .contact-item {
            page-break-inside: avoid;
        }
    }
</style>

<div class="container">

    <!-- Action Buttons -->
    <div class="btn-group">
        <button class="print-btn" onclick="window.print()">
            <i class="fas fa-print"></i> Print
        </button>

        <a id="pdf-download" class="word-btn-pdf" style="color: white;">
            <i class="fas fa-file-pdf"></i> Download PDF
        </a>


        <!-- <a href="{{ route('admin.contacts.downloadWord') }}" class="word-btn">
            <i class="fas fa-file-word"></i> Download Word
        </a> -->
    </div>

    <!-- Filters -->
    <div class="filter-form">
        <select id="filter-category">
            <option value="">Filter by Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select id="filter-designation">
            <option value="">Filter by Designation</option>
            @foreach($designations as $designation)
                <option value="{{ $designation->name }}">{{ $designation->name }}</option>
            @endforeach
        </select>

        <select id="filter-company">
            <option value="">Filter by Company</option>
            @foreach($companies as $company)
                <option value="{{ $company->name }}">{{ $company->name }}</option>
            @endforeach
        </select>

        <select id="filter-area">
            <option value="">Filter by Area</option>
            @foreach($areas as $area)
                <option value="{{ $area->name }}">{{ $area->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Contact Cards -->
    <div class="contact-list">
        @foreach($clientData as $client)
            <div class="contact-item"
                data-category="{{ $client->categoryData->name ?? '' }}"
                data-designation="{{ $client->designationData->name ?? '' }}"
                data-company="{{ $client->companyData->name ?? '' }}"
                data-area="{{ $client->areaCodeData->name ?? '' }}">
                <h5>To:</h5>
                <p>
                    <strong>
                        @if($client->name == 'Not Applicable')
                        @else
                        {{ $client->name ?? '' }}
                        @endif
                    </strong><br>
                    {{ $client->designationData->name ?? '' }}<br>

                    @if($client->companyData->name == 'Not Applicable')
                    @else
                    {{ $client->companyData->name ?? '' }}<br>
                    @endif
                    
                    {{ $client->address ?? '' }}
                </p>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filters = {
            category: document.getElementById('filter-category'),
            designation: document.getElementById('filter-designation'),
            company: document.getElementById('filter-company'),
            area: document.getElementById('filter-area')
        };

        const contactItems = document.querySelectorAll('.contact-item');

        Object.values(filters).forEach(select => {
            select.addEventListener('change', () => {
                filterContacts();
            });
        });

        function filterContacts() {
            contactItems.forEach(item => {
                const matchesCategory = filters.category.value === '' || item.dataset.category === filters.category.value;
                const matchesDesignation = filters.designation.value === '' || item.dataset.designation === filters.designation.value;
                const matchesCompany = filters.company.value === '' || item.dataset.company === filters.company.value;
                const matchesArea = filters.area.value === '' || item.dataset.area === filters.area.value;

                item.style.display = (matchesCategory && matchesDesignation && matchesCompany && matchesArea) ? '' : 'none';
            });
        }
    });


</script>

<script>
    document.getElementById('pdf-download').addEventListener('click', function () {
        const category = document.getElementById('filter-category').value;
        const designation = document.getElementById('filter-designation').value;
        const company = document.getElementById('filter-company').value;
        const area = document.getElementById('filter-area').value;

        const params = new URLSearchParams({
            category,
            designation,
            company,
            area
        });

        window.open(`{{ route('admin.contacts.downloadPdf') }}?` + params.toString());
    });
</script>


@endsection
