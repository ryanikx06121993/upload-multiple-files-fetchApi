<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form id="form" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="text" name="filename" id="filename" placeholder="enter filename" required><br><br>
            <input type="file" name="file[]" id="file" accept="image/*" multiple required><br><br>
            <button type="submit" id="submitbtn">Submit</button>
        </form>
    </div>
</body>
<script src="fetch_api.js"></script>
</html>