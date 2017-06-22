<form action="{{ route('comment.create', ['comment' => $comment->id]) }}" method="post" class="form-horizontal" style="padding-left: 300px">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="comment" class="col-sm-4">Comment</label>
        <div class="col-sm-8">
            <textarea name="message" id="message" cols="30" rows="2" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Submit</button>
    </div>
</form>