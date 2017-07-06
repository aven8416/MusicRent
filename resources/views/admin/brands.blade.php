@extends('admin.master')

@section('content')

  <section id="container" class="">
        @include('admin.sidebar')
        <section id="main-content">
            <section class="wrapper">

                <div class="content-box-large">
                    <h1>View Brands</h1>


                    <table class="table table-striped">
                        <thead>  <tr>
                                <th>Brand ID</th>
                                <th>Brand Name</th>
                                <th>Status</th>
                                <th>update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        @foreach($brands as $brand)
                        <tbody>
                            <tr>
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->name}}</td>
                                <td>@if($brand->status=='0')
                                    Enable
                                    @else
                                    Disable

                                    @endif</td>
                                <td><a href="{{url('/')}}/admin/BrandEditForm/{{$brand->id}}" class="btn btn-info btn-small">Edit</a></td>
                                <td><a href="{{url('/admin/deleteBrand')}}/{{$brand->id}}" class="btn btn-danger">Remove</a></td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>

                </div>



        </section>
      </section>
  </section>

@endsection
