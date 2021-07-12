@section('css')
<style>
    .panel-default {
        border-color: #ddd;
        width: 90% !important;
        margin-right: 20px !important;
    }
</style>    
@endsection
<div class="container">    
    <div class="row">
        <div class="panel panel-default">
        <div class="panel-heading">  <h4 >بروفايل المستخدم </h4></div>
        <div class="panel-body">
        <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
        <img alt="User Pic" src="{{asset('uploads/images/users/'.$user->img)}}" id="profile-image1" class="img-circle img-responsive"style="width: 100%;"> 
        </div>
        <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
            <div class="container" >
                <h2>{{$user->name}}</h2> 
                @if($user->type == 'admin')
                    <div style="width:100px;height:40px;background-color:#52CAFE;color:#fff;font-size:20px;padding-top:5px;"><p style="margin-right: 20px;">أدمن</p></div>
                @elseif($user->type == 'store')
                    <div style="width:150px;height:40px;background-color:#52CAFE;color:#fff;font-size:20px;padding-top:5px;"><p style="margin-right: 20px;">صاحب شركة</p></div>
                @else
                    <div style="width:100px;height:40px;background-color:#52CAFE;color:#fff;font-size:20px;padding-top:5px;"><p style="margin-right: 20px;">صاحب شركة</p></div>
                @endif
            <div>
                
                </div>
            </div>
            <hr>
            <ul class="container details" >
            <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><a href="mailto:{{$user->email}}">{{$user->email}}</a></p></li>
            </ul>
            <hr>
        </div>
</div>
</div>
</div>