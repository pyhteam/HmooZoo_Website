<?php
if (isset($_GET['page']) && $_GET['page'] != 'tim-kiem') {
    echo "Page not found";
}
$keySearch = isset($_GET['keySearch']) ? $_GET['keySearch'] : '';

// paging
$limit = 20;
// Paging limit & offset
$offset = !empty($_GET['p']) ? (($_GET['p'] - 1) * $limit) : 0;
// Count of all records
$query   = $conn->query("SELECT COUNT(*) as rowNum FROM videos WHERE Title LIKE '%$keySearch%'");
$result  = $query->fetch_assoc();
$rowCount = $result['rowNum'];
$pagConfig = array(
    'baseURL' => '?page=tim-kiem',
    'totalRows' => $rowCount,
    'perPage' => $limit
);
$pagination =  new Pagination($pagConfig);

$sql = "SELECT * FROM videos WHERE Title LIKE '%$keySearch%' ORDER BY View DESC LIMIT $offset, $limit";
$result = $conn->query($sql);

?>
<div class="row mb-4">
    <h2 class="col-6 tm-text-primary">
        Latest Videos
    </h2>
    <div class="col-6 d-flex justify-content-end align-items-center">
        <form action="" class="tm-text-primary">
            Videos <input type="text" value="<?= $limit ?>" size="20" class="tm-input-paging tm-text-primary"> of <?= $rowCount ?>
        </form>
    </div>
</div>
<div class="row tm-mb-90 tm-gallery">
    <?php
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
<div class="row tm-mb-90">
    <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
        <?php echo $pagination->createdShowing(); ?>
        <nav class="d-flex ml-md-auto d-print-none" aria-label="Pagination">
            <?php echo $pagination->createLinks(); ?>
        </nav>

    </div>
</div>