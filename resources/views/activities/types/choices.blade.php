
<ul class="alternatives text-center">
	@foreach ($exercise->alternatives as $alternative)
	<li class="btn-lg">
		<input type="radio" name="alternative" id={!! $alternative->id !!} value={!! $alternative->right !!}>
		<label for={!! $alternative->id !!}>{!! $alternative->text !!}</label>
	</li>
	@endforeach
</ul>
