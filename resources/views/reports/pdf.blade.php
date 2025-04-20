<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report #{{ $report->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .report-info {
            margin-bottom: 30px;
        }
        .report-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .report-info th {
            text-align: left;
            padding: 8px;
            background-color: #f3f4f6;
            border: 1px solid #ddd;
        }
        .report-info td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">MtotoClinic</div>
        <div>Maternal & Child Healthcare System</div>
        <div style="font-size: 12px; color: #666;">
            Generated on: {{ now()->format('F d, Y h:i A') }}
        </div>
    </div>

    <div class="report-info">
        <h2>Report Details #{{ $report->id }}</h2>
        <table>
            <tr>
                <th width="20%">Report ID</th>
                <td>{{ $report->id }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $report->report_type }}</td>
            </tr>
            <tr>
                <th>Created Date</th>
                <td>{{ $report->created_at->format('F d, Y h:i A') }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $report->description }}</td>
            </tr>
            <tr>
                <th>Attachment</th>
                <td>
                    @if($report->file_path)
                        Yes (File attached)
                    @else
                        No attachment
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>This is a computer-generated document. No signature is required.</p>
        <p>MtotoClinic &copy; {{ date('Y') }} All rights reserved.</p>
    </div>
</body>
</html>