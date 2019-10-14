<form action="{{ route('postlogin') }}" class="form-horizontal" id="form-login">
	@csrf
		<div class="form-group">
		    <label for="username">Username</label>
		    <input type="text" class="form-control" name="username" id="username" placeholder="Example : John.Doe" autofocus autocomplete="">
		</div>

		<div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control" name="password" id="password" placeholder="*******" autofocus autocomplete="">
		</div>

		<div class="errors"></div>

		<div class="d-flex">
			<button type="submit" class="btn btn-primary ml-auto" id="action-primary">Sign In</button>
		</div>
</form>