<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<style>
@media only screen and (max-width: 800px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 800px) {
.button {
width: 100% !important;
}
}
</style>

<table class="table" width="100%" role="presentation" align="center">
<tr>
<td align="center">
<table class="table" width="100%" role="presentation" align="center">
{{ $header ?? '' }}

<!-- Email Body -->
<tr>
<td align="center">
<table class="table" align="center" width="100%" role="presentation">
<!-- Body content -->
<tr>
<td align="center">
{{ Illuminate\Mail\Markdown::parse($slot) }}

{{ $subcopy ?? '' }}
</td>
</tr>
</table>
</td>
</tr>

{{ $footer ?? '' }}
</table>
</td>
</tr>
</table>
</body>
</html>
