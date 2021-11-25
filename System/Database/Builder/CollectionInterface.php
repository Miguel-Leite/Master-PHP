<?php

namespace Master\Database\Builder;

interface CollectionInterface
{

    public function set(array $data = []): CollectionInterface;

    public function getSQL():string;

}