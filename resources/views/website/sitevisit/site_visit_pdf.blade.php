<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Visits</title>
    <style>
        /* Style sesuai kebutuhan untuk PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Site Visits</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Location</th>
                <th>Client Name</th>
                <th>Purpose</th>
                <th>Visit Photo</th>
                <th>User Signature</th>
                <th>Client Signature</th>
                <th>Date of Visit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siteVisits as $siteVisit)
                <tr>
                    <td>{{ $siteVisit->name }}</td>
                    <td>{{ $siteVisit->email }}</td>
                    <td>{{ $siteVisit->location }}</td>
                    <td>{{ $siteVisit->clientName }}</td>
                    <td>{{ $siteVisit->purpose }}</td>
                    <td><img src="{{ $siteVisit->visit_photo_url }}" alt="Visit Photo"
                            style="max-width: 100px; max-height: 100px;"></td>
                    <td><img src="{{ $siteVisit->sign_photo_url }}" alt="Signature"
                            style="max-width: 100px; max-height: 100px;"></td>
                    <td><img src="{{ $siteVisit->sign_photo_client_url }}" alt="Signature"
                            style="max-width: 100px; max-height: 100px;"></td>
                    <td>{{ $siteVisit->date_visit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
