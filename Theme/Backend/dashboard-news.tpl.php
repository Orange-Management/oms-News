<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\News
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */

$newsList = $this->getData('news') ?? [];
?>
<div id="news-dashboard" class="col-xs-12 col-md-6" draggable="true">
    <div class="portlet">
        <div class="portlet-head"><?= $this->getHtml('News', 'News'); ?></div>
        <table class="default">
            <thead>
            <tr>
                <td>
                <td><?= $this->getHtml('Type', 'News'); ?>
                <td class="wf-100"><?= $this->getHtml('Title', 'News'); ?>
            <tbody>
            <?php $count                                                                   = 0; foreach ($newsList as $key => $news) : ++$count;
            $url                                                                           = \phpOMS\Uri\UriFactory::build('{/prefix}news/article?{?}&id=' . $news->getId());
            $color                                                                         = 'darkred';
            if ($news->getType() === \Modules\News\Models\NewsType::ARTICLE) { $color      = 'green'; }
            elseif ($news->getType() === \Modules\News\Models\NewsType::HEADLINE) { $color = 'purple'; }
            elseif ($news->getType() === \Modules\News\Models\NewsType::LINK) { $color     = 'yellow'; }
            ?>
            <tr data-href="<?= $url; ?>">
                <td data-label="">
                    <?php if ($news->isFeatured()) : ?>
                        <a href="<?= $url; ?>">
                            <i class="fa fa-star favorite"></i>
                        </a>
                    <?php endif; ?>
                <td data-label="<?= $this->getHtml('Type', 'News'); ?>">
                    <a href="<?= $url; ?>">
                        <span class="tag <?= $this->printHtml($color); ?>">
                            <?= $this->getHtml('TYPE' . $news->getType(), 'News'); ?>
                        </span>
                    </a>
                <td data-label="<?= $this->getHtml('Title', 'News'); ?>">
                    <a href="<?= $url; ?>">
                        <?= $this->printHtml($news->title); ?>
                    </a>
                    <?php endforeach; ?>
                    <?php if ($count === 0) : ?>
            <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                    <?php endif; ?>
        </table>
    </div>
</div>