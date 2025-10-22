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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: #667eea;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>New Quotation Submission Received</h1>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">Customer Information</div>
                <table>
                    <tr>
                        <td class="label">Full Name</td>
                        <td class="value">
                            @if ($customer->full_name && trim($customer->full_name) !== '')
                                {{ $customer->full_name }}
                            @else
                                <span class="empty-value">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td class="value">
                            @if ($customer->email && trim($customer->email) !== '')
                                {{ $customer->email }}
                            @else
                                <span class="empty-value">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Phone</td>
                        <td class="value">
                            @if ($customer->phone && trim($customer->phone) !== '')
                                {{ $customer->phone }}
                            @else
                                <span class="empty-value">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Address</td>
                        <td class="value">
                            @if ($customer->address && trim($customer->address) !== '')
                                {{ $customer->address }}
                            @else
                                <span class="empty-value">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Category</td>
                        <td class="value">
                            @if ($customer->category && $customer->category->category)
                                {{ $customer->category->category }}
                            @else
                                <span class="empty-value">Not selected</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Sub Category</td>
                        <td class="value">
                            @if ($customer->subCategory && $customer->subCategory->category)
                                {{ $customer->subCategory->category }}
                            @else
                                <span class="empty-value">Not selected</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Message</td>
                        <td class="value">
                            @if ($customer->message && trim($customer->message) !== '')
                                {{ $customer->message }}
                            @else
                                <span class="empty-value">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Submitted On</td>
                        <td class="value">{{ $customer->created_at->format('F j, Y \a\t g:i A') }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">Quotation Summary</div>
                <table>
                    <tr>
                        <td class="label">Total Questions Answered</td>
                        <td class="value">
                            <span class="badge">{{ $customer->answers->count() }} questions</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Quotation Type</td>
                        <td class="value">{{ $customer->type ?? 'General' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status</td>
                        <td class="value">
                            <span class="badge"
                                style="background:
                                @if ($customer->status === 'pending') #fef3c7; color: #92400e;
                                @elseif($customer->status === 'viewed') #d1fae5; color: #065f46;
                                @elseif($customer->status === 'cancelled') #fee2e2; color: #991b1b;
                                @else #f3f4f6; color: #374151; @endif">
                                {{ ucfirst($customer->status ?? 'pending') }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            @if ($customer->answers->count() > 0)
                <div class="section">
                    <div class="section-title">Questions & Answers Preview</div>
                    <table>
                        @foreach ($customer->answers as $answer)
                            <tr>
                                <td colspan="2" style="padding-bottom: 8px;">
                                    <strong>{{ $answer->question->question }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Answer</td>
                                <td class="value">
                                    @if ($answer->answer_type === 'file' && isset($answer->attrs['path']))
                                        📎 {{ $answer->attrs['original_name'] ?? 'Attached File' }}
                                    @elseif(isset($answer->attrs['value']) && is_array($answer->attrs['value']))
                                        {{ implode(', ', $answer->attrs['value']) }}
                                    @elseif(isset($answer->attrs['value']))
                                        {{ $answer->attrs['value'] }}
                                    @else
                                        <span class="empty-value">No answer provided</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Answer Type</td>
                                <td class="value">
                                    <span class="badge">{{ ucfirst($answer->answer_type) }}</span>
                                    @if ($answer->question->is_required)
                                        <span class="badge"
                                            style="background: #fee2e2; color: #991b1b; margin-left: 5px;">Required</span>
                                    @endif
                                </td>
                            </tr>
                            @if (!$loop->last)
                                <tr>
                                    <td colspan="2" style="border-bottom: 2px dashed #e2e8f0;"></td>
                                </tr>
                            @endif
                        @endforeach

                        {{-- @if ($customer->answers->count() > 3)
                            <tr>
                                <td colspan="2" style="text-align: center; padding-top: 15px;">
                                    <em>... and {{ $customer->answers->count() - 3 }} more questions</em>
                                </td>
                            </tr>
                        @endif --}}
                    </table>
                </div>
            @endif

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('admin.customer.show', $customer) }}" class="button">
                    View Full Quotation Details
                </a>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated notification from {{ config('app.name') }}</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
