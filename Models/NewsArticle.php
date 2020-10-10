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

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Tag\Models\Tag;
use phpOMS\Contract\ArrayableInterface;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Stdlib\Base\Exception\InvalidEnumValue;

/**
 * News article class.
 *
 * @package Modules\News\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class NewsArticle implements \JsonSerializable, ArrayableInterface
{
    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    private string $title = '';

    /**
     * Content.
     *
     * @var string
     * @since 1.0.0
     */
    private string $content = '';

    /**
     * Unparsed.
     *
     * @var string
     * @since 1.0.0
     */
    private string $plain = '';

    /**
     * News type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $type = NewsType::ARTICLE;

    /**
     * News status.
     *
     * @var int
     * @since 1.0.0
     */
    private int $status = NewsStatus::DRAFT;

    /**
     * Language.
     *
     * @var string
     * @since 1.0.0
     */
    private string $language = ISO639x1Enum::_EN;

    /**
     * Created.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    private \DateTimeImmutable $createdAt;

    /**
     * Creator.
     *
     * @var Account
     * @since 1.0.0
     */
    private Account $createdBy;

    /**
     * Publish.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $publish;

    /**
     * Featured.
     *
     * @var bool
     * @since 1.0.0
     */
    private bool $featured = false;

    /**
     * Tags.
     *
     * @var Tag[]
     * @since 1.0.0
     */
    private array $tags = [];

    /**
     * Comments
     *
     * @var null|int|object|CommentList
     * @since 1.0.0
     */
    private $comments = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdBy = new NullAccount();
        $this->createdAt = new \DateTimeImmutable('now');
        $this->publish   = new \DateTime('now');
    }

    /**
     * Get content
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content News article content
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    /**
     * Set plain content
     *
     * @param string $plain Plain/raw content
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setPlain(string $plain) : void
    {
        $this->plain = $plain;
    }

    /**
     * Get plain/raw content
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getPlain() : string
    {
        return $this->plain;
    }

    /**
     * Set comment list
     *
     * @param int|CommentList $comments Comment list
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCommentList($comments) : void
    {
        $this->comments = $comments;
    }

    /**
     * Get comments
     *
     * @return null|object|CommentList
     *
     * @since 1.0.0
     */
    public function getComments() : ?object
    {
        return $this->comments;
    }

    /**
     * Get date of creation
     *
     * @return \DateTimeImmutable
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Get id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get news language
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getLanguage() : string
    {
        return $this->language;
    }

    /**
     * Get publish date
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getPublish() : \DateTime
    {
        return $this->publish;
    }

    /**
     * Set language
     *
     * @param string $language News article language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setLanguage(string $language) : void
    {
        if (!ISO639x1Enum::isValidValue($language)) {
            throw new InvalidEnumValue($language);
        }

        $this->language = $language;
    }

    /**
     * Set publish date
     *
     * @param \DateTime $publish Publish date
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setPublish(\DateTime $publish) : void
    {
        $this->publish = $publish;
    }

    /**
     * Get created by
     *
     * @return Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : Account
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param Account $account Created by
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy(Account $account) : void
    {
        $this->createdBy = $account;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set news article title
     *
     * @param string $title News article title
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * Get news article type
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Set news article type
     *
     * @param int $type News article type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setType(int $type) : void
    {
        if (!NewsType::isValidValue($type)) {
            throw new InvalidEnumValue((string) $type);
        }

        $this->type = $type;
    }

    /**
     * Get news article status
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int $status News status
     *
     * @return void
     *
     * @throws InvalidEnumValue
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : void
    {
        if (!NewsStatus::isValidValue($status)) {
            throw new InvalidEnumValue((string) $status);
        }

        $this->status = $status;
    }

    /**
     * @return bool
     *
     * @since 1.0.0
     */
    public function isFeatured() : bool
    {
        return $this->featured;
    }

    /**
     * Set featured
     *
     * @param bool $featured Is featured
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setFeatured(bool $featured) : void
    {
        $this->featured = $featured;
    }

    /**
     * Get tags
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getTags() : array
    {
        return $this->tags;
    }

    /**
     * Add tag
     *
     * @param Tag $tag Tag
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addTag(Tag $tag) : void
    {
        $this->tags[] = $tag;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'plain'     => $this->plain,
            'content'   => $this->content,
            'type'      => $this->type,
            'status'    => $this->status,
            'featured'  => $this->featured,
            'publish'   => $this->publish,
            'createdAt' => $this->createdAt,
            'createdBy' => $this->createdBy,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
