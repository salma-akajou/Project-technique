<form id="filmForm" action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" data-success="{{ __('messages.success') }}">
    @csrf
    <h2>{{ __('messages.form_title') }}</h2>
    <div style="margin-bottom: 10px;">
        <label>{{ __('messages.titre') }}</label><br>
        <input type="text" name="titre" required style="width: 100%; border: 1px solid #ccc; padding: 5px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>{{ __('messages.description') }}</label><br>
        <textarea name="description" required style="width: 100%; border: 1px solid #ccc; padding: 5px;"></textarea>
    </div>
    <div style="margin-bottom: 10px;">
        <label>{{ __('messages.directeur') }}</label><br>
        <input type="text" name="directeur" required style="width: 100%; border: 1px solid #ccc; padding: 5px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>{{ __('messages.image') }}</label><br>
        <input type="file" name="image">
    </div>
    <div style="margin-bottom: 10px;">
        <label>{{ __('messages.categories') }}</label><br>
        @foreach($categories as $cat)
            <label style="font-size: 14px;">
                <input type="checkbox" name="categories[]" value="{{ $cat->id }}"> {{ $cat->nom }}
            </label><br>
        @endforeach
    </div>
    <div style="text-align: right;">
        <button type="button" id="closeModal" style="padding: 5px 10px;">{{ __('messages.cancel') }}</button>
        <button type="submit" style="padding: 5px 10px; background: green; color: white; border: none;">{{ __('messages.save') }}</button>
    </div>
</form>
