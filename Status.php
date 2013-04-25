<?php 
namespace MDB\WorkorderBundle;
final class Status {
    const WREQUEST = 'WORK_REQUEST';
    const ASSIGNED = 'WO_ASSIGNED';
    const IN_PROGRESS = 'WO_IN_PROGRESS';
    const PAUSED = 'WO_PAUSED';
    const CANCEL = 'WO_CANCEL';
    const CLOSE = 'WO_CLOSE';
    const COMPLETE = 'WO_COMPLETE';
}