@extends('layouts/default')

@section('pagetitle') Conversation - ChatProject @endsection

@section('navbar')
<li class="nav-item"><a href="/" class="nav-link">Accueil</a></li>
<li class="nav-item"><a href=" /contacts" class="nav-link">Contacts</a></li>
<li class="nav-item"><a href=" /account" class="nav-link">Compte</a></li>
<li class="nav-item"><a href=" /logout" class="nav-link">Déconnexion <i>({{ Auth::user()->name }})</i></a></li>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$("body").tooltip({ selector: '[data-toggle=tooltip]' });
	});
</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-5">
			<h2><b>{{ $conv->destUser->name }}</b> <i>({{ $conv->destUser->email }})</i></h2>
		</div>
	</div>
{{-- 		<div class="pull-right col-md-4 hidden-sm hidden-xs">
			<h4 class="pull-right">{{ $user->name }} <i>({{ $user->email }})</i></h4>
			<i class="pull-right">Token : <a href="/token/renew">{{ $user->token->token }}</a></i>		</div>
		</div> --}}


		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="col-xs-2">Horodatage</th>
					<th class="col-xs-2">Émetteur</th>
					<th>Message</th>
					
				</tr>
			</thead>
			@foreach ($messages as $message)
			<tr>
				<td><span class="hidden-xs"><small>{{ $message->created_at->format('d/m/Y') }}</small></span> <b>{{ $message->created_at->format('H:i:s') }}</b> </td>
				<td>@if ($message->sender->id == Auth::user()->id) <i> @else <b> @endif {{ $message->sender->name }} @if ($message->sender->id == Auth::user()->id) </i> @else </b> @endif</td>
				<td>@if ($message->sender->id == Auth::user()->id) <i> @endif {{ $message->content }} @if ($message->sender->id == Auth::user()->id) </i> @endif</td>
				<td><a class="btn-xs pull-right" href="/message/{{ $message->id }}/delete" role="button"><i class="fa fa-trash-o"></i></a></td>
			</tr>
			@endforeach
		</table>

		<form class="from-inline" action="/conversation/{{ $conv->id }}" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
			<div class="row">
				{{-- <div class="form-group" id="msg"> --}}
				<div class="col-xs-11">
					<input type="text" class="form-control" name="msg" id="msg" placeholder="Message">
				</div>
				<div class="col-xs-1">
					<button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
				</div>
				{{-- </div> --}}
{{-- 			<div class="form-group col-xs-1">
				
</div> --}}
</div>
</div>
</div>
</form>
@endsection
