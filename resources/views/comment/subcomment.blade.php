<?php 
$currentComment = $bundle['comment'];
$newBundle = $bundle['sub_comments'];
?>
<li>
    <div>written by: {{ $CurrentComment->user? $CurrentComment->user->name: 'guest' }} published at: {{ $CurrentComment->created_at }}</div>
    <div>
        <div>{{ $CurrentComment->message }}</div>
        @if(empty($newBundle))
            <ul>
                @include('comment.subcomment', ['bundle' => $newBundle])
            </ul>
        @endif
    </div>
    <div>
        <h5>reply to this comment</h5>
        <div>
            @include('comment.form', ['comment' => $currentComment])

        </div>
    </div>
</li>