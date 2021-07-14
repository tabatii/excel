<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Scraping project</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
	</head>
	<body>
		<div class="container py-5">
			<div class="row justify-content-center">
				<div class="col-4">
					<form class="card" action="/import" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<div class="card-body">
							@if ($errors->any())
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							<div class="row g-2 mb-2">
								<div class="col">
									<input type="text" class="form-control" name="from" placeholder="From" value="{{ old('from') }}" />
								</div>
								<div class="col">
									<input type="text" class="form-control" name="to" placeholder="To" value="{{ old('to') }}" />
								</div>
							</div>
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary">Save in database</button>
								<a href="/export" target="_blank" class="btn btn-primary">Export to excel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>