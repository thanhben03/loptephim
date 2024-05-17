@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh Sách Phim</h4>

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Ngày tạo
                            </th>
                            <th>
                                Hành động
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($countries as $country)
                            <tr>
                                <td>
                                    {{$country->id}}

                                </td>
                                <td>
                                    <a href="{{route('admin.genre.edit', $country->id)}}">{{$country->name}}</a>
                                </td>

                                <td>
                                    {{$country->created_at}}
                                </td>
                                <td>

                                        <form onsubmit="if (!confirm('Bạn có chắc chắn muốn xóa ?')) return false;" class="ms-2" method="POST" action="{{ route('admin.country.destroy', $country->id) }}">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
