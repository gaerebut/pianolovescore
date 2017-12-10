<div class="scores__comment">
	<div id="{{ $comment->id }}">
	    <strong>{{ $comment->username }}</strong> - {{ $comment->created_at->diffForHumans() }}
	    <div>{!! nl2br(e($comment)) !!}</div>
	    <a href="#" class="reply" rel="nofollow">Répondre</a>
	    <form class="reply_form collapse" action="{{ route('ajax_comment') }}" onsubmit="return false">
		    <div class="form-group">
		        <input type="text" id="u" class="form-control" placeholder="Votre pseudo..." pattern=".{3,}" required />
		    </div>
		    <div class="form-group">
		        <textarea class="form-control" id="c" placeholder="Votre commentaire..." pattern=".{3,}" required></textarea>
		    </div>
		    <div class="form-group">
		        <button type="submit" class="btn btn-primary reply_comment">Poster le commentaire</button>
		    </div>
		</form>
    </div>
    	@if(count($comment->children) > 0)
			@foreach($comment->children as $child)
				@include('public._comments', array('comment' => $child))
			@endforeach
       @endif
</div>