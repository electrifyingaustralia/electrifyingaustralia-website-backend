<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Service Request</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            padding: 30px;
            background: #f8f9fa;
            border-radius: 0 0 8px 8px;
        }

        .section {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: #2d3748;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        .label {
            font-weight: 600;
            color: #4a5568;
            width: 40%;
        }

        .value {
            color: #2d3748;
        }

        .empty-value {
            color: #a0aec0;
            font-style: italic;
        }

        .button {
            display: inline-block;
            background: #48bb78;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 14px;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: #edf2f7;
            color: #4a5568;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .product-badge {
            background: #ebf8ff;
            color: #2b6cb0;
        }

        .issue-badge {
            background: #fed7d7;
            color: #c53030;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>New Service Request Received</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Service Number: {{ $service->service_number }}</p>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">Customer Information</div>
                <table>
                    <tr>
                        <td class="label">Full Name</td>
                        <td class="value">
                            @if ($service->customer->full_name && trim($service->customer->full_name) !== '')
                                {{ $service->customer->full_name }}
                            @else
                                <span class="empty-value">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td class="value">
                            @if ($service->customer->email && trim($service->customer->email) !== '')
                                {{ $service->customer->email }}
                            @else
                                <span class="empty-value">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Phone</td>
                        <td class="value">
                            @if ($service->customer->phone && trim($service->customer->phone) !== '')
                                {{ $service->customer->phone }}
                            @else
                                <span class="empty-value">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Submitted On</td>
                        <td class="value">{{ $service->created_at->format('F j, Y \a\t g:i A') }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">Service Request Details</div>
                <table>
                    <tr>
                        <td class="label">Service Number</td>
                        <td class="value">
                            <span class="badge">{{ $service->service_number }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Product Type</td>
                        <td class="value">
                            <span class="badge product-badge">{{ $service->product_type }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Issue Type</td>
                        <td class="value">
                            <span class="badge issue-badge">{{ $service->issue_type }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Attachment</td>
                        <td class="value">
                            @if ($service->attachment)
                                @php
                                    $attachment = json_decode($service->attachment, true);
                                @endphp
                                @if ($attachment && isset($attachment['original_name']))
                                    📎 {{ $attachment['original_name'] }}
                                @else
                                    <span class="empty-value">Invalid attachment data</span>
                                @endif
                            @else
                                <span class="empty-value">No attachment</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">Issue Details</div>
                <div style="background: #f7fafc; padding: 15px; border-radius: 6px; border-left: 4px solid #48bb78;">
                    @if ($service->issue_details && trim($service->issue_details) !== '')
                        {{ $service->issue_details }}
                    @else
                        <span class="empty-value">No details provided</span>
                    @endif
                </div>
            </div>

            {{-- <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('admin.customer.show', $service) }}" class="button" style="color: white !important;">
                    View Service Request Details
                </a>
            </div> --}}
        </div>

        <div class="footer">
            <p>This is an automated notification from {{ config('app.name') }}</p>
            <p>© {{ date('Y') }} Electrifying Australia. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
