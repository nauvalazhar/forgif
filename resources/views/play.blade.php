<!DOCTYPE html>
<html>
<head>
	<title>{{config('app.name')}} HTML5 Player</title>
	<style>body{margin:0;padding:0;}</style>
	<meta property="og:url" content="{!! url('media/' . $status->attachment . '.gif') !!}">
        <meta property="og:title" content="See GIF from {{$status->users->name}}">
        <meta property="og:description" content="{{$status->content}}">
        <meta property="og:type" content="video">
        <meta property="og:image" content="{{url('media/thumbs/' . $status->attachment . '.png')}}">
        <meta property="og:image:width" content="{{$image_width}}">
        <meta property="og:image:height" content="{{$image_height}}">
        <meta property="og:site_name" content="{{config('app.name')}}">
        <meta property="og:video" content="{!! url('media/player/' . $status->attachment . '.mp4') !!}">
</head>
<body>
<video poster="{!! url('media/thumbs/' . $status->attachment . '.png') !!}" loop="true" autoplay="">
	<source src="{!! url('media/player/' . $status->attachment . '.mp4') !!}" type="video/mp4">
	Your browser does not support the video tag.
</video>
</body>
</html>