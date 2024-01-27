<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>All Orders</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Company ID</th>
                <th>Shipper ID</th>
                <th>Description</th>
                <th>Latitude</th>
                <th>Longtitude</th>
                <th>Address</th>
                <th>IsCompleted</th>
                <th>Create At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['company_id']; ?></td>
                    <td><?php echo $order['shipper_id']; ?></td>
                    <td><?php echo $order['description']; ?></td>
                    <td><?php echo $order['latitude']; ?></td>
                    <td><?php echo $order['longitude']; ?></td>
                    <td><?php echo $order['address']; ?></td>
                    <td><?php echo $order['is_completed'] ? 'No' : 'Yes'; ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>