@extends('layouts.app', ['footer' => false])
@section('title', 'Let\'s waste your time')
@section('og')
<meta property="og:url" content="{{url('')}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Let's waste your time in {{config('app.name')}}" />
<meta property="og:description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing." />
<meta property="og:image" content="{{url('media/forgif-cover.png')}}" />
<meta property="og:site_name" content="{{config('app.name')}}" />

<meta itemprop="name" content="Let's waste your time in {{config('app.name')}}">
<meta itemprop="description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing.">
<meta itemprop="image" content="{{url('media/forgif-cover.png')}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Let's waste your time in {{config('app.name')}}">
<meta name="twitter:description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing.">
<meta name="twitter:image:src" content="{{url('media/forgif-cover.png')}}">
@stop

@section('content')
<section class="home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div id="primary-sidebar">
                    <div class="panel panel-default">
                        <div class="panel-heading">You may also know
                        <div class="pull-right">
                            <a href="{{route('users.friends')}}">See All</a>
                        </div>
                        </div>
                        <div class="panel-body">
                            @component('parts.element_friends')
                            @endcomponent
                        </div>
                    </div>
                    @component('parts.element_footer')
                    @endcomponent
                </div>
            </div>
            <div class="col-md-7">
                @component('parts.form_status')
                @endcomponent                    
                <h2 class="sm-title">Let's waste your time</h2>
                @component('parts.element_status')
                @endcomponent
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
getStatus($("[data-status-loader]"));
$(window).scroll(function(){
  if($(window).scrollTop() >= ($(document).height() - $(window).height()) - 100){
    getStatus($("[data-status-loader]"));
  }
});
</script>
@stop