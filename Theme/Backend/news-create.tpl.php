<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-9">
        <?php include __DIR__ . '/../../../Editor/Theme/Backend/editor.tpl.php'; ?>
    </div>

    <div class="col-xs-12 col-md-3">
        <section class="box wf-100">
            <div class="inner">
                <form id="docForm" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/news?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tr><td colspan="2"><label for="publish"><?= $this->getHtml('Status'); ?></label>
                        <tr><td colspan="2"><select name="status">
                                    <option value="<?= htmlspecialchars(Modules\News\Models\NewsStatus::DRAFT, ENT_COMPAT, 'utf-8'); ?>" selected><?= $this->getHtml('Draft'); ?>
                                    <option value="<?= htmlspecialchars(Modules\News\Models\NewsStatus::VISIBLE, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('Visible'); ?>
                        <tr><td colspan="2"><label for="publish"><?= $this->getHtml('Publish'); ?></label>
                        <tr><td colspan="2"><input type="datetime-local" id="publish" value="<?= htmlspecialchars((new \DateTime('NOW'))->format('Y-m-d\TH:i:s'), ENT_COMPAT, 'utf-8'); ?>">
                        <tr><td><input type="submit" value="<?= $this->getHtml('Delete', 0); ?>"><td class="rightText"><input type="submit" value="<?= $this->getHtml('Save', 0); ?>"> <input type="submit" value="<?= $this->getHtml('Publish'); ?>">
                    </table>
                </form>
            </div>
        </section>
        <section class="box wf-100">
            <div class="inner">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label><?= $this->getHtml('Type'); ?></label>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="docForm" value="<?= htmlspecialchars(Modules\News\Models\NewsType::ARTICLE, ENT_COMPAT, 'utf-8'); ?>" id="news" checked><label for="news"><?= $this->getHtml('News'); ?></label></span>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="docForm" value="<?= htmlspecialchars(Modules\News\Models\NewsType::HEADLINE, ENT_COMPAT, 'utf-8'); ?>" id="headline"><label for="headline"><?= $this->getHtml('Headline'); ?></label></span>
                    <tr><td colspan="2"><span class="radio"><input type="radio" name="type" form="docForm" value="<?= htmlspecialchars(Modules\News\Models\NewsType::LINK, ENT_COMPAT, 'utf-8'); ?>" id="link"><label for="link"><?= $this->getHtml('Link'); ?></label></span>
                </table>
            </div>
        </section>
        <section class="box wf-100">
            <div class="inner">
                <table class="layout wf-100">
                    <tr><td><label for="permission"><?= $this->getHtml('Permissions'); ?></label>
                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="permission"><input type="hidden" form="docForm" name="permission"></span>
                    <tr><td><button><?= $this->getHtml('Add', 0, 0); ?></button>
                </table>
            </div>
        </section>
        <section class="box wf-100">
            <div class="inner">
                <table class="layout wf-100">
                    <tr><td colspan="2"><label for="groups"><?= $this->getHtml('Groups'); ?></label>
                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input  type="text" id="groups"><input type="hidden" form="docForm" name="groups"></span>
                    <tr><td><button><?= $this->getHtml('Add', 0, 0); ?></button>
                </table>
            </div>
        </section>
    </div>
</div>
