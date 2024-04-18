<x-layout>
    <x-setting heading="Publish New Post ">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" type="text"/>
            <x-form.input name="slug" type="text"/>
            <x-form.input name="thumbnail" type="file"/>
            <x-form.textarea name="excerpt"/>
            <x-form.textarea name="body"/>

            <x-form.field>

                 <x-form.label name="category"/>

                <select name="category_id" id="category_id ">
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp

                    @foreach($categories as $category )
                        <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>

                <x-form.error name="category"/>

            </x-form.field>

            <x-form.field>
                <x-submit-button>Publish</x-submit-button>
            </x-form.field>
        </form>

    </x-setting>

</x-layout>
