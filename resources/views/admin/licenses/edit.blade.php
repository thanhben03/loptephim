@extends('layouts.admin')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit License</h4>
                <form method="POST" action="{{ route('admin.license.update', $license->id) }}" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1">Mã: </label>
                        <input type="text" value="{{$license->license}}" onkeyup="ChangeToSlug()" name="license" class="form-control" id="license"
                               placeholder="license">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Ngày hết hạn</label>
                        <input type="date" value="{{$license->expired}}" class="form-control" id="slug" name="expired" placeholder="Expired">
                    </div>


                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
