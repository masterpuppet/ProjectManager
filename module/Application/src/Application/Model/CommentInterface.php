<?php

namespace Application\Model;

interface CommentInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $message
     */
    public function setMessage($message);

    /**
     * @return string
     */
    public function getMessage();
}