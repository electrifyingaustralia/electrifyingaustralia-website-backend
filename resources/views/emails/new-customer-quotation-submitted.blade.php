<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Quotation Submission</title>
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
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
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
            background: #059669;
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

        .interest-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #d1fae5;
            color: #065f46;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>⚡ New Quotation Submission Received</h1>
        </div>

        <div class="content">
            <!-- Customer Information Section -->
            <div class="section">
                <div class="section-title">📋 Customer Information</div>
                <table>
                    @if($customer->first_name)
                    <tr>
                        <td class="label">Full Name</td>
                        <td class="value">{{ $customer->first_name }} {{ $customer->last_name ?? '' }}</td>
                    </tr>
                    @endif

                    @if($customer->email)
                    <tr>
                        <td class="label">Email</td>
                        <td class="value">{{ $customer->email }}</td>
                    </tr>
                    @endif

                    @if($customer->phone)
                    <tr>
                        <td class="label">Phone</td>
                        <td class="value">{{ $customer->phone }}</td>
                    </tr>
                    @endif

                    @if($customer->address)
                    <tr>
                        <td class="label">Address</td>
                        <td class="value">{{ $customer->address }}</td>
                    </tr>
                    @endif

                    @if($customer->message)
                    <tr>
                        <td class="label">Message</td>
                        <td class="value">{{ $customer->message }}</td>
                    </tr>
                    @endif

                    <tr>
                        <td class="label">Submitted On</td>
                        <td class="value">{{ now()->format('F j, Y \a\t g:i A') }}</td>
                    </tr>
                </table>
            </div>

            <!-- Quotation Details Section -->
            <div class="section">
                <div class="section-title">🔧 Quotation Details</div>
                <table>
                    @if($quotation->interests && count($quotation->interests) > 0)
                    <tr>
                        <td class="label">Interested Solutions</td>
                        <td class="value">
                            @foreach($quotation->interests as $interest)
                            <span class="interest-badge">{{ $interest }}</span>
                            @endforeach
                        </td>
                    </tr>
                    @endif

                    @if($quotation->proposal_type)
                    <tr>
                        <td class="label">Proposal Type</td>
                        <td class="value">{{ $quotation->proposal_type }}</td>
                    </tr>
                    @endif

                    @if($quotation->solar_existing_system)
                    <tr>
                        <td class="label">Existing Solar System</td>
                        <td class="value">{{ $quotation->solar_existing_system }}</td>
                    </tr>
                    @endif

                    @if($quotation->solar_existing_age)
                    <tr>
                        <td class="label">Solar System Age</td>
                        <td class="value">{{ $quotation->solar_existing_age }}</td>
                    </tr>
                    @endif

                    @if($quotation->solar_system_size)
                    <tr>
                        <td class="label">Solar System Size</td>
                        <td class="value">{{ $quotation->solar_system_size }}</td>
                    </tr>
                    @endif

                    @if($quotation->solar_roof_type)
                    <tr>
                        <td class="label">Roof Type</td>
                        <td class="value">{{ $quotation->solar_roof_type }}</td>
                    </tr>
                    @endif

                    @if($quotation->solar_existing_size)
                    <tr>
                        <td class="label">Existing Solar Size</td>
                        <td class="value">{{ $quotation->solar_existing_size }}</td>
                    </tr>
                    @endif

                    @if($quotation->battery_capacity)
                    <tr>
                        <td class="label">Battery Capacity</td>
                        <td class="value">{{ $quotation->battery_capacity }}</td>
                    </tr>
                    @endif

                    @if($quotation->battery_upgrade_type)
                    <tr>
                        <td class="label">Battery Upgrade Type</td>
                        <td class="value">{{ $quotation->battery_upgrade_type }}</td>
                    </tr>
                    @endif

                    @if($quotation->battery_existing)
                    <tr>
                        <td class="label">Existing Battery</td>
                        <td class="value">{{ $quotation->battery_existing }}</td>
                    </tr>
                    @endif

                    @if($quotation->battery_existing_age)
                    <tr>
                        <td class="label">Battery Age</td>
                        <td class="value">{{ $quotation->battery_existing_age }}</td>
                    </tr>
                    @endif

                    @if($quotation->ev_charger_existing)
                    <tr>
                        <td class="label">Existing EV Charger</td>
                        <td class="value">{{ $quotation->ev_charger_existing }}</td>
                    </tr>
                    @endif

                    @if($quotation->ev_charger_type)
                    <tr>
                        <td class="label">EV Charger Type</td>
                        <td class="value">{{ $quotation->ev_charger_type }}</td>
                    </tr>
                    @endif

                    @if($quotation->ev_charger_install_location)
                    <tr>
                        <td class="label">EV Charger Location</td>
                        <td class="value">{{ $quotation->ev_charger_install_location }}</td>
                    </tr>
                    @endif

                    @if($quotation->ev_charger_upgrade_type)
                    <tr>
                        <td class="label">EV Charger Upgrade Type</td>
                        <td class="value">{{ $quotation->ev_charger_upgrade_type }}</td>
                    </tr>
                    @endif

                    @if($quotation->phase_type)
                    <tr>
                        <td class="label">Phase Type</td>
                        <td class="value">{{ $quotation->phase_type }}</td>
                    </tr>
                    @endif

                    @if($quotation->switchboard_distance)
                    <tr>
                        <td class="label">Switchboard Distance</td>
                        <td class="value">{{ $quotation->switchboard_distance }}</td>
                    </tr>
                    @endif

                    @if($quotation->bill_amount)
                    <tr>
                        <td class="label">Average Bill</td>
                        <td class="value">${{ $quotation->bill_amount }}
                            @if($quotation->bill_period)
                            ({{ $quotation->bill_period }})
                            @endif
                        </td>
                    </tr>
                    @endif

                    @if($quotation->property_type)
                    <tr>
                        <td class="label">Property Type</td>
                        <td class="value">{{ $quotation->property_type }}</td>
                    </tr>
                    @endif

                    @if($quotation->installation_timeframe)
                    <tr>
                        <td class="label">Installation Timeframe</td>
                        <td class="value">{{ $quotation->installation_timeframe }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <!-- Action Required Section -->
            <div class="section">
                <div class="section-title">⚠️ Action Required</div>
                <table>
                    <tr>
                        <td class="label">Status</td>
                        <td class="value">
                            <span class="badge" style="background: #fef3c7; color: #92400e;">
                                Pending Review
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- View Details Button -->
            <!-- <div style="text-align: center; margin-top: 30px;">
                <a href="{{ url('/admin/quotations/' . $quotation->id) }}" class="button" style="color: white !important; text-decoration: none;">
                    View Full Quotation Details
                </a>
            </div> -->
        </div>

        <div class="footer">
            <!-- <p>This is an automated notification from Electrifying Australia</p> -->
            <p>© {{ date('Y') }} Electrifying Australia. All rights reserved.</p>
            <p style="font-size: 12px; margin-top: 10px;">
                This email was sent to the admin team for quotation processing.
            </p>
        </div>
    </div>
</body>

</html>