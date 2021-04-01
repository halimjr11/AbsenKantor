@if($list != "")
@foreach ($list as $d)
<a class="dropdown-item d-flex align-items-center" href="#">
    <div class="mr-3">
        <div class="icon-circle bg-primary">
          <h5>{{$d->jenis}}</h5>
        </div>
    </div>
    <div>
        <div class="small text-gray-500"></div>
        <span class="font-weight-bold">{{$d->keterangan}}</span>
    </div>
</a>
@endforeach
@endif
