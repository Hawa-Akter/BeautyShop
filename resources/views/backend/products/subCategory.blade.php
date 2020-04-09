@if(count($subcategories) > 0)
    @foreach($subcategories as $subcategory)
        <option value="{!! $subcategory->id !!}">{!! $subcategory->title !!}</option>
    @endforeach
@else
    <option>- No Subcategories -</option>
@endif