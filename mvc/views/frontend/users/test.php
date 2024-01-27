<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input ID Form</title>
</head>

<body>

    <h2>Input ID Form</h2>

    <form method="post">
        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" required>
        <br>

        <label for="userToLayOff">UserToLayOff ID:</label>
        <input type="text" id="userToLayOff" name="userToLayOff" required>
        <br>
        <button type="submit">Submit</button>
    </form>

</body>

</html>

<?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $userToLayOff = $_POST['userToLayOff'];

    echo "<pre>";
    print_r($user);
    print_r($userLayOff);
    // print_r($success);
    echo "</pre>";
}
?>