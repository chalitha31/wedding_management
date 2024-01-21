<?php
// require "connection.php";
// session_start();
require "header.php";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchase History</title>
    <link rel="icon" href="images/LogoW.png" />
    <!-- <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/pay-wrapper.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>

<body onload="loadhisry(0);">


    <div class=" gif-container purchase-gif-con">
        <span class="proc">processing ...</span>
        <!-- <img class="load-gif" src="images/package_img/preloader.gif"> -->
        <!-- <lord-icon src="https://cdn.lordicon.com/xjovhxra.json" trigger="loop" colors="primary:#30c9e8,secondary:#08a88a" style="width:250px;height:250px"></lord-icon> -->
        <lord-icon src="https://cdn.lordicon.com/ridbdkcb.json" trigger="loop" colors="primary:#4be1ec,secondary:#cb5eee" style="width:100px;height:100px">
        </lord-icon>
        <div style="display: none;" class="sentL">Sent</div>
    </div>

    <div class="container-fluid">
        <div class="row">



            <div class="col-12 text-center  mb-3 mt-5">
                <br /> <br />
                <span class="fs-1 fw-bold text-primary">
                    Booking History
                </span>
            </div>

            <div class=" col-lg-3 bg-white rounded mb-3">
                <div class="row">

                    <div class="offset-lg-1 col-9 p-2">

                        <select class="form-select border-0 border-bottom border-primary border-3 " style="background-color:#d2d2d2" id="sort" onchange="hisry()">
                            <option value="0">Nearest booking dates</option>
                            <option value="1">By order date</option>
                            <!-- <option value="2">Photography</option>
                            <option value="3">Vehicles</option> -->
                            <!-- <option value="4">QUANTITY HIGH TO LOW</option> -->
                        </select>
                    </div>
                </div>
            </div>



            <div id="results" class="">


            </div>
        </div>

        <!-- modal -->
        <div class="modal " id="veificationModel" tabindex="-1">
            <div class="modal-dialog ">
                <div class="modal-content bg-info">
                    <div class="modal-header">
                        <span class="d-none" id="trid">id</span>
                        <span class="d-none" id="valId">id</span>
                        <span class="d-none" id="pid">id</span>
                        <h5 class="d-none" id="ptitle"></h5>
                        <h5 class="modal-title" id="ptitlemodel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light">
                        <div class="text-center p-1">

                            <input type="file" class="d-none" id="profileimg" accept="img/*" />
                            <?php

                            $profileImg = Database::search("SELECT * FROM `feedback_img` WHERE `feedback_user`= '" . $_SESSION["user_email"] . "' ");
                            $pn = $profileImg->num_rows;
                            if ($pn == 1) {
                                $p = $profileImg->fetch_assoc();
                            ?>
                                <label style="cursor:pointer" for="profileimg" onclick="changeImage();"><img class="rounded  rounded-circle " width="120px" height="120px" src="images/review/<?php echo $p["image"];  ?>" id="prev0" /></label>
                            <?php

                            } else {
                            ?>

                                <label style="cursor:pointer" for="profileimg" onclick="changeImage();"><img class="rounded rounded-circle" width="120px" height="120px" src="images/review/profile.jpeg" id="prev0" /></label>


                            <?php
                            }
                            ?>

                            <!-- <img style="width: 100px;" src="images/review/profile.jpeg" class="rounded" id="prev0"> -->
                            <!-- <input type="file" class="d-none" id="profileimg" accept="img/*" /> -->
                            <!-- <label class="btn btn-info border-0 " for="profileimg" onclick="changeImage();">Update Profile Image</label> -->

                        </div>
                        <div class="row">

                            <div class="col-6 text-end my-auto">
                                <span class="fs-5">Select Rating :</span>
                            </div>
                            <div class="col-6 text-start fs-4">
                                <?php
                                for ($i = 1; $i < 6; $i++) {
                                ?>
                                    <i class="bi bi-star-fill fs-3 label2" onclick="markStar('<?php echo $i; ?>');" id="star<?php echo $i ?>"></i>
                                <?php
                                }

                                ?>

                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-12">
                                <textarea class="form-control" id="feed" rows="10" placeholder="Write Your Feelings"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="resetPurchaseModal();" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addfeedback();">Add Feedback</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->


        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
        <script src="js/histry.js"></script>
        <script src="js/common.js"></script>
        <script src="js/bootstrap.js"></script>
        <!-- <script src="js/pay-wrapper.js"></script> -->
</body>


</html>