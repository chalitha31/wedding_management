<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/fetc.css">

</head>


<body>
    <h3>5 Maximum Packages</h3>
    <div class="package-container">
        <div class="package-model">
            <div class="package-en-container" style="pointer-events: none;">
                <input type="checkbox" class="package-active-check" id="enable-1" checked>
                <label for="enable-1" class="package-enable">enable</label>
            </div>
            <div class="package-name">Package-1</div>
            <!-- <i class="fa-solid fa-circle-xmark package-close-icon"></i> -->
            <div class="image-holder">
                <input type="file" accept="image/*" name="image" id="file-1" style="display:none;" onchange="loadFile(event)">
                <label class="label" for="file-1">
                    <i class="fa-solid fa-cloud-arrow-up upload-pack-img"></i>
                </label>
            </div>
            <input type="text" class="package-title" placeholder="set a title for the package">
            <div class="feIC">
                <input type="text" placeholder="add features of the package" class="feature-input">
                <div class="feature-add-button">ADD</div>
            </div>
            <div class="features-container">
                <div class="feature-box-default">No features added yet</div>
            </div>
            <input type="text" class="input-package-price" placeholder="set a Price for the package">
            <!-- <div class="getF">Save</div> -->
        </div>
    </div>

    <div>Total prices (Rs) : <span class="total-prices"></span></div>
    <div class="upload-button">Upload</div>

    <script src="js/fetc.js"></script>
</body>

</html>