<?php

/*
 * This file is part of ianm/follow-users
 *
 *  Copyright (c) 2020 Ian Morland.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 *
 */

namespace IanM\FollowUsers\Notifications;

use Flarum\Discussion\Discussion;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Flarum\Post\Post;
use Symfony\Contracts\Translation\TranslatorInterface;

class NewDiscussionBlueprint implements BlueprintInterface, MailableInterface
{
    /**
     * @var Discussion
     */
    public $discussion;

    /**
     * @var Post
     */
    public $post;

    public function __construct(Discussion $discussion, Post $post = null)
    {
        $this->discussion = $discussion;
        $this->post = $post;
    }

    /**
     * {@inheritdoc}
     */
    public function getFromUser()
    {
        return $this->discussion->user;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        return $this->discussion;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailView()
    {
        return ['text' => 'ianm-follow-users::emails.newDiscussion'];
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailSubject(TranslatorInterface $translator)
    {
        return $translator->trans('ianm-follow-users.email.new_discussion_by_user_subject', [
            '{title}' => $this->discussion->title,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'newDiscussionByUser';
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubjectModel()
    {
        return Discussion::class;
    }
}
