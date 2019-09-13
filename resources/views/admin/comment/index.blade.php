@extends('layouts.admin')

@section('breadcrumb')
    @include('includes.breadcrumb')
@endsection
@section('main')
	@if((!empty($new_comments) && count($new_comments) > 0) || (!empty($old_comments) && count($old_comments) > 0) )
		<table class="table ">
			<thead>
				<tr>
					<th></th>
					<th width="30%">Commentaire</th>
					<th>Pseudo</th>
					<th>Titre</th>
					<th>Partition / Astuce</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($new_comments) && count($new_comments) > 0)
					@foreach($new_comments as $comment)
						<tr>
							<td><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></td>
							<td>{{ $comment->comment }}</td>
							<td>{{ $comment->username }}</td>
							<td>
								@if($comment->score)
									{{ $comment->score . ' - ' . $comment->score->author }}
								@elseif($comment->trick)
									{{ $comment->trick }}
								@endif
							</td>
							<td>
								@if($comment->score)
									Partition
								@elseif($comment->trick)
									Astuce
								@endif
							</td>
							<td>
								@if($comment->score)
									{{ $comment->score->createdAt|date('Y-m-d') }}
								@elseif($comment->trick)
									{{ $comment->trick->createdAt|date('Y-m-d') }}
								@endif
							</td>
							<td>
								<a href="{{ route('admin_comments_online',['id_comment'=>$comment->id]) }}" class="btn btn-primary" style="opacity: @if($comment->is_online) 1 @else 0.5 @endif">
									<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
								</a>
								<a href="{{ route('admin_comments_offline',['id_comment'=>$comment->id]) }}" class="btn btn-danger" style="opacity: @if(!$comment->is_online) 1 @else 0.5 @endif">
									<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
								</a><!--
								<a href="{{ route('admin_comments_remove',['id_comment'=>$comment->id]) }}" class="btn btn-danger" data-toggle="confirmation" data-title="Confirmation" data-btn-ok-label="Supprimer" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"data-btn-cancel-class="btn-danger" data-content="Êtes-vous sûr de vouloir supprimer ce commentaire ?" data-placement="right" data-singleton="true" data-popout="true">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</a>
								-->
							</td>
						</tr>
					@endforeach
				@endif

				@if(!empty($old_comments) && count($old_comments) > 0)
					@foreach($old_comments as $comment)
						<tr>
							<td></td>
							<td>{{ $comment->comment }}</td>
							<td>{{ $comment->username }}</td>
							<td>
								@if($comment->score)
									{{ $comment->score . ' - ' . $comment->score->author }}
								@elseif($comment->trick)
									{{ $comment->trick }}
								@endif
							</td>
							<td>
								@if($comment->score)
									Partition
								@elseif($comment->trick)
									Astuce
								@endif
							</td>
							<td>
								<a href="{{ route('admin_comments_online',['id_comment'=>$comment->id]) }}" class="btn btn-primary" style="opacity: @if($comment->is_online) 1 @else 0.5 @endif">
									<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
								</a>
								<a href="{{ route('admin_comments_offline',['id_comment'=>$comment->id]) }}" class="btn btn-danger" style="opacity: @if(!$comment->is_online) 1 @else 0.5 @endif">
									<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
								</a><!--
								<a href="{{ route('admin_comments_remove',['id_comment'=>$comment->id]) }}" class="btn btn-danger" data-toggle="confirmation" data-title="Confirmation" data-btn-ok-label="Supprimer" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"data-btn-cancel-class="btn-danger" data-content="Êtes-vous sûr de vouloir supprimer ce commentaire ?" data-placement="right" data-singleton="true" data-popout="true">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</a>-->
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	@else
		<h2>Aucun commentaire pour le moment.</h2>
	@endif
@endsection
@section('js_code')
	@parent
	<script src="{{ elixir( '/js/bootstrap-confirmation.min.js' ) }}"></script>
	<script type="text/javascript">
		$(function()
		{
			$('[data-toggle=confirmation]').confirmation({
				rootSelector: '[data-toggle=confirmation]'
			});
		});
	</script>
@endsection