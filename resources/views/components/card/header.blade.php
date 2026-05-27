@props(['title' => 'insira um titulo'])
<div class="header">
    <p class="title">{{ $title }}</p>
    {{ $slot }} 
</div>