<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */

$news = $this->getData('news');

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= $news->getTitle(); ?></h1></header>
            <div class="inner">
                <article>
                    <?= $news->getContent(); ?>
                </article>
            </div>
        </section>
    </div>
</div>