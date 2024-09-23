<?php require"functions.php"?>
<?php 
$response = null;

if(isset($_POST['image-upload'])){
    $response = image_validation($_FILES['image']['name'], $_FILES['image']['size'], $_FILES['image']['tmp_name'], $_FILES['image']['type']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>image validation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Image upload</h2>
        <p class="info">
            Allowed image types are [<strong>jpg, png, gif</strong>]
        </p>
        <p class="info">
            Allowed max-filesize is: [<strong>2MB</strong>]
        </p>
        <label for="">Please selet an image</label>
        <input type="file" name="image" id="">
        <button type="submit" name="image-upload">Upload</button>

        <?php
        if($response == "success"){
            ?>
            <p class="success">Your image file is successfully uploaded</p>
            <?php
        } else {
            ?>
            <p class="error"> <?php echo $response?> </p>
            <?php
        }
        ?>

        
        
    </form>
</body>
</html>