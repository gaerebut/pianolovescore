<div class="scores__comment" id="{{ $comment->id }}">
	<div>
	    <strong>{{ $comment->username }}</strong> - {{ $comment->created_at->diffForHumans() }}
	    <div>{!! nl2br(e($comment)) !!}</div>
	    <a href="#" class="reply" rel="nofollow">Répondre</a>
    </div>
    	@if(count($comment->children) > 0)
			@foreach($comment->children as $child)
				@include('public._comments', array('comment' => $child))
			@endforeach
       @endif
</div>