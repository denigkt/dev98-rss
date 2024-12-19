<?php
//todo: rework
$loadrss = 'https://dev98.de/feed/';
define('TITLE', 'dev98 &#8211; a blog of the netz98 developer team');
include ('inc/Feed.php');
include ('inc/header.php');
?>

<div class="mainpart">
  <body>
    <?php require_once './inc/nav.php'; ?>
       <div class="row mx-auto">
<?php
foreach ($xml->channel->item as $item)
{
    echo ' 
    <div class="col-sm-12 col-md-6 col-lg-4 d-flex align-self-stretch">
    <div class="card shadow-sm mb-4 box-custom">
        <div class="card-body d-flex flex-column">
            <strong class="d-inline-block mb-2 smallhead box-head">' . $item->category[0] . '</strong>
            <h5 class="card-title">
                <a class="text-white" href="' . $item->link . '">' . $item->title . '</a>
            </h5>
            <div class="mb-1 text-muted">' . $dc->creator . ' <i class="fas fa-user"></i></div>
            <div class="mb-1 text-muted">' . $pubDate . ' <i class="far fa-clock"></i></div>
            <p class="card-text text-white mb-auto">' . $item->description . '</p>
        </div>
    </div>
</div>
 ';
}
?>
   </div>

</div>
<?php
include ('inc/footer.php');
?>
</body>
