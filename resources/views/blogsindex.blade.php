@extends('layouts.app')

@section('content')

<div class="container">
 <div class="row">

 <div class="col-md-12">
 	


<table class="table table-striped">
    <thead>
      <tr>
       <th>Id</th>
        <th>Title</th>
        <th>Tags</th>
       
        <th>User Id</th>
        
        
       
        
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
<tr>
@foreach($blogs as $blog)

<td>{{$blog->id}}</td>


        <td> <a href=" {{ url('blogs/'.$blog->id) }} ">{{$blog->title}}</a></td>
        <td>
        @foreach($blog->tags as $tag)
         {{$tag->name}}<br>
       @endforeach
       </td>
        <td>{{$blog->user_id}}</td>
      
        
        
       <td><a href=" {{ url('tour/'.$blog->id.'/edit') }} "><button>Edit</button></a></td>
       <td><a href=" {{ url('tour/'.$blog->id.'/delete') }} "><button>Delete</button></a></td>
      </tr>
   
@endforeach
 </tbody>
  </table>




 </div>

</div>
</div>

 @endsection