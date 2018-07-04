<?php
/** @var $block \Ashsmith\Blog\Block\PostView */
/** @var $post \Ashsmith\Blog\Model\Post */
$post = $block->getPost();
?>
<h1 class="blog-post-item-title"><?php echo $post->getTitle() ?></h1>

<div class="blog-post-item-content">
    <?php echo $post->getContent(); ?>
</div>

<div class="blog-post-item-meta">
    <strong><?php echo __('Created at:') ?></strong> <?php echo $post->getCreationTime() ?>
</div>