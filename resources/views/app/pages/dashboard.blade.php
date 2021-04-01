@extends('app.main')
@section('title', 'AbsensiKantor')
@section('content')
<div class="jumbotron jumbotron-fluid bg-info">
	<div class="container">
	<h1 class="display-4"><img src="{{url('images/logo.png')}}" alt="" size="100"> Absensi Kantor</h1>
	  <p class="lead"></p>
	@if(Auth::user()->level == 'admin')
	<div style="float: right;">
		<a href="{{ route('app.news.add') }}" class="btn btn-success btn-sm float-right"> 
			<i class="fa fa-plus"></i> Add
		</a>
	</div>
	@endif
	</div>
  </div>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			@foreach ($data as $d)
				<div class="card">
					<div class="card-body">
						<header>
							<h4>
								<strong>
									{{$d->judul}}
								</strong>
							</h4>
						</header>
						<p>
							{{$d->desc}}
						</p>
						<small>
							{{$d->tanggal}}
						</small>
					</div>
				</div>
			@endforeach
		</div>	
		<div class="col-md-4">
			<aside style="height: 500px">
				<div id="calendar" style="height: 250px"></div>
			</aside>
		</div>
	</div>
</div>
@endsection	