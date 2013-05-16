<?php
namespace MDB\WorkorderBundle;
/**
*
*/
final class CommentTypes
{
    const USER_COMMENT = "mdb_workorder.comment_types.user_comment";
    const STATUS_CHANGE = "mdb_workorder.comment_types.status_change";

    public function getCommentTypes()
    {
        $reflect = new ReflectionClass(get_class($this));

        return $reflect->getConstants();
    }
}
