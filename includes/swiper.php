<?php
include_once './server/dbcon.php';

// Fetch carousel items from the database
$stmt = $pdo->query("SELECT * FROM carousel ORDER BY created_at DESC");
$carouselItems = $stmt->fetchAll();
?>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php foreach ($carouselItems as $item): ?>
            <div class="swiper-slide">
            <img src="./<?= str_replace('../', '', $item['image_url']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">

                <div class="swiper-slide-content">
                    <h2><?= htmlspecialchars($item['title']) ?></h2>
                    <p><?= htmlspecialchars($item['description']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>