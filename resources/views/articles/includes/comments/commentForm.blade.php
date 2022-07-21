<form action="{{route('comments.store')}}" method="POST">
    @csrf
    <div class="mb-3">
        <textarea name="txt" class="form-control" id="txt" rows="3"
                  placeholder="Оставьте комментарий"></textarea>
        <input type="hidden" name="article_id" value="{{$article->id}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
