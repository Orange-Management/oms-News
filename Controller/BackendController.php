<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\News
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\News\Controller;

use Modules\Dashboard\Models\DashboardElementInterface;
use Modules\News\Models\NewsArticleMapper;
use Modules\News\Models\PermissionState;

use phpOMS\Account\PermissionType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * News controller class.
 *
 * @package Modules\News
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class BackendController extends Controller implements DashboardElementInterface
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);

        $view->setTemplate('/Modules/News/Theme/Backend/news-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));

        if ($request->getData('ptype') === '-') {
            $view->setData('news',
                NewsArticleMapper::withConditional('language', $response->getHeader()->getL11n()->getLanguage())
                    ::getBeforePivot((int) ($request->getData('id') ?? 0), null, 25)
            );
        } elseif ($request->getData('ptype') === '+') {
            $view->setData('news',
                NewsArticleMapper::withConditional('language', $response->getHeader()->getL11n()->getLanguage())
                    ::getAfterPivot((int) ($request->getData('id') ?? 0), null, 25)
            );
        } else {
            $view->setData('news',
                NewsArticleMapper::withConditional('language', $response->getHeader()->getL11n()->getLanguage())
                    ::getAfterPivot(0, null, 25)
            );
        }

        return $view;
    }

    /**
     * {@inheritdoc}
     */
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/News/Theme/Backend/dashboard-news');

        $news = NewsArticleMapper::withConditional('language', $response->getHeader()->getL11n()->getLanguage())
            ::getNewest(5);

        $view->addData('news', $news);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsArticle(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);

        $article   = NewsArticleMapper::get((int) $request->getData('id'));
        $accountId = $request->getHeader()->getAccount();

        if ($article->getCreatedBy()->getId() !== $accountId
            && !$this->app->accountManager->get($accountId)->hasPermission(
                PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::NEWS, $article->getId())
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/News/Theme/Backend/news-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));
        $view->addData('news', $article);
        $view->addData('editable', $this->app->accountManager->get($accountId)->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::NEWS, $article->getId())
        );

        $t = $this->app->accountManager->get($accountId)->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::NEWS, $article->getId());

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsArchive(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);

        $view->setTemplate('/Modules/News/Theme/Backend/news-archive');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));

        if ($request->getData('ptype') === '-') {
            $view->setData('news',
                NewsArticleMapper::getBeforePivot((int) ($request->getData('id') ?? 0), null, 25)
            );
        } elseif ($request->getData('ptype') === '+') {
            $view->setData('news',
                NewsArticleMapper::getAfterPivot((int) ($request->getData('id') ?? 0), null, 25)
            );
        } else {
            $view->setData('news', NewsArticleMapper::getAfterPivot(0, null, 25));
        }

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);

        $view->setTemplate('/Modules/News/Theme/Backend/news-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app->l11nManager, $request, $response);
        $view->addData('editor', $editor);

        $accGrpSelector = new \Modules\Profile\Theme\Backend\Components\AccountGroupSelector\BaseView($this->app->l11nManager, $request, $response);
        $view->addData('accGrpSelector', $accGrpSelector);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewNewsEdit(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);

        $view->setTemplate('/Modules/News/Theme/Backend/news-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000701001, $request, $response));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app->l11nManager, $request, $response);
        $view->addData('editor', $editor);

        $accGrpSelector = new \Modules\Profile\Theme\Backend\Components\AccountGroupSelector\BaseView($this->app->l11nManager, $request, $response);
        $view->addData('accGrpSelector', $accGrpSelector);

        $view->addData('news', NewsArticleMapper::get((int) ($request->getData('id') ?? 0)));

        return $view;
    }
}
