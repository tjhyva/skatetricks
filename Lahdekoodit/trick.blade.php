@extends('layouts.app')
@section('header')                        
    <h1>{{$category}} tricks</h1>
@endsection
@section('content')
  @section('userinfo')    
  @endsection
  @guest
  @else
  <form role="form" data-toggle="validator" method="POST" action="{{ url('/trick') }}">
    <div class="justify-content-center">
      <input id="name" type="text" name="name" placeholder="Trick name" required autofocus>    
      <input id="link" type="text" name="link" placeholder="Video link " required>    
      <input id="descripton" type="text" name="description" placeholder="Description">    
      <input id="like" type="hidden" name="like" value="0">
      <input id="dislike" type="hidden" name="dislike" value="0">        
      <input id="category_id" type="hidden" name="category_id" value="{{$category_id}}">
      <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
      <button style="color:blue"type="submit" class="navbtn">add trick</button>
    </div>  
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  </form> 
  @endguest
      
  <div class="trickbtn">
    @guest
      <button class="navbtn" onclick="window.location.href='../'">home</button>
    @else
    <button class="navbtn" onclick="window.location.href='../home'">home</button>
    @endguest
    @foreach ($categories as $item)                                           
        <button class="navbtn" onclick="window.location.href='{{ $item->name}}'">{{ $item->name}}</button>
    @endforeach        
    <table>
      <thead>          
          <tr>              
            <th>Trick</th>
            <th>Skater</th>                  
            <th>Video</th>
            <th>Description</th>
            <th>Like</th>
            @guest
            @else
            <th>Delete</th>  
            @endguest                                                
          </tr>
        </thead>
      <tbody>
    
        @guest
            @foreach ($tricks as $item)  
            <tr class="justify-content-center"> 
              <td>{{$item['name']}}</td>
              <td>{{$item['user']}}</td>
              <td><a href="{{$item['video']}}">{{$item['video']}}</a></td>
              <td>{{$item['description']}}</td>
              <td><img src="{{url('/images/thumbup.png')}}">{{$item['like']}}<img src="{{url('/images/thumbdown.png')}}">{{$item['dislike']}}</td>
            </tr>
          @endforeach
        @else
          @foreach ($tricks as $item)  
            <div style="display: none">
              {{$userlogin = Auth::user()->name }} 
              {{$usertrick = $item['user']}}                                    
            <div>
            @if($userlogin == $usertrick)
            <tr class="justify-content-center"> 
              <td>{{$item['name']}}</td>
              <td>{{$item['user']}}</td>
                <td><a method="POST" href="{{$item['video']}}">{{$item['video']}}</a></td>
              @method('DELETE')
              @csrf
              <td>{{$item['description']}}</td>                                        
              <td>                        
                <img src="{{url('/images/thumbup.png')}}">{{$item['like']}}<img src="{{url('/images/thumbdown.png')}}">{{$item['dislike']}}                        
              </td>
              <td><a href="delete/{{$item['id']}}"><img src="{{url('/images/delete.png')}}" width="20"></a></td>
              </tr>
              @endif
          @endforeach
          <thead>
            <tr>
              <th>Trick</th>
              <th>Skater</th>                  
              <th>Video</th>
              <th>Description</th>
              <th>Like</th>
              <th></th>                                    
            </tr>
          </thead>
          @foreach ($tricks as $item)  
          <div style="display: none">
            {{$userlogin = Auth::user()->name }} 
            {{$usertrick = $item['user']}}                                    
          </div>
            @if($userlogin != $usertrick)
              <tr class="justify-content-center"> 
                <td>{{$item['name']}}</td>
                <td>{{$item['user']}}</td>
                <td><a method="POST" href="{{$item['video']}}">{{$item['video']}}</a></td>
                @method('DELETE')
                @csrf
                <td>{{$item['description']}}</td>                                        
                  <td>                      
                    <a href="like/{{$item['id']}}/1"><img src="{{url('/images/thumbup.png')}}"></a>{{$item['like']}}<a href="like/{{$item['id']}}/0"><img src="{{url('/images/thumbdown.png')}}"></a>{{$item['dislike']}}                      
                  </td>
                </tr>
            @endif
          @endforeach
        @endguest          
      </tbody>
    </table>
@endsection
