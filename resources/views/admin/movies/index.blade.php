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
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>Thumbnail</th>
                            <th>Vietsub</th>
                            <th>Thể loại</th>
                            <th>Ngày phát hành</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($movies as $movie)
                            <tr>
                                <td>
                                    {{$movie->id}}

                                </td>
                                <td>
                                    <a href="{{route('admin.movie.edit', $movie->id)}}">{{$movie->title}}</a>
                                </td>
                                <td>
                                    <img src="{{$movie->thumbnail}}" style="border-radius: 0">
                                </td>
                                <td>
                                    @if($movie->is_vietsub)
                                        Có
                                    @else
                                        Không
                                    @endif
                                </td>
                                <td style="
                                display: flex;
                                flex-direction: column;">
                                    @foreach($movie->movie_genres as $item)
                                        <label style="width: max-content" class="badge badge-danger">{{$item->genre->name}}</label>
                                    @endforeach
                                </td>
                                <td>
                                    {{$movie->release_date}}
                                </td>
                                <td>

                                        <form onsubmit="if (!confirm('Bạn có chắc chắn muốn xóa ?')) return false;" class="ms-2" method="POST" action="{{ route('admin.movie.destroy', $movie->id) }}">
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
                        {!! $movies->links() !!}


                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
