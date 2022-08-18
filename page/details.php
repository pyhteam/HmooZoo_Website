<?php
if (!isset($_GET['videoId'])) {
    echo "Video không tồn tại";
    return;
}

$videoId = $_GET['videoId'];
// get video detail by videoId
$sql = "SELECT * FROM videos WHERE VideoId = '$videoId'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>
<div class="row mb-4">
    <h2 class="col-12 tm-text-primary"><?= $data["Title"] ?></h2>
</div>
<div class="row tm-mb-90">
    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
        <!-- Iframe -->
        <iframe width="850" height="500" src="https://www.youtube.com/embed/<?= $data['VideoId'] ?>" title="<?= $data['Title'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div>
            <?php
            $description = str_replace("\n", "<br>", $data["Description"]);
            echo $description;
            ?>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
        <div class="tm-bg-gray tm-video-details">
            <p class="mb-4">
                Download log hauv koj lub Phone lossis PC, Laptop
            </p>
            <div class="text-center mb-5">
                <a href="#" class="btn btn-primary tm-btn-big">Download</a>
            </div>
            <div class="mb-4 d-flex flex-wrap">
                <div class="mr-4 mb-2">
                    <span class="tm-text-gray-dark">Resolution: </span><span class="tm-text-primary">
                        <?php
                        // upptoCase HD
                        $resolution = $data["Relution"];
                        echo strtoupper($resolution);

                        ?>
                    </span>
                </div>
                <div class="mr-4 mb-2">
                    <span class="tm-text-gray-dark">Format: </span><span class="tm-text-primary">MP4</span>
                </div>
                <div>
                    <span class="tm-text-gray-dark">Duration: </span><span class="tm-text-primary">
                        <?php
                        $duration = $data["Duration"];
                        $date = new DateTime('1970-01-01');
                        $date->add(new DateInterval($duration));
                        echo $date->format('H:i:s');
                        ?>
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <h3 class="tm-text-gray-dark mb-3">License</h3>
                <p>☞ LH Vấn Đề Bản Quyền: pyhteam.solutions@gmail.com
                    © Bản quyền Video thuộc về HmooZoo Official
                    © Copyright by HmooZoo Official ☞ Do not Reup</p>
            </div>
            <div>
                <h3 class="tm-text-gray-dark mb-3">Tags</h3>
                <?php
                $tags = $data["Tags"];
                $tags = explode(",", $tags);
                foreach ($tags as $tag) {
                    echo "<a href='#' class='tm-text-primary tm-tag'>$tag</a>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <h2 class="col-12 tm-text-primary">
        Videos Zoo Tshaj
    </h2>
</div>

<div class="row mb-3 tm-gallery">
    <?php
    // get most viewed videos
    $sql = "SELECT * FROM videos ORDER BY View DESC LIMIT 8";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

        // get View

        $video_date = date('Y-m-d H:m:i', strtotime($row["PublishedAt"]));
        echo ' 
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                            <figure style="width:320px; height:180px;" class="effect-ming tm-video-item">
                                <img  src="' . $row["Thumbnail"] . '" alt="Image" class="img-fluid">
                                <figcaption class="d-flex align-items-center justify-content-center">
                                    <h2>' . $row["Title"] . '</h2>
                                    <a href="?page=details&videoId=' . $row["VideoId"] . '">View more</a>
                                </figcaption>
                            </figure>
                            <div class="d-flex justify-content-between tm-text-gray">
                                <span class="tm-text-gray-light">' .  timeAgo($video_date) . '</span>
                                <span>' .  number_format($row["View"], 0, '.', ',') . ' Lượt xem</span>
                            </div>
                        </div>';
    }



    ?>


</div> <!-- row -->