<?php

/**
 * This file is part of the FOSCommentBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MDB\WorkorderBundle;

final class Events
{
    const WORKORDER_PRE_PERSIST = 'mdb_workorder.workorder.pre_persist';
    const WORKORDER_POST_PERSIST = 'mdb_workorder.workorder.post_persist';
}
