@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th>parent</th>
                        <th>active</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 + $offset }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->superCategory? $category->superCategory->name: 'no pareny'  }}</td>
                        <td>{{ $category->active? 'active': 'in_active' }}</td>
                        <td>
                            <form action="{{ route('admin_backoffice.category.destroy', ['category' => $category->id]) }}"
                                  method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button title="remove"><i class="glyphicon glyphicon-remove"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div style="text-align: center">
                                No category was found
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if(count($categories))
                <div style="text-align: center">
                    {{ $categories->appends(['active' => $active])->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection