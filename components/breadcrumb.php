<?php
// Check if an array of breadcrumbs is provided. 
// Example: $breadcrumbs = [['title' => 'Home', 'url' => '../index.html'], ['title' => 'Category', 'url' => 'category.php'], ['title' => 'Current Page']];
if (!isset($breadcrumbs) || !is_array($breadcrumbs)) {
    // Fallback for simpler setups that just provide $breadcrumbTitle
    $title = $breadcrumbTitle ?? 'Current Page';
    $breadcrumbs = [
        ['title' => 'Home', 'url' => '../index.html'],
        ['title' => $title]
    ];
}
?>
<div class="breadcrumb">
    <?php 
    $count = count($breadcrumbs);
    foreach ($breadcrumbs as $index => $crumb): 
        $title = htmlspecialchars($crumb['title']);
        $url = isset($crumb['url']) && !empty($crumb['url']) ? htmlspecialchars($crumb['url']) : '';
        
        if ($url): 
    ?>
        <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
    <?php else: ?>
        <span><?php echo $title; ?></span>
    <?php endif; ?>

    <?php if ($index < $count - 1): ?>
        <i class="fa-solid fa-chevron-right" style="font-size:.6rem"></i>
    <?php endif; ?>
    <?php endforeach; ?>
</div>
