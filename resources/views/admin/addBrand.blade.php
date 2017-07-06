@extends('admin.master')

@section('content')


  <section id="container" class="">
        @include('admin.sidebar')
        <section id="main-content">
            <section class="wrapper">


                <div class="content-box-large">
                    <h1>Add Brand</h1>

                    {!! Form::open(['url' => 'admin/brandForm',  'method' => 'post']) !!}
                    <table class="table-borderless" style="height:200px">

                        <tr>
                            <td> Brand Name:</td>
                            <td>    <input type="text" name="brand_name" class="form-control"></td>
                        </tr>

                         <tr>
                             <td colspan="2">
                        <input type="submit" value="Add Brand" class="btn btn-success pull-right">
                             </td>
                         </tr>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        {!! Form::close() !!}
                    </table>
                </div>

            </section>
      </section>
</section>

@endsection
