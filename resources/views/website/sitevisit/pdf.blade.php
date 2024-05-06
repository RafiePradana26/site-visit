<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Visit</title>
</head>

<body>
    <h1>Site Visit</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Location</th>
                <th>Client Name</th>
                <th>Purpose</th>
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
                    <td>{{ $siteVisit->date_visit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
