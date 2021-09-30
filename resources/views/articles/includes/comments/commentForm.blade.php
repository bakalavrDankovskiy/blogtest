<form action="{{route('comments.store')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="txt" class="form-label">Оставьте комментарий</label>
        <textarea name="txt" class="form-control" id="txt" rows="3"
                  placeholder="Оставьте комментарий"></textarea>
        <input type="hidden" name="article_id" value="{{$article->id}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
