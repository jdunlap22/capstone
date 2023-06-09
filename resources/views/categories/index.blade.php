@extends('common') 

@section('pagetitle')
Item List
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Category List</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('categories.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Add Category</a>
		</div>
		<div class="col-md-12">
			<hr />
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Picture</th>
					<th>Created At</th>
					<th>Last Modified</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($categories as $category)
						<tr>
							<th>{{ $category->id }}</th>
							<td>{{ $category->name }}</td>
							<td>{{ $category->description }}</td>
							<td>{{ $category->price }}</td>
							<td>
								@if($category->picture)
								<a href="{{ asset('images/items/' . $item->picture) }}" target="_blank">
									<img src="{{ asset('images/items/' . $item->picture)}}" width="50px" height="50px">
								</a>
								@endif
							</td>
							<td style='width:100px;'>{{ date('M j, Y', strtotime($category->created_at)) }}</td>
							<td style='width:100px;'>{{ date('M j, Y', strtotime($category->updated_at)) }}</td>
							<td style='width:150px;'>
								<div style='float:left; margin-right:5px;'>
									<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm">Edit</a>
								</div>
								<div style='float:left;'></div>
								@if ($category->items()->count() == 0)
    								<form action="{{ route('categories.destroy', $category->id) }}" method="POST">
        								@csrf
       									@method('DELETE')
        							<button type="submit" class="btn btn-sm btn-danger">Delete</button>
    								</form>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- end of .col-md-8 -->
	</div>

@endsection