<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\News\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\News\Models;

/**
 * Null model
 *
 * @package Modules\News\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class NullNewsArticle extends NewsArticle
{
    /**
     * Constructor
     *
     * @param int $id Model id
     *
     * @since 1.0.0
     */
    public function __construct(int $id = 0)
    {
        $this->id = $id;
        parent::__construct();
    }
}
