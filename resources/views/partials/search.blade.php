<form class="float-end" action="{{ $route }}">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="{{ $placeholder }}..." name="s" value={{ $search }}>
        <button class="btn btn-hb" type="submit">{{ __('Search') }}</button>
        @if($search)
            <a href="{{ $route }}" class="btn btn-danger">{{ __('Clean') }}</a>
        @endif
    </div>
</form>