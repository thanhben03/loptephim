@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh Sách License</h4>

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="text-align: center">Mã</th>
                            <th style="text-align: center">Ngày hết hạn</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($licenses as $license)
                            <tr class="td-custom">
                                <td>
                                    {{$license->id}}

                                </td>
                                <td>
                                    <a href="{{route('admin.license.edit', $license->id)}}">{{$license->license}}</a>
                                </td>
                                <td>
                                        <label style="width: max-content" class="badge badge-danger">{{$license->expired}}</label>
                                </td>


                                <td>

                                        <form onsubmit="if (!confirm('Bạn có chắc chắn muốn xóa ?')) return false;" class="ms-2" method="POST" action="{{ route('admin.license.destroy', $license->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-rounded btn-icon">
                                                <i class="typcn typcn-trash"></i>
                                            </button>

                                        </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        {!! $licenses->links() !!}


                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>

    </script>
@endpush
