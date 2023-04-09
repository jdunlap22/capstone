@extends('common') 

@section('pagetitle')
Edit Category
@endsection

@section('pagename')
Laravel Project
@endsection

@section('scripts')
{!! Html::script('/bower_components/parsleyjs/dist/parsley.min.js') !!}
<script src="https://cdn.tiny.cloud/1/l24z7hhebp5u500yeih5m9cvhbnpqxslte5glyllshqpoqos/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#item-description',
        plugins: 'autolink lists link image imagetools media table',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | table',
        height: 300,
        image_caption: true,
        imagetools_toolbar: 'rotateleft rotateright | flipv fliph | editimage imageoptions',
        media_dimensions: false,
        media_poster: false,
        media_alt_source: false,
    });
</script>
@endsection

@section('css')
{!! Html::style('/css/parsley.css') !!}
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Edit Category</h1>
			<hr/>

			{!! Form::model($category, ['route' => ['categories.update', $category->id], 'method'=>'PUT', 'data-parsley-validate' => '']) !!}

			<div class="row">
				<div class="col-md-12">
				    {{ Form::label('name', 'Name:') }}
				    {{ Form::text('name', null, ['class'=>'form-control', 'style'=>'', 
				                                  'data-parsley-required'=>'', 'data-parsley-maxlength'=>'100']) }}
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					{{-- Label for picture --}}
					{{ Form::label('picture', 'Picture:') }}
					{{Form::image('picture', null, ['class'=>'form-control'])}}
				</div>

			<div class="row">
				<div class="col-md-6">
				{!! Html::linkRoute('categories.index', 'Cancel', [], ['class'=>'btn btn-lg btn-danger btn-block', 'style'=>'margin-top:20px']) !!}
				</div>
				<div class="col-md-6">
			    {{ Form::submit('Update Series', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px']) }}
				</div>
			</div>

			{!! Form::close() !!}

		</div>
	</div>

@endsection