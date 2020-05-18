<div>
	<h4>Ordered Products:</h4>
</div>
<div>
	<ul>
		@foreach( $names as $name )
			<li>{{ $name }}</li>
		@endforeach
	</ul>
</div>
<div>
	<h4>Total:</h4>
</div>
<div>
	<strong>{{ $total }}$</strong>
</div>